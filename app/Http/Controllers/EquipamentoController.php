<?php

namespace App\Http\Controllers;

use App\Equipamento;
use App\Http\Resources\EquipamentoCollection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use Validator;

class EquipamentoController extends Controller
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
            $equipamento = new EquipamentoCollection(Equipamento::where($arr)->orderBy($orderkey, $order)->paginate($nrcount));
            // $equipamento = DB::table('equipamento')->where($arr)->orderBy($orderkey, $order)->paginate($nrcount);
        } else {
            $equipamento = new EquipamentoCollection(Equipamento::orderBy($orderkey, $order)->paginate($nrcount));
        }


        return $equipamento->response()->setStatusCode(200); //response()->json($equipamento,200);
    }
    
    public function listEquipamento() {
        $equipamento = Equipamento::all();
        return response()->json($equipamento, 200);
    }
    
    /**
     * Metodo de validação da classe.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Support\Facades\Validator
     */
    private function ValitationStore(Request $request) {        
        $validator = Validator::make($request->all(), [
                    'descricao' => 'required|unique:equipamento|max:50'
        ], parent::$messages);

        return $validator;
    }
    
    /**
     * Metodo de validação da classe.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Support\Facades\Validator
     */
    private function ValitationUpdate(Request $request, Equipamento $equipamento) {        
        $validator = Validator::make($request->all(), [                            
                    'descricao' => ['required',
                                    Rule::unique('equipamento')->ignore($equipamento->id),
                                    'max:50'],
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
        $validator = $this->ValitationStore($request);

        if ($validator->fails()) {
            return response()->json([
                        'error' => 'Validação falhou',
                        'message' => $validator->errors()->all(),
                            ], 422);
        }

        $equipamento = new Equipamento();
        $equipamento->fill($request->all());
        $equipamento->save();
        return response()->json($equipamento, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\equipamento  $equipamento
     * @return \Illuminate\Http\Response
     */
    public function show(Equipamento $equipamento)
    {
        return response()->json($equipamento, 200);
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\equipamento  $equipamento
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Equipamento $equipamento)
    {
        $validator = $this->ValitationUpdate($request);

        if ($validator->fails()) {
            return response()->json([
                        'error' => 'Validação falhou',
                        'message' => $validator->errors()->all(),
                            ], 422);
        }
        
        $equipamento->update($request->all());

        return response()->json($equipamento, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\equipamento  $equipamento
     * @return \Illuminate\Http\Response
     */
    public function destroy(Equipamento $equipamento)
    {
        $equipamento->delete();
        return response()->json(null, 200);
    }
}
