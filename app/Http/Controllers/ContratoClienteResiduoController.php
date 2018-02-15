<?php

namespace App\Http\Controllers;

use App\ContratoClienteResiduo;
use App\Residuo;
use App\ContratoCliente;
use App\Http\Resources\ContratoClienteResiduoCollection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use Illuminate\Validation\Rule;
use Validator;

class ContratoClienteResiduoController extends Controller {

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
            $desc = array('contrato_cliente_residuo.id_contrato_cliente', '=', $request->input('id_contrato'));
            array_push($arr, $desc);
        }

        if (count($arr) > 0) {
            //$contratoclienteresiduo = new ContratoClienteResiduoCollection(ContratoClienteResiduo::where($arr)->with(['contrato_fornecedor', 'residuo'])->orderBy($orderkey, $order)->paginate($nrcount));
            // $contratoclienteresiduo = DB::table('contratoclienteresiduo')->where($arr)->orderBy($orderkey, $order)->paginate($nrcount);
            $contratoclienteresiduo = DB::table('contrato_cliente_residuo')
                    ->join('contrato_fornecedor', 'id_contrato_fornecedor', 'contrato_fornecedor.id')
                    ->join('fornecedor', 'contrato_fornecedor.id_fornecedor', 'fornecedor.id')
                    ->join('residuo', 'id_residuo', 'residuo.id')
                    ->join('servico', 'id_servico', 'servico.id')
                    ->select('contrato_cliente_residuo.*', 'fornecedor.razao_social as fornecedor', 'residuo.descricao as residuo', 'servico.descricao as servico')
                    ->where($arr)
                    ->get();
        } else {
            $contratoclienteresiduo = DB::table('contrato_cliente_residuo')
                    ->join('contrato_fornecedor', 'id_contrato_fornecedor', 'contrato_fornecedor.id')
                    ->join('fornecedor', 'contrato_fornecedor.id_fornecedor', 'fornecedor.id')
                    ->join('residuo', 'id_residuo', 'residuo.id')
                    ->join('servico', 'id_servico', 'servico.id')
                    ->select('contrato_cliente_residuo.*', 'fornecedor.razao_social as fornecedor', 'residuo.descricao as residuo', 'servico.descricao as servico')
                    ->where('contrato_cliente_residuo.id_contrato_cliente', '=', $id)
                    ->get();
           // $contratoclienteresiduo = new ContratoClienteResiduoCollection(ContratoClienteResiduo::with(['contrato_fornecedor', 'fornecedor', 'residuo'])->orderBy($orderkey, $order)->paginate($nrcount));
        }
        
        response()->json($contratoclienteresiduo,200);

        //return $contratoclienteresiduo->response()->setStatusCode(200); //response()->json($contratoclienteresiduo,200);
    }

    public function listContratoClienteResiduo() {
        $contratoclienteresiduo = ContratoClienteResiduo::all();
        return response()->json($contratoclienteresiduo, 200);
    }

    /**
     * Metodo de validação da classe.
     *
     * @param  \App\ContratoClienteResiduo  $contratoclienteresiduo
     * @return \Illuminate\Support\Facades\Validator
     */
    private function Valitation(ContratoClienteResiduo $contratoclienteresiduo) {
        $validator = Validator::make($contratoclienteresiduo->toArray(), [
                    'id_contrato_cliente' => 'required',
                    'id_contrato_fornecedor' => 'required',                    
                    'id_residuo' => 'required',
                    'id_servico' => 'required',
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
                    $contratoresiduo = ContratoClienteResiduo::find($item['id']);
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
                    $contratoresiduo = new ContratoClienteResiduo();
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

            $lista = DB::table('contrato_cliente_residuo')
                    ->join('contrato_fornecedor', 'id_contrato_fornecedor', 'contrato_fornecedor.id')
                    ->join('fornecedor', 'contrato_fornecedor.id_fornecedor', 'fornecedor.id')
                    ->join('residuo', 'id_residuo', 'residuo.id')                    
                    ->join('servico', 'id_servico', 'servico.id')
                    ->select('contrato_cliente_residuo.*', 'fornecedor.razao_social as fornecedor', 'residuo.descricao as residuo', 'servico.descricao as servico')
                    ->where('contrato_cliente_residuo.id_contrato_cliente', '=', $id)
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
     * @param  \App\contratoclienteresiduo  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        // $contratoclienteresiduo = ContratoClienteResiduo::where('id_contrato_cliente', $id)->get();
        $lista = DB::table('contrato_cliente_residuo')
                    ->join('contrato_fornecedor', 'id_contrato_fornecedor', 'contrato_fornecedor.id')
                    ->join('fornecedor', 'contrato_fornecedor.id_fornecedor', 'fornecedor.id')                    
                    ->join('residuo', 'id_residuo', 'residuo.id')
                    ->join('servico', 'id_servico', 'servico.id')
                    ->select('contrato_cliente_residuo.*', 'fornecedor.razao_social as fornecedor', 'residuo.descricao as residuo', 'servico.descricao as servico')
                    ->where('contrato_cliente_residuo.id_contrato_cliente', '=', $id)
                    ->get();
        //return response()->json($contratoclienteresiduo, 200);
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
                $contratoresiduo = ContratoClienteResiduo::find($item['id']);
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
                    ->join('contrato_fornecedor', 'id_contrato_fornecedor', 'contrato_fornecedor.id')
                    ->join('fornecedor', 'contrato_fornecedor.id_fornecedor', 'fornecedor.id')
                    ->join('residuo', 'id_residuo', 'residuo.id')                    
                    ->join('servico', 'id_servico', 'servico.id')
                    ->select('contrato_cliente_residuo.*', 'fornecedor.razao_social as fornecedor', 'residuo.descricao as residuo', 'servico.descricao as servico')
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
     * @param  \App\contratoclienteresiduo  $contratoclienteresiduo
     * @return \Illuminate\Http\Response
     */
    public function destroy(ContratoClienteResiduo $contratoclienteresiduo) {
        $contratoclienteresiduo->delete();
        return response()->json(null, 200);
    }

}
