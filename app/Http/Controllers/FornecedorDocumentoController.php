<?php

namespace App\Http\Controllers;

use App\FornecedorDocumento;
use App\Exceptions\APIException;
use Illuminate\Http\Request;
use Illuminate\Http\File;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use Illuminate\Validation\Rule;
use Validator;

class FornecedorDocumentoController extends Controller {

    function __construct() {
        $this->content = array();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request) {
        $nrcount = $request->input('nrcount', 15);
        $orderkey = $request->input('orderkey', 'id');
        $order = $request->input('order', 'asc');

        $arr = array();

        if ($request->has('id')) {
            $desc = array('documento.id', '=', $request->input('id'));
            array_push($arr, $desc);
        }

        if ($request->has('id_fornecedor')) {
            $desc = array('id_fornecedor', '=', $request->input('id_fornecedor'));
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
            $desc = array('numero', 'like', '%' . $request->input('numero') . '%');
            array_push($arr, $desc);
        }

        if (count($arr) > 0) {
            $documento = DB::table('fornecedor_documento')                            
                            ->join('fornecedor', 'fornecedor_documento.id_fornecedor', 'fornecedor.id')
                            ->join('tipo_documento', 'fornecedor_documento.id_tipo_documento', 'tipo_documento.id')
                            ->select('fornecedor_documento.*', 'tipo_documento.descricao', 'fornecedor.razao_social', 'fornecedor_documento.id_fornecedor')
                            ->where($arr)
                            ->orderBy($orderkey, $order)->paginate($nrcount);
        } else {
            $documento = DB::table('fornecedor_documento')                            
                            ->join('fornecedor', 'fornecedor_documento.id_fornecedor', 'fornecedor.id')
                            ->join('tipo_documento', 'fornecedor_documento.id_tipo_documento', 'tipo_documento.id')
                            ->select('fornecedor_documento.*', 'tipo_documento.descricao', 'fornecedor.razao_social')->orderBy($orderkey, $order)->paginate($nrcount);
        }

        return response()->json($documento, 200);        
    }
    
    public function listFornecedorDocumento() {
        $fornecedordocumentos = FornecedorDocumento::all();
        return response()->json($fornecedordocumentos, 200);
    }

    /**
     * Metodo de validação da classe.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Support\Facades\Validator
     */
    private function ValitationStore(Request $request) {
        $validator = Validator::make($request->all(), [
                    'id_fornecedor' => 'required',
                    'id_tipo_documento' => 'required',
                    'emissao' => 'required|Date',
                    'vencimento' => 'required|Date',
                    'numero' => ['required',                                 
                                'unique:fornecedor_documento,numero, id_fornecedor',
                                 'max:20'],
                        ], parent::$messages);

        return $validator;
    }
    
    /**
     * Metodo de validação da classe.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Support\Facades\Validator
     */
    private function ValitationUpdate(Request $request, FornecedorDocumento $fornecedordocumento) {
        $validator = Validator::make($request->all(), [
                    'id_fornecedor' => 'required',
                    'id_tipo_documento' => 'required',
                    'emissao' => 'required|Date',
                    'vencimento' => 'required|Date',                    
                    'numero' => ['required',
                                    Rule::unique('fornecedor_documento','numero','id_fornecedor')->ignore($fornecedordocumento->id),
                                    'max:20'],
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
    public function store(Request $request) {
        $validator = $this->ValitationStore($request);

        if ($validator->fails()) {
            return response()->json([
                        'error' => 'Validação falhou',
                        'message' => $validator->errors()->all(),
                            ], 422);
        }
                        
        $fornecedorDocumento = new FornecedorDocumento();
        $fornecedorDocumento->fill($request->all());        
        $fornecedorDocumento->save();

        $doc = DB::table('fornecedor_documento')                        
                        ->join('fornecedor', 'fornecedor_documento.id_fornecedor', 'fornecedor.id')
                        ->join('tipo_documento', 'fornecedor_documento.id_tipo_documento', 'tipo_documento.id')
                        ->select('fornecedor_documento.*', 'tipo_documento.descricao', 'fornecedor.razao_social', 'fornecedor_documento.id_fornecedor')
                        ->where('fornecedor_documento.id', '=', $fornecedorDocumento->id)->first();

        return response()->json($doc, 201);
    }
    
    public function upload(Request $request) {
        $validator = Validator::make($request->all(), [
                    'id_fornecedor' => 'required',
                    'id_documento' => 'required'
                        ], parent::$messages);

        if ($validator->fails()) {
            return response()->json([
                        'error' => 'Validação falhou',
                        'message' => $validator->errors()->all(),
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
                if ($exists) 
                {
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
     * @param  \App\FornecedorDocumento  $fornecedordocumento
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        $documento = DB::table('fornecedor_documento')                        
                        ->join('fornecedor', 'fornecedor_documento.id_fornecedor', 'fornecedor.id')
                        ->join('tipo_documento', 'fornecedor_documento.id_tipo_documento', 'tipo_documento.id')
                        ->select('fornecedor_documento.*', 'tipo_documento.descricao', 'fornecedor.razao_social', 'fornecedor_documento.id_fornecedor')
                        ->where('fornecedor_documento.id', '=', $id)->first();
        return response()->json($documento, 200);
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\FornecedorDocumento  $fornecedordocumento
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, FornecedorDocumento $fornecedordocumento) {
        $validator = $this->ValitationUpdate($request, $fornecedordocumento);

        if ($validator->fails()) {
            return response()->json([
                        'error' => 'Validação falhou',
                        'message' => $validator->errors()->all(),
                            ], 422);
        }
        
        $fornecedordocumento->update($request->all());
        
        $doc = DB::table('fornecedor_documento')                        
                        ->join('fornecedor', 'fornecedor_documento.id_fornecedor', 'fornecedor.id')
                        ->join('tipo_documento', 'fornecedor_documento.id_tipo_documento', 'tipo_documento.id')
                        ->select('fornecedor_documento.*', 'tipo_documento.descricao', 'fornecedor.razao_social', 'fornecedor_documento.id_fornecedor')
                        ->where('fornecedor_documento.id', '=', $fornecedordocumento->id)->first();

        return response()->json($doc, 200);
    }
        
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\acondicionamento  $fornecedordocumento
     * @return \Illuminate\Http\Response
     */
    public function destroy(FornecedorDocumento $fornecedordocumento) {
                                
        if (!empty($fornecedordocumento->caminho)) {
            $arquivoexclui = 'FOR_' . $fornecedordocumento->id_fornecedor . '_DOC_' . $fornecedordocumento->id . '_' . $fornecedordocumento->caminho;
            $exists = Storage::disk('documentos')->exists($arquivoexclui);
            if ($exists) {
                Storage::disk('documentos')->delete($arquivoexclui);
            }
        }
        
        $fornecedordocumento->delete();        
        return response()->json(null, 200);
    }
            
    public function downloadAnexo(Request $request) {
        $file_path = public_path('documentos/'.$request->arquivo);
        return response()->download($file_path);
    }
    
    

}
