<?php

/**
 * Em classes onde existe a necessidade de informe de datas deve ser usado o DB::table no lugar 
 * da entidade.
 * Usando a entidade as data acabam vindo no formato yyyy-mm-dd hh:mm:ss isso faz com que o 
 * componente de exibição de data no html5 informe um erro de formato de data.
 */

namespace App\Http\Controllers;

use App\Locacao;
use App\LocacaoEquipamento;
use App\Exceptions\APIException;
use App\Fornecedor;
use App\Cliente;
use App\Http\Resources\LocacaoCollection;
use Illuminate\Http\Request;
use Illuminate\Http\File;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use Illuminate\Validation\Rule;
use Validator;

class LocacaoController extends Controller
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
        
        if ($request->has('data')) {
            $desc = array('data', '>=', $request->input('data'));
            array_push($arr, $desc);
        }
                                                      
        if ($request->has('cliente')) {
            $desc = array('cliente.razao_social', 'like', '%' . $request->input('cliente') . '%');
            array_push($arr, $desc);
        }
                                                      
        if (count($arr) > 0) {            
            $locacao = DB::table('locacao')
                ->join('cliente', 'id_cliente', 'cliente.id')                      
                ->join('contrato_cliente','id_contrato_cliente', 'contrato_cliente.id')
                ->select('locacao.*', 'cliente.razao_social as cliente', 'contrato_cliente.descricao as descricao')
                ->where($arr)
                ->orderBy($orderkey, $order)->paginate($nrcount);            
        } else {
            $locacao = DB::table('locacao')
                ->join('cliente', 'id_cliente', 'cliente.id')                 
                ->join('contrato_cliente','id_contrato_cliente', 'contrato_cliente.id')
                ->select('locacao.*', 'cliente.razao_social as cliente', 'contrato_cliente.descricao as descricao')
                ->orderBy($orderkey, $order)->paginate($nrcount);
            
        }


        return response()->json($locacao,200);
    }
    
    public function listLocacao()
    {
        $locacao = Locacao::all();
        return response()->json($locacao, 200);
    }
    
    /**
     * Metodo de validação da classe.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Support\Facades\Validator
     */
    private function ValitationStore(Request $request) {        
        $validator = Validator::make($request->all(), [                            
                    'id_cliente' => 'required',
                    'id_contrato_cliente' => 'required',                    
                    'data' => 'required',                    
        ], parent::$messages);

        return $validator;
    }
    
    /**
     * Metodo de validação da classe.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Support\Facades\Validator
     */
    private function ValitationUpdate(Request $request, Locacao $locacao) {        
        $validator = Validator::make($request->all(), [                            
                    'id_cliente' => 'required',
                    'id_contrato_cliente' => 'required',                    
                    'data' => 'required',
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

        $locacao = new Locacao();
        $locacao->fill($request->all());
        $locacao->save();
        
        $ctrfor = DB::table('locacao')
                ->join('cliente', 'id_cliente', 'cliente.id')                 
                ->join('contrato_cliente','id_contrato_cliente', 'contrato_cliente.id')
                ->select('locacao.*', 'cliente.razao_social as cliente', 'contrato_cliente.descricao as descricao')
                ->where('locacao.id', '=', $locacao->id)
                ->first();
        
        
        return response()->json($ctrfor, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Locacao  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $locacao = DB::table('locacao')                
                ->join('cliente', 'id_cliente', 'cliente.id')                
                ->join('contrato_cliente','id_contrato_cliente', 'contrato_cliente.id')
                ->select('locacao.*', 'cliente.razao_social as cliente', 'contrato_cliente.descricao as descricao')
                ->where('locacao.id', '=', $id)
                ->first();
        return response()->json($locacao, 200);
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Locacao  $locacao
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Locacao $locacao)
    {
        $validator = $this->ValitationUpdate($request, $locacao);

        if ($validator->fails()) {
            return response()->json([
                        'error' => 'Validação falhou',
                        'message' => $validator->errors()->all(),
                            ], 422);
        }
        
        $locacao->update($request->all());
        
        $ctrfor = DB::table('locacao')                
                ->join('cliente', 'id_cliente', 'cliente.id')                
                ->join('contrato_cliente','id_contrato_cliente', 'contrato_cliente.id')
                ->select('locacao.*', 'cliente.razao_social as cliente', 'contrato_cliente.descricao as descricao')
                ->where('locacao.id', '=', $locacao->id)
                ->first();

        return response()->json($ctrfor, 200);
    }
        
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Locacao  $locacao
     * @return \Illuminate\Http\Response
     */
    public function destroy(Locacao $locacao)
    {        
        $locacao->delete();
        return response()->json(null, 200);
    }
}
