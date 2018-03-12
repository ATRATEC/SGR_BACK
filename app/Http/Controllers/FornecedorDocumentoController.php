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
                            ->orderBy($orderkey, $order)->get();
        } else {
            $documento = DB::table('fornecedor_documento')                            
                            ->join('fornecedor', 'fornecedor_documento.id_fornecedor', 'fornecedor.id')
                            ->join('tipo_documento', 'fornecedor_documento.id_tipo_documento', 'tipo_documento.id')
                            ->select('fornecedor_documento.*', 'tipo_documento.descricao', 'fornecedor.razao_social')->orderBy($orderkey, $order)->get();
        }

        return response()->json($documento, 200);        
    }
    
    public function listFornecedorDocumentoAnexo($id) {
        $fornecedordocumentos = DB::table('fornecedor_documento')                            
                            ->join('fornecedor', 'fornecedor_documento.id_fornecedor', 'fornecedor.id')
                            ->join('tipo_documento', 'fornecedor_documento.id_tipo_documento', 'tipo_documento.id')
                            ->select('fornecedor_documento.*', 'tipo_documento.descricao', 'fornecedor.razao_social')
                            ->where('fornecedor_documento.id_fornecedor', '=', $id)
                            ->whereNotNull('fornecedor_documento.caminho')
                            ->get();
        return response()->json($fornecedordocumentos, 200);
    }
    
    public function listFornecedorDocumento() {
        $fornecedordocumentos = FornecedorDocumento::all();
        return response()->json($fornecedordocumentos, 200);
    }

    /**
     * Metodo de validação da classe.
     *
     * @param  \App\FornecedorDocumento $fornecedordocumento
     * @return \Illuminate\Support\Facades\Validator
     */
    private function ValitationStore(FornecedorDocumento $fornecedordocumento) {
        $validator = Validator::make($fornecedordocumento->toArray(), [
                    'id_fornecedor' => 'required',
                    'id_tipo_documento' => 'required',
                    'emissao' => 'required|Date',
                    'vencimento' => 'required|Date',
                    'numero' => ['required',                                 
                                Rule::unique('fornecedor_documento','numero')->where(function ($query) use ($fornecedordocumento) {
                                $query->where('id_fornecedor', $fornecedordocumento->id_fornecedor);
                                }),
                                 'max:20'],
                        ], parent::$messages);

        return $validator;
    }
    
    /**
     * Metodo de validação da classe.
     *
     * @param  \App\FornecedorDocumento $fornecedordocumento
     * @return \Illuminate\Support\Facades\Validator
     */
    private function ValitationUpdate(FornecedorDocumento $fornecedordocumento) {
        $validator = Validator::make($fornecedordocumento->toArray(), [
                    'id_fornecedor' => 'required',
                    'id_tipo_documento' => 'required',
                    'emissao' => 'required|Date',
                    'vencimento' => 'required|Date',                    
                    'numero' => ['required',
                                 Rule::unique('fornecedor_documento','numero')->ignore($fornecedordocumento->id)->where(function ($query) use ($fornecedordocumento) {
                                    $query->where('id_fornecedor', $fornecedordocumento->id_fornecedor);
                                    }),   
                                    'max:20'],
                        ], parent::$messages);

        return $validator;
    }
    
    public function validaFornecedorDocumento($id_fornecedor, $numero, $id)
    {
        $arr = array();
        
        $condcli = array('id_fornecedor', '=', $id_fornecedor);
        array_push($arr, $condcli);
        
        $condtipo = array('numero', '=', $numero);
        array_push($arr, $condtipo);
        
        if (isset($id))
        {
            $condid = array('id', '<>', $id);
            array_push($arr, $condid);
        }
        
        $fornecedordocumento = FornecedorDocumento::where($arr)->get();
        
        return $fornecedordocumento->count() > 0;                
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
        if ($request->has('data')) {
            $id = $request->id;
            $data = $request->data;

            foreach ($data as $item) {
                if (isset($item['id'])) {
                    //Fluxo de atualização / deleção                    
                    $fornecedordocumento = FornecedorDocumento::find($item['id']);
                    $fornecedordocumento->fill($item);
                    $validator = $this->ValitationUpdate($fornecedordocumento);
                                       
                    if ($validator->fails()) {
                        return response()->json([
                                    'error' => 'Validação falhou',
                                    'message' => $validator->errors()->all(),
                                        ], 422);
                    }
                    $fornecedordocumento->save();
                } else {
                    //fluxo de criação
                    $fornecedordocumento = new FornecedorDocumento();
                    $fornecedordocumento->fill($item);
                    $validator = $this->ValitationStore($fornecedordocumento);
                                        
                    if ($validator->fails()) {
                        return response()->json([
                                    'error' => 'Validação falhou',
                                    'message' => $validator->errors()->all(),
                                        ], 422);
                    }
                    $fornecedordocumento->save();
                }
            }
            
            $doc = DB::table('fornecedor_documento')                        
                ->join('fornecedor', 'fornecedor_documento.id_fornecedor', 'fornecedor.id')
                ->join('tipo_documento', 'fornecedor_documento.id_tipo_documento', 'tipo_documento.id')
                ->select('fornecedor_documento.*', 'tipo_documento.descricao', 'fornecedor.razao_social', 'fornecedor_documento.id_fornecedor')
                ->where('fornecedor_documento.id_fornecedor', '=', $id)
                ->get();

            return response()->json($doc, 201);           
        }
        return response()->json([
                    'error' => 'Validação falhou',
                    'message' => 'Nenhum dado enviado para gravação',
                        ], 422);
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

            $documento = FornecedorDocumento::find($id_documento);

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
     * @param  \App\contratofornecedorresiduo  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        $documento = DB::table('fornecedor_documento')                        
                        ->join('fornecedor', 'fornecedor_documento.id_fornecedor', 'fornecedor.id')
                        ->join('tipo_documento', 'fornecedor_documento.id_tipo_documento', 'tipo_documento.id')
                        ->select('fornecedor_documento.*', 'tipo_documento.descricao', 'fornecedor.razao_social', 'fornecedor_documento.id_fornecedor')
                        ->where('fornecedor_documento.id_fornecedor', '=', $id)
                        ->get();
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
        
//        if ($this->validaFornecedorDocumento($request->id_fornecedor, $request->numero, $fornecedordocumento->id))
//        {
//            throw new APIException('Documento jÃ¡ informado para o fornecedor');
//        }
        
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
    
    public function deleteAnexo(FornecedorDocumento $fornecedordocumento) {
                                
        if (!empty($fornecedordocumento->caminho)) {
            $arquivoexclui = 'FOR_' . $fornecedordocumento->id_fornecedor . '_DOC_' . $fornecedordocumento->id . '_' . $fornecedordocumento->caminho;
            $exists = Storage::disk('documentos')->exists($arquivoexclui);
            if ($exists) {
                Storage::disk('documentos')->delete($arquivoexclui);
            }
            $fornecedordocumento->caminho = null;
            $fornecedordocumento->save();
        }                
        return response()->json(null, 200);
    }
            
    public function downloadAnexo(Request $request) {
        $file_path = public_path('documentos/'.$request->arquivo);
        return response()->download($file_path);
    }
    
    

}
