<?php

namespace App\Http\Controllers;

use App\ContratoFornecedor;
use App\Fornecedor;
use App\Cliente;
use App\Http\Resources\ContratoFornecedorCollection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use Illuminate\Validation\Rule;
use Validator;

class ContratoFornecedorController extends Controller
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
        
        if ($request->has('vigencia_inicio')) {
            $desc = array('vigencia_inicio', '>=', $request->input('vigencia_inicio'));
            array_push($arr, $desc);
        }
        
        if ($request->has('vigencia_final')) {
            $desc = array('vigencia_final', '<=', $request->input('vigencia_final'));
            array_push($arr, $desc);
        }
              
        if ($request->has('descricao')) {
            $desc = array('descricao', 'like', '%' . $request->input('descricao') . '%');
            array_push($arr, $desc);
        }
        
        $array_for = array();
        if ($request->has('fornecedor')) {
            $col = array();
            $desc = array('razao_social', 'like', '%' . $request->input('fornecedor') . '%');
            array_push($col, $desc);
            $listafor = Fornecedor::where($col)->get();
            foreach ($listafor as $item) {
                array_push($array_for, $item->id);
            }            
        }
        
        $array_cli = array();
        if ($request->has('cliente')) {
            $col = array();
            $desc = array('razao_social', 'like', '%' . $request->input('cliente') . '%');
            array_push($col, $desc);
            $listacli = Cliente::where($col)->get();
            foreach ($listacli as $item) {
                array_push($array_cli, $item->id);
            }            
        }
        
        //CONTRATO - FORNECEDOR - CLIENTE
        if ((count($arr) > 0)&&((count($array_for) > 0))&&(count($array_cli) > 0)) {            
            $contratofornecedor = new ContratoFornecedorCollection(ContratoFornecedor::with(['cliente','fornecedor','servicos'])->where($arr)->whereIn('id_fornecedor',$array_for)->whereIn('id_cliente',$array_cli)->orderBy($orderkey, $order)->paginate($nrcount));
            // $contratofornecedor = DB::table('contratofornecedor')->where($arr)->orderBy($orderkey, $order)->paginate($nrcount);
        }
        
        //CONTRATO - FORNECEDOR
        if ((count($arr) > 0)&&((count($array_for) > 0))&&(count($array_cli) == 0)) {            
            $contratofornecedor = new ContratoFornecedorCollection(ContratoFornecedor::with(['cliente','fornecedor','servicos'])->where($arr)->whereIn('id_fornecedor',$array_for)->orderBy($orderkey, $order)->paginate($nrcount));
            // $contratofornecedor = DB::table('contratofornecedor')->where($arr)->orderBy($orderkey, $order)->paginate($nrcount);
        }
        
        //CONTRATO - CLIENTE
        if ((count($arr) > 0)&&((count($array_for) == 0))&&(count($array_cli) > 0)) {            
            $contratofornecedor = new ContratoFornecedorCollection(ContratoFornecedor::with(['cliente','fornecedor','servicos'])->where($arr)->whereIn('id_cliente',$array_cli)->orderBy($orderkey, $order)->paginate($nrcount));
            // $contratofornecedor = DB::table('contratofornecedor')->where($arr)->orderBy($orderkey, $order)->paginate($nrcount);
        }
        
        //CLIENTE
        if ((count($arr) == 0)&&((count($array_for) == 0))&&(count($array_cli) > 0)) {            
            $contratofornecedor = new ContratoFornecedorCollection(ContratoFornecedor::with(['cliente','fornecedor','servicos'])->whereIn('id_cliente',$array_cli)->orderBy($orderkey, $order)->paginate($nrcount));
            // $contratofornecedor = DB::table('contratofornecedor')->where($arr)->orderBy($orderkey, $order)->paginate($nrcount);
        }
        
        //CONTRATO
        if ((count($arr) > 0)&&((count($array_for) == 0))&&(count($array_cli) == 0)) {            
            $contratofornecedor = new ContratoFornecedorCollection(ContratoFornecedor::with(['cliente','fornecedor','servicos'])->where($arr)->orderBy($orderkey, $order)->paginate($nrcount));
            // $contratofornecedor = DB::table('contratofornecedor')->where($arr)->orderBy($orderkey, $order)->paginate($nrcount);
        }
        
        //FORNECEDOR
        if ((count($arr) == 0)&&((count($array_for) > 0))&&(count($array_cli) == 0)) {            
            $contratofornecedor = new ContratoFornecedorCollection(ContratoFornecedor::with(['cliente','fornecedor','servicos'])->whereIn('id_fornecedor',$array_for)->orderBy($orderkey, $order)->paginate($nrcount));
            // $contratofornecedor = DB::table('contratofornecedor')->where($arr)->orderBy($orderkey, $order)->paginate($nrcount);
        }
        
        //DEFAULT
        if ((count($arr) == 0)&&((count($array_for) == 0))&&(count($array_cli) == 0)) {            
            $contratofornecedor = new ContratoFornecedorCollection(ContratoFornecedor::with(['cliente','fornecedor','servicos'])->orderBy($orderkey, $order)->paginate($nrcount));
            // $contratofornecedor = DB::table('contratofornecedor')->where($arr)->orderBy($orderkey, $order)->paginate($nrcount);
        }
        
              
