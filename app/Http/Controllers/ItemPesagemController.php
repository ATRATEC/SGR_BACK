<?php

namespace App\Http\Controllers;

use App\ItemPesagem;
use App\Pesagem;
use App\Http\Resources\ItemPesagemCollection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use Illuminate\Validation\Rule;
use Validator;

class ItemPesagemController extends Controller {

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

        if ($request->has('id_contrato_cliente')) {
            $desc = array('id_contrato_cliente', '=', $request->input('id_contrato_cliente'));
            array_push($arr, $desc);
        }

        if (count($arr) > 0) {
            $itempesagem = new ItemPesagemCollection(ItemPesagem::where($arr)->with(['contrato_fornecedor', 'servico'])->orderBy($orderkey, $order)->paginate($nrcount));
            // $itempesagem = DB::table('Pesagemservico')->where($arr)->orderBy($orderkey, $order)->paginate($nrcount);
        } else {
            $itempesagem = new ItemPesagemCollection(ItemPesagem::with(['contrato_fornecedor', 'fornecedor', 'servico'])->orderBy($orderkey, $order)->paginate($nrcount));
        }


        return $itempesagem->response()->setStatusCode(200); //response()->json($itempesagem,200);
    }

    
    public function listItemPesagem() {
        $itempesagem = ItemPesagem::all();
        return response()->json($itempesagem, 200);
    }
    
    
    /**
     * Lista residuos
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function listResiduoItemPesagem(Request $request) {
        $arr = array();
               

        if ($request->has('id_contrato_cliente')) {
            $desc = array('ccr.id_contrato_cliente', '=', $request->input('id_contrato_cliente'));            
            array_push($arr, $desc);          
        }             
        
        $lista = DB::table('contrato_cliente_residuo as ccr')                    
                    ->join('residuo as res', 'ccr.id_residuo', 'res.id')
                    ->join('tipo_residuo as tr', 'res.id_tipo_residuo', 'tr.id')                    
                    ->select('res.id as id_residuo','res.id_tipo_residuo','ccr.unidade', 'tr.descricao as tipo_residuo', 'res.descricao as residuo')
                    ->where($arr)
                    ->whereIn('ccr.unidade', ['KG','TM','G'])
                    ->groupBy('res.id','res.id_tipo_residuo','ccr.unidade', 'tr.descricao', 'res.descricao')
                    ->orderBy('res.descricao')
                    ->get();
            return response()->json($lista, 201);
    }
    

    /**
     * Metodo de validação da classe.
     *
     * @param  \App\ItemPesagem  $itempesagem
     * @return \Illuminate\Support\Facades\Validator
     */
    private function Valitation(ItemPesagem $itempesagem) {
        $validator = Validator::make($itempesagem->toArray(), [
                    'id_pesagem' => 'required',                    
                    'id_residuo' => 'required',
                    'unidade' => 'required',
                    'peso' => 'required',                    
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
                    $itempesagem = ItemPesagem::find($item['id']);
                    $itempesagem->fill($item);
                    $validator = $this->Valitation($itempesagem);

                    if ($validator->fails()) {
                        return response()->json([
                                    'error' => 'Validação falhou',
                                    'message' => $validator->errors()->all(),
                                        ], 422);
                    }
                    $itempesagem->save();
                } else {
                    //fluxo de criação
                    $itempesagem = new ItemPesagem();
                    $itempesagem->fill($item);
                    $validator = $this->Valitation($itempesagem);

                    if ($validator->fails()) {
                        return response()->json([
                                    'error' => 'Validação falhou',
                                    'message' => $validator->errors()->all(),
                                        ], 422);
                    }
                    $itempesagem->save();
                }
            }

            $lista = DB::table('item_pesagem')
                    ->join('pesagem', 'id_pesagem', 'pesagem.id')                    
                    ->join('residuo', 'item_pesagem.id_residuo', 'residuo.id')                    
                    ->select('item_pesagem.*', 'residuo.descricao as residuo')
                    ->where('item_pesagem.id_pesagem', '=', $id)
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
     * @param  \App\Pesagemservico  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        // $itempesagem = ItemPesagem::where('id_contrato_cliente', $id)->get();
        $lista = DB::table('item_pesagem')
                    ->join('pesagem', 'id_pesagem', 'pesagem.id')                    
                    ->join('residuo', 'item_pesagem.id_residuo', 'residuo.id')                    
                    ->select('item_pesagem.*', 'residuo.descricao as residuo')
                    ->where('item_pesagem.id_pesagem', '=', $id)
                    ->get();
        //return response()->json($itempesagem, 200);
        return response()->json($lista, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ItemPesagem  $itempesagem
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ItemPesagem $itempesagem) {
        if ($request->has('data')) {
            $data = $request->data;
            $id = $data[0]['id_contrato'];

            foreach ($data as $item) {
                $itempesagem = ItemPesagem::find($item['id']);
                $itempesagem->fill($item);
                $validator = $this->Valitation($itempesagem);

                if ($validator->fails()) {
                    return response()->json([
                                'error' => 'Validação falhou',
                                'message' => $validator->errors()->all(),
                                    ], 422);
                }

                $itempesagem->save();
            }

            $lista = DB::table('item_pesagem')
                    ->join('pesagem', 'id_pesagem', 'pesagem.id')                                        
                    ->select('item_pesagem.*', 'residuo.descricao as residuo')
                    ->where('item_pesagem.id_pesagem', '=', $id)
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
     * @param  \App\Pesagemservico  $itempesagem
     * @return \Illuminate\Http\Response
     */
    public function destroy(ItemPesagem $itempesagem) {
        $itempesagem->delete();
        return response()->json(null, 200);
    }
        
}
