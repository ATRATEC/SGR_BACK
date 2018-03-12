<?php

namespace App\Http\Controllers;

use App\ContratoClienteEquipamento;
use App\ContratoCliente;
use App\Http\Resources\ContratoClienteEquipamentoCollection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use Illuminate\Validation\Rule;
use Validator;

class ContratoClienteEquipamentoController extends Controller {

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
            $desc = array('contrato_cliente_equipamento.id', '=', $request->input('id'));
            array_push($arr, $desc);
        }

        if ($request->has('id_contrato')) {
            $desc = array('contrato_cliente_equipamento.id_contrato_cliente', '=', $request->input('id_contrato'));
            array_push($arr, $desc);
        }

        if (count($arr) > 0) {
            //$contratoclienteequipamento = new ContratoClienteEquipamentoCollection(ContratoClienteEquipamento::where($arr)->with(['contrato_fornecedor', 'residuo'])->orderBy($orderkey, $order)->paginate($nrcount));
            // $contratoclienteequipamento = DB::table('contratoclienteequipamento')->where($arr)->orderBy($orderkey, $order)->paginate($nrcount);
            $contratoclienteequipamento = DB::table('contrato_cliente_equipamento')
                    ->join('equipamento', 'id_equipamento', 'equipamento.id')                    
                    ->select('contrato_cliente_equipamento.*', 'equipamento.descricao as equipamento')
                    ->where($arr)
                    ->orderBy('contrato_cliente_equipamento.id', 'asc')                    
                    ->get();
        } else {
            $contratoclienteequipamento = DB::table('contrato_cliente_equipamento')
                    ->join('equipamento', 'id_equipamento', 'equipamento.id')                    
                    ->select('contrato_cliente_equipamento.*', 'equipamento.descricao as equipamento')
                    ->where('contrato_cliente_equipamento.id_contrato_cliente', '=', $request->input('id'))
                    ->orderBy('contrato_cliente_equipamento.id', 'asc')                    
                    ->get();
           // $contratoclienteequipamento = new ContratoClienteEquipamentoCollection(ContratoClienteEquipamento::with(['contrato_fornecedor', 'fornecedor', 'residuo'])->orderBy($orderkey, $order)->paginate($nrcount));
        }
        
        return response()->json($contratoclienteequipamento,200);

        //return $contratoclienteequipamento->response()->setStatusCode(200); //response()->json($contratoclienteequipamento,200);
    }

    public function listContratoClienteEquipamento() {
        $contratoclienteequipamento = ContratoClienteEquipamento::all();
        return response()->json($contratoclienteequipamento, 200);
    }

    /**
     * Metodo de validação da classe.
     *
     * @param  \App\ContratoClienteEquipamento  $contratoclienteequipamento
     * @return \Illuminate\Support\Facades\Validator
     */
    private function Valitation(ContratoClienteEquipamento $contratoclienteequipamento) {
        $validator = Validator::make($contratoclienteequipamento->toArray(), [
                    'id_contrato_cliente' => 'required',
                    'id_equipamento' => 'required',                    
                    'preco' => 'required',                    
                    'unidade' => 'required',                    
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
        if ($request->has('data')) {
            $id = $request->id;
            $data = $request->data;

            foreach ($data as $item) {
                if (isset($item['id'])) {
                    //Fluxo de atualização / deleção                    
                    $contratoresiduo = ContratoClienteEquipamento::find($item['id']);
                    $contratoresiduo->fill($item);
                    $validator = $this->Valitation($contratoresiduo);

                    if ($validator->fails()) {
                        return response()->json([
                                    'error' => 'Validação falhou',
                                    'message' => $validator->errors()->all(),
                                        ], 422);
                    }
                    $contratoresiduo->save();
                } else {
                    //fluxo de criação
                    $contratoresiduo = new ContratoClienteEquipamento();
                    $contratoresiduo->fill($item);
                    $validator = $this->Valitation($contratoresiduo);

                    if ($validator->fails()) {
                        return response()->json([
                                    'error' => 'Validação falhou',
                                    'message' => $validator->errors()->all(),
                                        ], 422);
                    }
                    $contratoresiduo->save();
                }
            }

            $lista = DB::table('contrato_cliente_equipamento')
                    ->join('equipamento', 'id_equipamento', 'equipamento.id')                    
                    ->select('contrato_cliente_equipamento.*', 'equipamento.descricao as equipamento')
                    ->where('contrato_cliente_equipamento.id_contrato_cliente', '=', $id)
                    ->get();
            return response()->json($lista, 201);
        }
        return response()->json([
                    'error' => 'Validação falhou',
                    'message' => 'Nenhum dado enviado para gravação',
                        ], 422);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\contratoclienteequipamento  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        // $contratoclienteequipamento = ContratoClienteEquipamento::where('id_contrato_cliente', $id)->get();
        $lista = DB::table('contrato_cliente_equipamento')
                    ->join('equipamento', 'id_equipamento', 'equipamento.id')                    
                    ->select('contrato_cliente_equipamento.*', 'equipamento.descricao as equipamento')
                    ->where('contrato_cliente_equipamento.id_contrato_cliente', '=', $id)
                    ->orderBy('contrato_cliente_equipamento.id', 'asc')                    
                    ->get();
        //return response()->json($contratoclienteequipamento, 200);
        return response()->json($lista, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ContratoCliente  $contratofornecedor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ContratoCliente $contratofornecedor) {
        if ($request->has('data')) {
            $data = $request->data;
            $id = $data[0]['id_contrato'];

            foreach ($data as $item) {
                $contratoresiduo = ContratoClienteEquipamento::find($item['id']);
                $contratoresiduo->fill($item);
                $validator = $this->Valitation($contratoresiduo);

                if ($validator->fails()) {
                    return response()->json([
                                'error' => 'Validação falhou',
                                'message' => $validator->errors()->all(),
                                    ], 422);
                }

                $contratoresiduo->save();
            }

            $lista = DB::table('contrato_cli_contrato_for')
                    ->join('equipamento', 'id_equipamento', 'equipamento.id')                    
                    ->select('contrato_cliente_equipamento.*', 'equipamento.descricao as equipamento')
                    ->where('contrato_cli_contrato_for.id_contrato_cliente', '=', $id)
                    ->get();
            return response()->json($lista, 201);
        }
        return response()->json([
                    'error' => 'Validação falhou',
                    'message' => 'Nenhum dado enviado para gravação',
                        ], 422);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\contratoclienteequipamento  $contratoclienteequipamento
     * @return \Illuminate\Http\Response
     */
    public function destroy(ContratoClienteEquipamento $contratoclienteequipamento) {
        $contratoclienteequipamento->delete();
        return response()->json(null, 200);
    }

}