//        if (count($arr) > 0) {            
//            $contratofornecedor = new ContratoFornecedorCollection(ContratoFornecedor::with(['cliente','fornecedor','servicos'])->where($arr)->whereIn('id_fornecedor',$array_for)->orderBy($orderkey, $order)->paginate($nrcount));
//            // $contratofornecedor = DB::table('contratofornecedor')->where($arr)->orderBy($orderkey, $order)->paginate($nrcount);
//        } else {
//            $contratofornecedor = new ContratoFornecedorCollection(ContratoFornecedor::with(['cliente','fornecedor','servicos'])->orderBy($orderkey, $order)->paginate($nrcount));
//        }


        return $contratofornecedor->response()->setStatusCode(200); //response()->json($contratofornecedor,200);
    }
    
    public function listContratoFornecedor()
    {
        $contratofornecedor = ContratoFornecedor::all();
        return response()->json($contratofornecedor, 200);
    }
    
    /**
     * Metodo de validação da classe.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Support\Facades\Validator
     */
    private function ValitationStore(Request $request) {        
        $validator = Validator::make($request->all(), [                            
                    'vigencia_inicio' => 'required',
                    'vigencia_final' => 'required',
                    'exclusivo' => 'required',
        ], parent::$messages);

        return $validator;
    }
    
    /**
     * Metodo de validação da classe.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Support\Facades\Validator
     */
    private function ValitationUpdate(Request $request, ContratoFornecedor $contratofornecedor) {        
        $validator = Validator::make($request->all(), [                            
                    'vigencia_inicio' => 'required|date',
                    'vigencia_final' => 'required|date',
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
        $validator = $this->ValitationStore($request);

        if ($validator->fails()) {
            return response()->json([
                        'error' => 'Validação falhou',
                        'message' => $validator->errors()->all(),
                            ], 422);
        }

        $contratofornecedor = new ContratoFornecedor();
        $contratofornecedor->fill($request->all());
        $contratofornecedor->save();
        return response()->json($contratofornecedor, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\contratofornecedor  $contratofornecedor
     * @return \Illuminate\Http\Response
     */
    public function show(ContratoFornecedor $contratofornecedor)
    {
        return response()->json($contratofornecedor, 200);
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\contratofornecedor  $contratofornecedor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ContratoFornecedor $contratofornecedor)
    {
        $validator = $this->ValitationUpdate($request,$contratofornecedor);

        if ($validator->fails()) {
            return response()->json([
                        'error' => 'Validação falhou',
                        'message' => $validator->errors()->all(),
                            ], 422);
        }
        
        $contratofornecedor->update($request->all());

        return response()->json($contratofornecedor, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\contratofornecedor  $contratofornecedor
     * @return \Illuminate\Http\Response
     */
    public function destroy(ContratoFornecedor $contratofornecedor)
    {
        $contratofornecedor->delete();
        return response()->json(null, 200);
    }
}
