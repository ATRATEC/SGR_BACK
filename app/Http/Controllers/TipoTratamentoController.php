<?php

namespace App\Http\Controllers;

use App\TipoTratamento;
use App\Http\Resources\TipoTratamentoCollection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use Validator;

class TipoTratamentoController extends Controller
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
            $tipotratamento = new TipoTratamentoCollection(TipoTratamento::where($arr)->orderBy($orderkey, $order)->paginate($nrcount));
            // $tipotratamento = DB::table('tipotratamento')->where($arr)->orderBy($orderkey, $order)->paginate($nrcount);
        } else {
            $tipotratamento = new TipoTratamentoCollection(TipoTratamento::orderBy($orderkey, $order)->paginate($nrcount));
        }


        return $tipotratamento->response()->setStatusCode(200); //response()->json($tipotratamento,200);
    }
    
    public function listTipoTratamento() {
        $tipotratamento = TipoTratamento::all();
        return response()->json($tipotratamento, 200);
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

        $tipotratamento = new TipoTratamento();
        $tipotratamento->fill($request->all());
        $tipotratamento->save();
        return response()->json($tipotratamento, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\tipotratamento  $tipotratamento
     * @return \Illuminate\Http\Response
     */
    public function show(TipoTratamento $tipotratamento)
    {
        return response()->json($tipotratamento, 200);
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\tipotratamento  $tipotratamento
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TipoTratamento $tipotratamento)
    {
        $validator = $this->Valitation($request);

        if ($validator->fails()) {
            return response()->json([
                        'message' => 'Validação falhou',
                        'errors' => $validator->errors()
                            ], 422);
        }
        
        $tipotratamento->update($request->all());

        return response()->json($tipotratamento, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\tipotratamento  $tipotratamento
     * @return \Illuminate\Http\Response
     */
    public function destroy(TipoTratamento $tipotratamento)
    {
        $tipotratamento->delete();
        return response()->json(null, 200);
    }
}
