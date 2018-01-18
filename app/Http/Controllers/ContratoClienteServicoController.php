<?php

namespace App\Http\Controllers;

use App\ContratoCliContratoFor;
use App\Servico;
use App\ContratoCliente;
use App\Http\Resources\ContratoCliContratoForCollection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use Illuminate\Validation\Rule;
use Validator;

class ContratoCliContratoForController extends Controller {

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
            $desc = array('id_contrato', '=', $request->input('id_contrato'));
            array_push($arr, $desc);
        }

        if (count($arr) > 0) {
            $contratoclicontratofor = new ContratoCliContratoForCollection(ContratoCliContratoFor::where($arr)->with(['contrato_fornecedor', 'servico'])->orderBy($orderkey, $order)->paginate($nrcount));
            // $contratoclicontratofor = DB::table('contratoclicontratofor')->where($arr)->orderBy($orderkey, $order)->paginate($nrcount);
        } else {
            $contratoclicontratofor = new ContratoCliContratoForCollection(ContratoCliContratoFor::with(['contrato_fornecedor', 'fornecedor', 'servico'])->orderBy($orderkey, $order)->paginate($nrcount));
        }


        return $contratoclicontratofor->response()->setStatusCode(200); //response()->json($contratoclicontratofor,200);
    }

    public function listContratoCliContratoFor() {        
        $contratoclicontratofor = ContratoCliContratoFor::all();
        return response()->json($contratoclicontratofor, 200);        
    }

    /**
     * Metodo de validação da classe.
     *
     * @param  \App\ContratoCliContratoFor  $contratoclicontratofor
     * @return \Illuminate\Support\Facades\Validator
     */
    private function Valitation(ContratoCliContratoFor $contratoclicontratofor) {
        $validator = Validator::make($contratoclicontratofor->toArray(), [
                    'id_contrato_cliente' => 'required',
                    'id_contrato_fornecedor' => 'required',
                    'id_servico' => 'required',
                    'id_residuo' => 'required',
                    'unidade' => 'required',
                    'preco_compra' => 'required',
                    'preco_servico' => 'required',
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
                    $contratoservico = ContratoCliContratoFor::find($item['id']);
                    if ($item['selecionado'] == false) {
                        $contratoservico->delete();
                    } else {
                        $contratoservico->fill($item);
                        $validator = $this->Valitation($contratoservico);

                        if ($validator->fails()) {
                            return response()->json([
                                        'error' => 'Validação falhou',
                                        'message' => $validator->errors()->all(),
                                            ], 422);
                        }
                        $contratoservico->save();
                    }
                } else {
                    //fluxo de criação
                    if ($item['selecionado'] == true) {
                        $contratoservico = new ContratoCliContratoFor();
                        $contratoservico->fill($item);
                        $validator = $this->Valitation($contratoservico);

                        if ($validator->fails()) {
                            return response()->json([
                                        'error' => 'Validação falhou',
                                        'message' => $validator->errors()->all(),
                                            ], 422);
                        }
                        $contratoservico->save();
                    }
                    
                }
            }

            $lista = DB::table('contrato_cli_contrato_for')
                    ->join('contrato_fornecedor', 'id_contrato_fornecedor', 'contrato_fornecedor.id')
                    ->join('fornecedor', 'contrato_fornecedor.id_fornecedor','fornecedor.id')
                    ->join('residuo','id_residuo','residuo.id')
                    ->join('servico', 'id_servico', 'servico.id')
                    ->select('contrato_cli_contrato_for.*', 
                            'fornecedor.razao_social as fornecedor', 
                            'residuo.descricao as residuo',                             
                            'servico.descricao as servico')
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
     * Display the specified resource.
     *
     * @param  \App\contratoclicontratofor  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {        
         $contratoclicontratofor = ContratoCliContratoFor::where('id_contrato_cliente', $id)->get();
         return response()->json($contratoclicontratofor, 200);        
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
                $contratoservico = ContratoCliContratoFor::find($item['id']);
                $contratoservico->fill($item);
                $validator = $this->Valitation($contratoservico);

                if ($validator->fails()) {
                    return response()->json([
                                'error' => 'Validação falhou',
                                'message' => $validator->errors()->all(),
                                    ], 422);
                }
                
                $contratoservico->save();
            }

            $lista = DB::table('contrato_cli_contrato_for')
                    ->join('contrato_fornecedor', 'id_contrato_fornecedor', 'contrato_fornecedor.id')
                    ->join('fornecedor', 'contrato_fornecedor.id_fornecedor','fornecedor.id')
                    ->join('residuo','id_residuo','residuo.id')
                    ->join('servico', 'id_servico', 'servico.id')
                    ->select('contrato_cli_contrato_for.*', 
                            'fornecedor.razao_social as fornecedor', 
                            'residuo.descricao as residuo',                             
                            'servico.descricao as servico')
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
     * @param  \App\contratoclicontratofor  $contratoclicontratofor
     * @return \Illuminate\Http\Response
     */
    public function destroy(ContratoCliContratoFor $contratoclicontratofor) {
        $contratoclicontratofor->delete();
        return response()->json(null, 200);
    }

}
