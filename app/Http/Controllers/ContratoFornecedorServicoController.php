<?php

namespace App\Http\Controllers;

use App\ContratoFornecedorServico;
use App\ContratoFornecedor;
use App\Http\Resources\ContratoFornecedorServicoCollection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use Illuminate\Validation\Rule;
use Validator;

class ContratoFornecedorServicoController extends Controller
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
        
        if ($request->has('id_contrato')) {
            $desc = array('id_contrato', '=', $request->input('id_contrato'));
            array_push($arr, $desc);
        }
              
//        if ($request->has('descricao')) {
//            $desc = array('descricao', 'like', '%' . $request->input('descricao') . '%');
//            array_push($arr, $desc);
//        }
       
        if (count($arr) > 0) {
            $contratofornecedorservico = new ContratoFornecedorServicoCollection(ContratoFornecedorServico::where($arr)->with(['contrato_fornecedor','servico'])->orderBy($orderkey, $order)->paginate($nrcount));
            // $contratofornecedorservico = DB::table('contratofornecedorservico')->where($arr)->orderBy($orderkey, $order)->paginate($nrcount);
        } else {
            $contratofornecedorservico = new ContratoFornecedorServicoCollection(ContratoFornecedorServico::with(['contrato_fornecedor','fornecedor','servico'])->orderBy($orderkey, $order)->paginate($nrcount));
        }


        return $contratofornecedorservico->response()->setStatusCode(200); //response()->json($contratofornecedorservico,200);
    }
    
    public function listContratoFornecedorServico()
    {
        $contratofornecedorservico = ContratoFornecedorServico::all();
        return response()->json($contratofornecedorservico, 200);
    }
    
    /**
     * Metodo de validação da classe.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Support\Facades\Validator
     */
    private function ValitationServico(ContratoFornecedorServico $contratofornecedorservico) {        
        $validator = Validator::make($contratofornecedorservico->toArray(), [                                                
                    'id_fornecedor' => 'required',
                    'id_servico' => 'required',
                    'preco' => 'required',
        ], parent::$messages);

        return $validator;
    }
    
    /**
     * Metodo de validação da classe.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Support\Facades\Validator
     */
    private function ValitationContrato(ContratoFornecedor $contratofornecedor) {        
        $validator = Validator::make($contratofornecedor->toArray(), [                            
                    'vigencia_inicio' => 'required',
                    'vigencia_final' => 'required',
                    'exclusivo' => 'required',
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
        if ($request->has('data'))
        {
            $data = $request->data;
            $contrato = new ContratoFornecedor();
            $contrato->fill($data[0]['contrato_fornecedor']);
            
            $validatorContrato = $this->ValitationContrato($contrato);

            if ($validatorContrato->fails()) {
                return response()->json([
                            'error' => 'Validação falhou',
                            'message' => $validatorContrato->errors()->all(),
                                ], 422);
            }
            
            $contrato->save();
            
            foreach ($data as $item) 
            {
                $contratoservico = new ContratoFornecedorServico();
                $contratoservico->fill($item);
                $validatorServico = $this->ValitationServico($contratoservico);

                if ($validatorServico->fails()) {
                    return response()->json([
                                'error' => 'Validação falhou',
                                'message' => $validatorServico->errors()->all(),
                                    ], 422);
                }
                $contratoservico->id_contrato = $contrato->id;
                $contratoservico->save();                                
            }
            
            $listaContratos = ContratoFornecedorServico::where('id_contrato', $contrato->id)->with(['contrato_fornecedor','fornecedor','servico'])->get();
            
            return response()->json($listaContratos, 201); 
        }
        return response()->json([
                                'error' => 'Validação falhou',
                                'message' => 'Nenhum dado enviado para gravação',
                                    ], 422); 
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\contratofornecedorservico  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $contratofornecedorservico = ContratoFornecedorServico::where('id_contrato', $id)->with(['contrato_fornecedor','fornecedor','servico'])->get();
        return response()->json($contratofornecedorservico, 200);
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ContratoFornecedor  $contratofornecedor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ContratoFornecedor $contratofornecedor)
    {
        if ($request->has('data'))
        {
            $data = $request->data;
            //$contrato = new ContratoFornecedor();
            $contratofornecedor->fill($data[0]['contrato_fornecedor']);                        
            $validatorContrato = $this->ValitationContrato($contratofornecedor);

            if ($validatorContrato->fails()) {
                return response()->json([
                            'error' => 'Validação falhou',
                            'message' => $validatorContrato->errors()->all(),
                                ], 422);
            }
            
            $contratofornecedor->save();
            
            foreach ($data as $item) 
            {
                $contratoservico = ContratoFornecedorServico::find($item['id']);
                $contratoservico->fill($item);
                $validatorServico = $this->ValitationServico($contratoservico);

                if ($validatorServico->fails()) {
                    return response()->json([
                                'error' => 'Validação falhou',
                                'message' => $validatorServico->errors()->all(),
                                    ], 422);
                }
                // $contratoservico->id_contrato = $contrato->id;
                $contratoservico->save();                                
            }
            
            $listaContratos = ContratoFornecedorServico::where('id_contrato', $contratofornecedor->id)->with(['contrato_fornecedor','fornecedor','servico'])->get();
            
            return response()->json($listaContratos, 200); 
        }
        return response()->json([
                                'error' => 'Validação falhou',
                                'message' => 'Nenhum dado enviado para gravação',
                                    ], 422); 
//        $validator = $this->ValitationUpdate($request,$contratofornecedorservico);
//
//        if ($validator->fails()) {
//            return response()->json([
//                        'error' => 'Validação falhou',
//                        'message' => $validator->errors()->all(),
//                            ], 422);
//        }
//        
//        $contratofornecedorservico->update($request->all());
//
//        return response()->json($contratofornecedorservico, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\contratofornecedorservico  $contratofornecedorservico
     * @return \Illuminate\Http\Response
     */
    public function destroy(ContratoFornecedorServico $contratofornecedorservico)
    {
        $contratofornecedorservico->delete();
        return response()->json(null, 200);
    }
}
