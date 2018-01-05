<?php

namespace App\Http\Controllers;

use App\Documento;
use App\ClienteDocumento;
use App\FornecedorDocumento;
use App\Http\Resources\DocumentoCollection;
use Illuminate\Http\Request;
use Illuminate\Http\File;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use Validator;

class DocumentoController extends Controller {

    function __construct() {
        $this->content = array();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexCliente(Request $request) {
        $nrcount = $request->input('nrcount', 15);
        $orderkey = $request->input('orderkey', 'id');
        $order = $request->input('order', 'asc');

        $arr = array();

        if ($request->has('id')) {
            $desc = array('documento.id', '=', $request->input('id'));
            array_push($arr, $desc);
        }

        if ($request->has('id_cliente')) {
            $desc = array('id_cliente', '=', $request->input('id_cliente'));
            array_push($arr, $desc);
        }

        if ($request->has('descricao')) {
            $desc = array('tipo_documento.descricao', 'like', '%' . $request->input('descricao') . '%');
            array_push($arr, $desc);
        }

        if ($request->has('razao_social')) {
            $desc = array('cliente.razao_social', 'like', '%' . $request->input('razao_social') . '%');
            array_push($arr, $desc);
        }

        if ($request->has('numero')) {
            $desc = array('documento.numero', 'like', '%' . $request->input('numero') . '%');
            array_push($arr, $desc);
        }

        if (count($arr) > 0) {
            $documento = DB::table('documento')
                            ->join('cliente_documento', 'documento.id', 'cliente_documento.id_documento')
                            ->join('cliente', 'cliente_documento.id_cliente', 'cliente.id')
                            ->join('tipo_documento', 'documento.id_tipo_documento', 'tipo_documento.id')
                            ->select('documento.*', 'tipo_documento.descricao', 'cliente.razao_social', 'cliente_documento.id_cliente')
                            ->where($arr)
                            ->orderBy($orderkey, $order)->paginate($nrcount);
        } else {
            $documento = DB::table('documento')
                            ->join('cliente_documento', 'documento.id', 'cliente_documento.id_documento')
                            ->join('cliente', 'cliente_documento.id_cliente', 'cliente.id')
                            ->join('tipo_documento', 'documento.id_tipo_documento', 'tipo_documento.id')
                            ->select('documento.*', 'tipo_documento.descricao', 'cliente.razao_social')->orderBy($orderkey, $order)->paginate($nrcount);
        }

        return response()->json($documento, 200);        
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexFornecedor(Request $request) {
        $nrcount = $request->input('nrcount', 15);
        $orderkey = $request->input('orderkey', 'id');
        $order = $request->input('order', 'asc');

        $arr = array();

        if ($request->has('id')) {
            $desc = array('documento.id', '=', $request->input('id'));
            array_push($arr, $desc);
        }

        if ($request->has('id_cliente')) {
            $desc = array('id_cliente', '=', $request->input('id_cliente'));
            array_push($arr, $desc);
        }

        if ($request->has('descricao')) {
            $desc = array('tipo_documento.descricao', 'like', '%' . $request->input('descricao') . '%');
            array_push($arr, $desc);
        }

        if ($request->has('razao_social')) {
            $desc = array('fornecedor.razao_social', 'like', '%' . $request->input('razao_social') . '%');
            array_push($arr, $desc);
        }

        if ($request->has('numero')) {
            $desc = array('documento.numero', 'like', '%' . $request->input('numero') . '%');
            array_push($arr, $desc);
        }

        if (count($arr) > 0) {
            $documento = DB::table('documento')
                            ->join('fornecedor_documento', 'documento.id', 'fornecdor_documento.id_documento')
                            ->join('fornecedor', 'fornecedor_documento.id_fornecedor', 'fornecedor.id')
                            ->join('tipo_documento', 'documento.id_tipo_documento', 'tipo_documento.id')
                            ->select('documento.*', 'tipo_documento.descricao', 'fornecedor.razao_social', 'fornecedor_documento.id_fornecedor')
                            ->where($arr)
                            ->orderBy($orderkey, $order)->paginate($nrcount);
        } else {
            $documento = DB::table('documento')
                            ->join('fornecedor_documento', 'documento.id', 'fornecedor_documento.id_documento')
                            ->join('fornecedor', 'fornecedor_documento.id_fornecedor', 'fornecedor.id')
                            ->join('tipo_documento', 'documento.id_tipo_documento', 'tipo_documento.id')
                            ->select('documento.*', 'tipo_documento.descricao', 'fornecedor.razao_social')->orderBy($orderkey, $order)->paginate($nrcount);
        }

        return response()->json($documento, 200);
    }

    public function listDocumento() {
        $documentos = Documento::all();
        return response()->json($documentos, 200);
    }

    /**
     * Metodo de validação da classe.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Support\Facades\Validator
     */
    private function Valitation(Request $request) {
        $validator = Validator::make($request->all(), [
                    'numero' => 'required|max:20'
                        ], parent::$messages);

        return $validator;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeCliente(Request $request) {
        $validator = $this->Valitation($request);

        if ($validator->fails()) {
            return response()->json([
                        'message' => 'Validação falhou',
                        'errors' => $validator->errors()
                            ], 422);
        }

        $documento = new Documento();
        $documento->fill($request->all());
        $documento->save();

        $clienteDocumento = new ClienteDocumento();
        $clienteDocumento->id_cliente = $request->id_cliente;
        $clienteDocumento->id_documento = $documento->id;
        $clienteDocumento->save();

        $doc = DB::table('documento')
                        ->join('cliente_documento', 'documento.id', 'cliente_documento.id_documento')
                        ->join('cliente', 'cliente_documento.id_cliente', 'cliente.id')
                        ->join('tipo_documento', 'documento.id_tipo_documento', 'tipo_documento.id')
                        ->select('documento.*', 'tipo_documento.descricao', 'cliente.razao_social', 'cliente_documento.id_cliente')
                        ->where('documento.id', '=', $documento->id)->first();

        return response()->json($doc, 201);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeFornecedor(Request $request) {
        $validator = $this->Valitation($request);

        if ($validator->fails()) {
            return response()->json([
                        'message' => 'Validação falhou',
                        'errors' => $validator->errors()
                            ], 422);
        }

        $documento = new Documento();
        $documento->fill($request->all());
        $documento->save();

        $fornecedorDocumento = new FornecedorDocumento();
        $fornecedorDocumento->id_fornecedor = $request->id_fornecedor;
        $fornecedorDocumento->id_documento = $documento->id;
        $fornecedorDocumento->save();

        $doc = DB::table('documento')
                        ->join('fornecedor_documento', 'documento.id', 'fornecedor_documento.id_documento')
                        ->join('fornecedor', 'fornecedor_documento.id_fornecedor', 'fornecedor.id')
                        ->join('tipo_documento', 'documento.id_tipo_documento', 'tipo_documento.id')
                        ->select('documento.*', 'tipo_documento.descricao', 'fornecedor.razao_social', 'fornecedor_documento.id_fornecedor')
                        ->where('documento.id', '=', $documento->id)->first();

        return response()->json($doc, 201);
    }

    public function uploadCliente(Request $request) {
        $validator = Validator::make($request->all(), [
                    'id_cliente' => 'required',
                    'id_documento' => 'required'
                        ], parent::$messages);

        if ($validator->fails()) {
            return response()->json([
                        'message' => 'Validação falhou',
                        'errors' => $validator->errors()
                            ], 422);
        }


        $file = $request->arquivo;
        if (!is_null($file)) {
            $filename = $file->getClientOriginalName(); //getBasename();

            $id_cliente = $request->id_cliente;
            $id_documento = $request->id_documento;

            $documento = Documento::find($id_documento);

            if (!empty($documento->caminho)) {
                $arquivoexclui = 'CLI_' . $id_cliente . '_DOC_' . $id_documento . '_' . $documento->caminho;
                $exists = Storage::disk('documentos')->exists($arquivoexclui);
                if ($exists) {
                    Storage::disk('documentos')->delete($arquivoexclui);
                }
            }

            $nomeArq = 'CLI_' . $id_cliente . '_DOC_' . $id_documento . '_' . $filename;

            $exists = Storage::disk('documentos')->exists($nomeArq);
            if (!$exists) {
                Storage::disk('documentos')->putFileAs('', $request->file('arquivo'), $nomeArq);
            }

            $documento->caminho = $filename;
            $documento->save();
        }

        return response()->json(['anexo' => $filename], 200);
    }
    
    public function uploadFornecedor(Request $request) {
        $validator = Validator::make($request->all(), [
                    'id_fornecedor' => 'required',
                    'id_documento' => 'required'
                        ], parent::$messages);

        if ($validator->fails()) {
            return response()->json([
                        'message' => 'Validação falhou',
                        'errors' => $validator->errors()
                            ], 422);
        }


        $file = $request->arquivo;
        if (!is_null($file)) {
            $filename = $file->getClientOriginalName(); //getBasename();

            $id_fornecedor = $request->id_fornecedor;
            $id_documento = $request->id_documento;

            $documento = Documento::find($id_documento);

            if (!empty($documento->caminho)) {
                $arquivoexclui = 'FOR_' . $id_fornecedor . '_DOC_' . $id_documento . '_' . $documento->caminho;
                $exists = Storage::disk('documentos')->exists($arquivoexclui);
                if ($exists) {
                    Storage::disk('documentos')->delete($arquivoexclui);
                }
            }

            $nomeArq = 'FOR_' . $id_fornecedor . '_DOC_' . $id_documento . '_' . $filename;

            $exists = Storage::disk('documentos')->exists($nomeArq);
            if (!$exists) {
                Storage::disk('documentos')->putFileAs('', $request->file('arquivo'), $nomeArq);
            }

            $documento->caminho = $filename;
            $documento->save();
        }

        return response()->json(['anexo' => $filename], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\acondicionamento  $documento
     * @return \Illuminate\Http\Response
     */
    public function showCliente($id) {
        $documento = DB::table('documento')
                        ->join('cliente_documento', 'documento.id', 'cliente_documento.id_documento')
                        ->join('cliente', 'cliente_documento.id_cliente', 'cliente.id')
                        ->join('tipo_documento', 'documento.id_tipo_documento', 'tipo_documento.id')
                        ->select('documento.*', 'tipo_documento.descricao', 'cliente.razao_social', 'cliente_documento.id_cliente')
                        ->where('documento.id', '=', $id)->first();
        return response()->json($documento, 200);
    }

    public function showFornecedor($id) {
        $documento = DB::table('documento')
                        ->join('fornecedor_documento', 'documento.id', 'fornecedor_documento.id_documento')
                        ->join('fornecedor', 'fornecedor_documento.id_fornecedor', 'fornecedor.id')
                        ->join('tipo_documento', 'documento.id_tipo_documento', 'tipo_documento.id')
                        ->select('documento.*', 'tipo_documento.descricao', 'fornecedor.razao_social', 'fornecedor_documento.id_fornecedor')
                        ->where('documento.id', '=', $id)->first();
        return response()->json($documento, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\acondicionamento  $documento
     * @return \Illuminate\Http\Response
     */
    public function updateCliente(Request $request, Documento $documento) {
        $validator = $this->Valitation($request);

        if ($validator->fails()) {
            return response()->json([
                        'message' => 'Validação falhou',
                        'errors' => $validator->errors() . ' variavel ' . $request->numero
                            ], 422);
        }

        $documento->update($request->all());

        $doc = DB::table('documento')
                        ->join('cliente_documento', 'documento.id', 'cliente_documento.id_documento')
                        ->join('cliente', 'cliente_documento.id_cliente', 'cliente.id')
                        ->join('tipo_documento', 'documento.id_tipo_documento', 'tipo_documento.id')
                        ->select('documento.*', 'tipo_documento.descricao', 'cliente.razao_social', 'cliente_documento.id_cliente')
                        ->where('documento.id', '=', $documento->id)->first();

        return response()->json($doc, 200);
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\acondicionamento  $documento
     * @return \Illuminate\Http\Response
     */
    public function updateFornecedor(Request $request, Documento $documento) {
        $validator = $this->Valitation($request);

        if ($validator->fails()) {
            return response()->json([
                        'message' => 'Validação falhou',
                        'errors' => $validator->errors() . ' variavel ' . $request->numero
                            ], 422);
        }

        $documento->update($request->all());

        $doc = DB::table('documento')
                        ->join('fornecedor_documento', 'documento.id', 'fornecedor_documento.id_documento')
                        ->join('fornecedor', 'fornecedor_documento.id_fornecedor', 'fornecedor.id')
                        ->join('tipo_documento', 'documento.id_tipo_documento', 'tipo_documento.id')
                        ->select('documento.*', 'tipo_documento.descricao', 'fornecedor.razao_social', 'fornecedor_documento.id_fornecedor')
                        ->where('documento.id', '=', $documento->id)->first();

        return response()->json($doc, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\acondicionamento  $documento
     * @return \Illuminate\Http\Response
     */
    public function destroyCliente(Documento $documento) {
        
        $cliente_documento = ClienteDocumento::where('id_documento', $documento->id)->get()->first();
                
        if (!empty($documento->caminho)) {
            $arquivoexclui = 'CLI_' . $cliente_documento->id_cliente . '_DOC_' . $cliente_documento->id_documento . '_' . $documento->caminho;
            $exists = Storage::disk('documentos')->exists($arquivoexclui);
            if ($exists) {
                Storage::disk('documentos')->delete($arquivoexclui);
            }
        }
        
        $cliente_documento->delete();
        $documento->delete();
        return response()->json(null, 200);
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\acondicionamento  $documento
     * @return \Illuminate\Http\Response
     */
    public function destroyFornecedor(Documento $documento) {
        
        $fornecedor_documento = FornecedorDocumento::where('id_documento', $documento->id)->get()->first();
        
        if (!empty($documento->caminho)) {
            $arquivoexclui = 'FOR_' . $fornecedor_documento->id_fornecedor . '_DOC_' . $fornecedor_documento->id_documento . '_' . $documento->caminho;
            $exists = Storage::disk('documentos')->exists($arquivoexclui);
            if ($exists) {
                Storage::disk('documentos')->delete($arquivoexclui);
            }
        }
        
        $fornecedor_documento->delete();
        $documento->delete();
        return response()->json(null, 200);
    }

}
