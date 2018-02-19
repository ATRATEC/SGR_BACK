<?php

namespace App\Http\Controllers;

use App\ContratoFornecedorResiduo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use Illuminate\Validation\Rule;
use Validator;

class ContratoFornecedorResiduoController extends Controller {

    function __construct() {
        $this->content = array();
    }

    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request) {
//        $nrcount = $request->input('nrcount', 15);
//        $orderkey = $request->input('orderkey', 'id');
//        $order = $request->input('order', 'asc');

        $arr = array();

        if ($request->has('id')) {
            $desc = array('id', '=', $request->input('id'));
            array_push($arr, $desc);
        }

        if ($request->has('id_contrato')) {
            $desc = array('id_contrato', '=', $request->input('id_contrato'));
            array_push($arr, $desc);
        }
        
        if ($request->has('id_servico')) {
            $desc = array('id_servico', '=', $request->input('id_servico'));
            array_push($arr, $desc);
        }
        
        if ($request->has('id_residuo')) {
            $desc = array('id_residuo', '=', $request->input('id_residuo'));
            array_push($arr, $desc);
        }
        
        if ($request->has('unidade')) {
            $desc = array('unidade', '=', $request->input('unidade'));
            array_push($arr, $desc);
        }
        
        if ($request->has('vigencia_inicio')) {
            $desc = array('vigencia_inicio', '>=', $request->input('vigencia_inicio'));
            array_push($arr, $desc);
        }
        
        if ($request->has('vigencia_final')) {
            $desc = array('vigencia_final', '<=', $request->input('vigencia_final'));
            array_push($arr, $desc);
        }
        

        if (count($arr) > 0) {
            //$contratofornecedorresiduo = new ContratoFornecedorResiduoCollection(ContratoFornecedorResiduo::where($arr)->with(['contrato_fornecedor', 'servico'])->orderBy($orderkey, $order)->paginate($nrcount));
            // $contratofornecedorresiduo = DB::table('contratofornecedorresiduo')->where($arr)->orderBy($orderkey, $order)->paginate($nrcount);
            $contratofornecedorresiduo = DB::table('contrato_fornecedor_residuo')
                    ->join('contrato_fornecedor', 'id_contrato', 'contrato_fornecedor.id')
                    ->join('fornecedor', 'contrato_fornecedor_residuo.id_fornecedor', 'fornecedor.id')
                    ->join('residuo', 'id_residuo', 'residuo.id')                    
                    ->join('servico', 'id_servico', 'servico.id')
                    ->select('contrato_fornecedor_residuo.*', 'fornecedor.nome_fantasia as fornecedor', 'residuo.descricao as residuo', 'servico.descricao as servico')
                    ->whereRaw('(contrato_fornecedor.id_cliente = '.$request->input('id_cliente').' or contrato_fornecedor.id_cliente is null)')
                    ->where($arr)
                    ->orderBy('contrato_fornecedor_residuo.id')                    
                    ->get();
        } else {
            $contratofornecedorresiduo = DB::table('contrato_fornecedor_residuo')
                    ->join('contrato_fornecedor', 'id_contrato', 'contrato_fornecedor.id')
                    ->join('fornecedor', 'contrato_fornecedor_residuo.id_fornecedor', 'fornecedor.id')
                    ->join('residuo', 'id_residuo', 'residuo.id')                    
                    ->join('servico', 'id_servico', 'servico.id')
                    ->select('contrato_fornecedor_residuo.*', 'fornecedor.nome_fantasia as fornecedor', 'residuo.descricao as residuo', 'servico.descricao as servico')                  
                    ->orderBy('contrato_fornecedor_residuo.id', 'asc')
                    ->get();
           // $contratofornecedorresiduo = new ContratoFornecedorResiduoCollection(ContratoFornecedorResiduo::with(['contrato_fornecedor', 'fornecedor', 'servico'])->orderBy($orderkey, $order)->paginate($nrcount));
        }
        
        return response()->json($contratofornecedorresiduo,200);

        //return $contratofornecedorresiduo->response()->setStatusCode(200); //response()->json($contratofornecedorresiduo,200);
    }

    public function listContratoFornecedorResiduo() {
        $contratofornecedorresiduo = ContratoFornecedorResiduo::all();
        return response()->json($contratofornecedorresiduo, 200);
    }

    /**
     * Metodo de validação da classe.
     *
     * @param  \App\ContratoFornecedorResiduo  $contratofornecedorresiduo
     * @return \Illuminate\Support\Facades\Validator
     */
    private function Valitation(ContratoFornecedorResiduo $contratofornecedorresiduo) {
        $validator = Validator::make($contratofornecedorresiduo->toArray(), [                    
                    'id_contrato' => 'required',                    
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
                    $contratoresiduo = ContratoFornecedorResiduo::find($item['id']);
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
                    $contratoresiduo = new ContratoFornecedorResiduo();
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

            $lista = DB::table('contrato_fornecedor_residuo')
                    ->join('contrato_fornecedor', 'id_contrato', 'contrato_fornecedor.id')
                    ->join('fornecedor', 'contrato_fornecedor_residuo.id_fornecedor', 'fornecedor.id')
                    ->join('residuo', 'id_residuo', 'residuo.id') 
                    ->join('servico', 'id_servico', 'servico.id')
                    ->select('contrato_fornecedor_residuo.*', 'fornecedor.razao_social as fornecedor', 'residuo.descricao as residuo', 'servico.descricao as servico')
                    ->where('contrato_fornecedor_residuo.id_contrato', '=', $id)
                    ->orderBy('contrato_fornecedor_residuo.id', 'asc')
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
     * @param  \App\ContratoFornecedorResiduo  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        // $contratofornecedorresiduo = ContratoFornecedorResiduo::where('id_contrato_cliente', $id)->get();
        $lista = DB::table('contrato_fornecedor_residuo')
                    ->join('contrato_fornecedor', 'contrato_fornecedor_residuo.id_contrato', 'contrato_fornecedor.id')
                    ->join('fornecedor', 'contrato_fornecedor_residuo.id_fornecedor', 'fornecedor.id')
                    ->join('residuo', 'id_residuo', 'residuo.id')        
                    ->join('servico', 'id_servico', 'servico.id')
                    ->select('contrato_fornecedor_residuo.*', 'fornecedor.razao_social as fornecedor', 'residuo.descricao as residuo', 'servico.descricao as servico')
                    ->where('contrato_fornecedor_residuo.id_contrato', '=', $id)
                    ->orderBy('contrato_fornecedor_residuo.id', 'asc')
                    ->get();
        //return response()->json($contratofornecedorresiduo, 200);
        return response()->json($lista, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ContratoFornecedorResiduo  $contratofornecedorresiduo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ContratoFornecedorResiduo $contratofornecedorresiduo) {
        if ($request->has('data')) {
            $data = $request->data;
            $id = $data[0]['id_contrato'];

            foreach ($data as $item) {
                $contratoresiduo = ContratoFornecedorResiduo::find($item['id']);
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

            $lista = DB::table('contrato_fornecedor_residuo')
                    ->join('contrato_fornecedor', 'id_contrato', 'contrato_fornecedor.id')
                    ->join('fornecedor', 'contrato_fornecedor_residuo.id_fornecedor', 'fornecedor.id')
                    ->join('residuo', 'id_residuo', 'residuo.id')    
                    ->join('servico', 'id_servico', 'servico.id')
                    ->select('contrato_fornecedor_residuo.*', 'fornecedor.razao_social as fornecedor', 'residuo.descricao as residuo', 'servico.descricao as servico')
                    ->where('contrato_fornecedor_residuo.id_contrato', '=', $id)
                    ->orderBy('contrato_fornecedor_residuo.id', 'asc')
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
     * @param  \App\ContratoFornecedorResiduo  $contratofornecedorresiduo
     * @return \Illuminate\Http\Response
     */
    public function destroy(ContratoFornecedorResiduo $contratofornecedorresiduo) {
        $contratofornecedorresiduo->delete();
        return response()->json(null, 200);
    }

}
