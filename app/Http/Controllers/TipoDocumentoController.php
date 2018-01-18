<?php

namespace App\Http\Controllers;

use App\TipoDocumento;
use App\Http\Resources\TipoDocumentoCollection;
use App\Exceptions\APIException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use Validator;

class TipoDocumentoController extends Controller
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
        
        if ($request->has('descricao')) {
            $desc = array('descricao', 'like', '%' . $request->input('descricao') . '%');
            array_push($arr, $desc);
        }
       
        if (count($arr) > 0) {
            $tipodocumento = new TipoDocumentoCollection(TipoDocumento::where($arr)->orderBy($orderkey, $order)->paginate($nrcount));
        } else {
            $tipodocumento = new TipoDocumentoCollection(TipoDocumento::orderBy($orderkey, $order)->paginate($nrcount));
        }


        return $tipodocumento->response()->setStatusCode(200);
    }
    
    public function listTipoDocumento()
    {
        $tipodocumentos = TipoDocumento::all();
        return response()->json($tipodocumentos, 200);
    }
    
    /**
     * Metodo de validação da classe.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Support\Facades\Validator
     */
    private function Valitation(Request $request) {        
        $validator = Validator::make($request->all(), [                            
                    'descricao' => 'required|max:50'                    
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

        $tipodocumento = new TipoDocumento();
        $tipodocumento->fill($request->all());
        $tipodocumento->save();
        return response()->json($tipodocumento, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\acondicionamento  $tipodocumento
     * @return \Illuminate\Http\Response
     */
    public function show(TipoDocumento $tipodocumento)
    {
        return response()->json($tipodocumento, 200);
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\acondicionamento  $tipodocumento
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TipoDocumento $tipodocumento)
    {
        $validator = $this->Valitation($request);

        if ($validator->fails()) {
            return response()->json([
                        'message' => 'Validação falhou',
                        'errors' => $validator->errors()
                            ], 422);
        }
        
        $tipodocumento->update($request->all());

        return response()->json($tipodocumento, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\acondicionamento  $tipodocumento
     * @return \Illuminate\Http\Response
     */
    public function destroy(TipoDocumento $tipodocumento)
    {        
        if (count($tipodocumento->documentos()->get()) > 0){
            throw new APIException('Tipo de documento não pode ser excluído. Pois esta sendo utilizado em um ou mais documentos');
        }
        $tipodocumento->delete();
        return response()->json(null, 200);
    }
}
