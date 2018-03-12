<?php

namespace App\Http\Controllers;

use App\LocacaoEquipamento;
use App\Locacao;
use App\Servico;
use App\Manifesto;
use App\Http\Resources\LocacaoEquipamentoCollection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use Illuminate\Validation\Rule;
use Validator;

class LocacaoEquipamentoController extends Controller {

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
            $desc = array('id', '=', $request->input('id'));
            array_push($arr, $desc);
        }

        if ($request->has('id_contrato')) {
            $desc = array('id_contrato_cliente', '=', $request->input('id_contrato'));
            array_push($arr, $desc);
        }

        if (count($arr) > 0) {
            $Manifestoservico = new LocacaoEquipamentoCollection(LocacaoEquipamento::where($arr)->with(['locacao', 'equipamento'])->orderBy($orderkey, $order)->paginate($nrcount));            
        } else {
            $Manifestoservico = new LocacaoEquipamentoCollection(LocacaoEquipamento::with(['locacao', 'equipamento'])->orderBy($orderkey, $order)->paginate($nrcount));
        }


        return $Manifestoservico->response()->setStatusCode(200); //response()->json($Manifestoservico,200);
    }

    
    public function listLocacaoEquipamento() {
        $Manifestoservico = LocacaoEquipamento::all();
        return response()->json($Manifestoservico, 200);
    }
    
    /**
     * Lista residuos
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function listEquipamentoLocacao(Request $request) {
        $arr = array();        

        if ($request->has('id_contrato_cliente')) {
            $desc = array('cce.id_contrato_cliente', '=', $request->input('id_contrato_cliente'));            
            array_push($arr, $desc);            
        }               
        
        $lista = DB::table('contrato_cliente_equipamento as cce')                    
                    ->join('equipamento as equip', 'cce.id_equipamento', 'equip.id')                    
                    ->select('equip.id as id_equipamento','cce.unidade', 'equip.descricao as equipamento')
                    ->where($arr)
                    ->orderBy('equip.descricao')
                    ->get();
            return response()->json($lista, 201);
    }
    
    

    /**
     * Metodo de validação da classe.
     *
     * @param  \App\LocacaoEquipamento  $Manifestoservico
     * @return \Illuminate\Support\Facades\Validator
     */
    private function Valitation(LocacaoEquipamento $Manifestoservico) {
        $validator = Validator::make($Manifestoservico->toArray(), [
                    'id_locacao' => 'required',                    
                    'id_equipamento' => 'required',                                        
                    'unidade' => 'required',
                    'quantidade' => 'required',                    
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
                    $locacaoequipamento = LocacaoEquipamento::find($item['id']);
                    $locacaoequipamento->fill($item);
                    $validator = $this->Valitation($locacaoequipamento);

                    if ($validator->fails()) {
                        return response()->json([
                                    'error' => 'Validação falhou',
                                    'message' => $validator->errors()->all(),
                                        ], 422);
                    }
                    $locacaoequipamento->save();
                } else {
                    //fluxo de criação
                    $locacaoequipamento = new LocacaoEquipamento();
                    $locacaoequipamento->fill($item);
                    $validator = $this->Valitation($locacaoequipamento);

                    if ($validator->fails()) {
                        return response()->json([
                                    'error' => 'Validação falhou',
                                    'message' => $validator->errors()->all(),
                                        ], 422);
                    }
                    $locacaoequipamento->save();
                }
            }

            $lista = DB::table('locacao_equipamento')
                    ->join('locacao', 'id_locacao', 'locacao.id')                    
                    ->join('equipamento', 'locacao_equipamento.id_equipamento', 'equipamento.id')                    
                    ->select('locacao_equipamento.*', 'equipamento.descricao as equipamento')
                    ->where('locacao_equipamento.id_locacao', '=', $id)
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
     * @param  \App\Locacao  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {        
        $lista = DB::table('locacao_equipamento')
                    ->join('locacao', 'id_locacao', 'locacao.id')                    
                    ->join('equipamento', 'locacao_equipamento.id_equipamento', 'equipamento.id')                    
                    ->select('locacao_equipamento.*', 'equipamento.descricao as equipamento')
                    ->where('locacao_equipamento.id_locacao', '=', $id)
                    ->get();        
        return response()->json($lista, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Locacao  $locacao
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Locacao $locacao) {
        if ($request->has('data')) {
            $data = $request->data;
            $id = $data[0]['id_locacao'];

            foreach ($data as $item) {
                $locacaoequipamento = LocacaoEquipamento::find($item['id']);
                $locacaoequipamento->fill($item);
                $validator = $this->Valitation($locacaoequipamento);

                if ($validator->fails()) {
                    return response()->json([
                                'error' => 'Validação falhou',
                                'message' => $validator->errors()->all(),
                                    ], 422);
                }

                $locacaoequipamento->save();
            }

            $lista = DB::table('locacao_equipamento')
                    ->join('locacao', 'id_locacao', 'locacao.id')                    
                    ->join('equipamento', 'locacao_equipamento.id_equipamento', 'equipamento.id')                    
                    ->select('locacao_equipamento.*', 'equipamento.descricao as equipamento')
                    ->where('locacao_equipamento.id_locacao', '=', $id)
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
     * @param  \App\LocacaoEquipamento  $locacaoequipamento
     * @return \Illuminate\Http\Response
     */
    public function destroy(LocacaoEquipamento $locacaoequipamento) {
        $locacaoequipamento->delete();
        return response()->json(null, 200);
    }
        
}
