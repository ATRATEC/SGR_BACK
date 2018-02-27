<?php

namespace App\Http\Controllers;

use App\ClienteDocumento;
use App\Exceptions\APIException;
use Illuminate\Http\Request;
use Illuminate\Http\File;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use Illuminate\Validation\Rule;
use Validator;

class ClienteDocumentoController extends Controller {

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
            $desc = array('numero', 'like', '%' . $request->input('numero') . '%');
            array_push($arr, $desc);
        }

        if (count($arr) > 0) {
            $documento = DB::table('cliente_documento')                            
                            ->join('cliente', 'cliente_documento.id_cliente', 'cliente.id')
                            ->join('tipo_documento', 'cliente_documento.id_tipo_documento', 'tipo_documento.id')
                            ->select('cliente_documento.*', 'tipo_documento.descricao', 'cliente.razao_social', 'cliente_documento.id_cliente')
                            ->where($arr)
                            ->orderBy($orderkey, $order)->paginate($nrcount);
        } else {
            $documento = DB::table('cliente_documento')                            
                            ->join('cliente', 'cliente_documento.id_cliente', 'cliente.id')
                            ->join('tipo_documento', 'cliente_documento.id_tipo_documento', 'tipo_documento.id')
                            ->select('cliente_documento.*', 'tipo_documento.descricao', 'cliente.razao_social')->orderBy($orderkey, $order)->paginate($nrcount);
        }

        return response()->json($documento, 200);        
    }
    
    public function listClienteDocumento() {
        $clientedocumentos = ClienteDocumento::all();
        return response()->json($clientedocumentos, 200);
    }

    /**
     * Metodo de validação da classe.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Support\Facades\Validator
     */
    private function ValitationStore(Request $request) {
        $validator = Validator::make($request->all(), [
                    'id_cliente' => 'required',
                    'id_tipo_documento' => 'required',
                    'emissao' => 'required|Date',
                    'vencimento' => 'required|Date',
                    'numero' => ['required',                                 
                                Rule::unique('cliente_documento','numero')->where(function ($query) use ($request) {
                                $query->where('id_cliente', $request->id_cliente);
                                }),
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
    private function ValitationUpdate(Request $request, ClienteDocumento $clientedocumento) {
        $validator = Validator::make($request->all(), [
                    'id_cliente' => 'required',
                    'id_tipo_documento' => 'required',
                    'emissao' => 'required|Date',
                    'vencimento' => 'required|Date',                    
                    'numero' => ['required',
                                 Rule::unique('cliente_documento','numero')->ignore($clientedocumento->id)->where(function ($query) use ($request) {
                                    $query->where('id_cliente', $request->id_cliente);
                                    }),   
                                    'max:20'],
                        ], parent::$messages);

        return $validator;
    }
    
    public function validaClienteDocumento($id_cliente, $numero, $id)
    {
        $arr = array();
        
        $condcli = array('id_cliente', '=', $id_cliente);
        array_push($arr, $condcli);
        
        $condtipo = array('numero', '=', $numero);
        array_push($arr, $condtipo);
        
        if (isset($id))
        {
            $condid = array('id', '<>', $id);
            array_push($arr, $condid);
        }
        
        $clientedocumento = ClienteDocumento::where($arr)->get();
        
        return $clientedocumento->count() > 0;                
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
        
//        if ($this->validaClienteDocumento($request->id_cliente, $request->numero, null))
//        {
//            throw new APIException('Documento jÃ¡ informado para o cliente');
//        }
                        
        $clienteDocumento = new ClienteDocumento();
        $clienteDocumento->fill($request->all());        
        $clienteDocumento->save();

        $doc = DB::table('cliente_documento')                        
                        ->join('cliente', 'cliente_documento.id_cliente', 'cliente.id')
                        ->join('tipo_documento', 'cliente_documento.id_tipo_documento', 'tipo_documento.id')
                        ->select('cliente_documento.*', 'tipo_documento.descricao', 'cliente.razao_social', 'cliente_documento.id_cliente')
                        ->where('cliente_documento.id', '=', $clienteDocumento->id)->first();

        return response()->json($doc, 201);
    }
    
    public function upload(Request $request) {
        $validator = Validator::make($request->all(), [
                    'id_cliente' => 'required',
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

            $id_cliente = $request->id_cliente;
            $id_documento = $request->id_documento;

            $documento = ClienteDocumento::find($id_documento);

            if (!empty($documento->caminho)) {
                $arquivoexclui = 'CLI_' . $id_cliente . '_DOC_' . $id_documento . '_' . $documento->caminho;
                $exists = Storage::disk('documentos')->exists($arquivoexclui);
                if ($exists) 
                {
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
        
    /**
     * Display the specified resource.
     *
     * @param  \App\ClienteDocumento  $clientedocumento
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        $documento = DB::table('cliente_documento')                        
                        ->join('cliente', 'cliente_documento.id_cliente', 'cliente.id')
                        ->join('tipo_documento', 'cliente_documento.id_tipo_documento', 'tipo_documento.id')
                        ->select('cliente_documento.*', 'tipo_documento.descricao', 'cliente.razao_social', 'cliente_documento.id_cliente')
                        ->where('cliente_documento.id', '=', $id)->first();
        return response()->json($documento, 200);
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ClienteDocumento  $clientedocumento
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ClienteDocumento $clientedocumento) {
        $validator = $this->ValitationUpdate($request, $clientedocumento);

        if ($validator->fails()) {
            return response()->json([
                        'error' => 'Validação falhou',
                        'message' => $validator->errors()->all(),
                            ], 422);
        }
        
//        if ($this->validaClienteDocumento($request->id_cliente, $request->numero, $clientedocumento->id))
//        {
//            throw new APIException('Documento jÃ¡ informado para o cliente');
//        }
        
        $clientedocumento->update($request->all());
        
        $doc = DB::table('cliente_documento')                        
                        ->join('cliente', 'cliente_documento.id_cliente', 'cliente.id')
                        ->join('tipo_documento', 'cliente_documento.id_tipo_documento', 'tipo_documento.id')
                        ->select('cliente_documento.*', 'tipo_documento.descricao', 'cliente.razao_social', 'cliente_documento.id_cliente')
                        ->where('cliente_documento.id', '=', $clientedocumento->id)->first();

        return response()->json($doc, 200);
    }
        
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\acondicionamento  $clientedocumento
     * @return \Illuminate\Http\Response
     */
    public function destroy(ClienteDocumento $clientedocumento) {
                                
        if (!empty($clientedocumento->caminho)) {
            $arquivoexclui = 'CLI_' . $clientedocumento->id_cliente . '_DOC_' . $clientedocumento->id . '_' . $clientedocumento->caminho;
            $exists = Storage::disk('documentos')->exists($arquivoexclui);
            if ($exists) {
                Storage::disk('documentos')->delete($arquivoexclui);
            }
        }
        
        $clientedocumento->delete();        
        return response()->json(null, 200);
    }
            
    public function downloadAnexo(Request $request) {
        $file_path = public_path('documentos/'.$request->arquivo);
        return response()->download($file_path);
    }
    
    

}
