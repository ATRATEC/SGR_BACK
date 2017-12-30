<?php

namespace App\Http\Controllers;

use App\Documento;
use App\Http\Resources\DocumentoCollection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use Validator;

class DocumentoController extends Controller
{
    function __construct() {
        $this->content = array();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $nrcount = $request->input('nrcount', 15);
        $orderkey = $request->input('orderkey', 'id');
        $order = $request->input('order', 'asc');

        $arr = array();

        if ($request->has('id')) {
            $desc = array('id', '=', $request->input('id'));
            array_push($arr, $desc);
        }
        
        if ($request->has('id_cliente')) {
            $desc = array('id_cliente', '=', $request->input('id_cliente'));
            array_push($arr, $desc);
        }
        
        if ($request->has('id_fornecedor')) {
            $desc = array('id_fornecedor', '=', $request->input('id_fornecedor'));
            array_push($arr, $desc);
        }
       
        if (count($arr) > 0) {
            if (array_search('id', $arr)) {
                $documento = new DocumentoCollection(Documento::where($arr)->orderBy($orderkey, $order)->paginate($nrcount));
            }
            
            if (array_search('id_cliente', $arr)) {
                $documento = new DocumentoCollection(Documento::clientes()->where($arr)->orderBy($orderkey, $order)->paginate($nrcount));
            }
            
            if (array_search('id_fornecedor', $arr)) {
                $documento = new DocumentoCollection(Documento::fornecedores()->where($arr)->orderBy($orderkey, $order)->paginate($nrcount));
            }                        
        } else {
            $documento = new DocumentoCollection(Documento::orderBy($orderkey, $order)->paginate($nrcount));
        }


        return $documento->response()->setStatusCode(200);
    }
    
    public function listDocumento()
    {
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
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
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
        return response()->json($documento, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\acondicionamento  $documento
     * @return \Illuminate\Http\Response
     */
    public function show(Documento $documento)
    {
        return response()->json($documento, 200);
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\acondicionamento  $documento
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Documento $documento)
    {
        $validator = $this->Valitation($request);

        if ($validator->fails()) {
            return response()->json([
                        'message' => 'Validação falhou',
                        'errors' => $validator->errors()
                            ], 422);
        }
        
        $documento->update($request->all());

        return response()->json($documento, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\acondicionamento  $documento
     * @return \Illuminate\Http\Response
     */
    public function destroy(Documento $documento)
    {
        $documento->delete();
        return response()->json(null, 200);
    }
}
