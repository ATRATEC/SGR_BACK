<?php

namespace App\Http\Controllers;

use App\Servico;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use App\Exceptions\APIException;
use Illuminate\Validation\Rule;
use Validator;

class ServicoController extends Controller {

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
            $desc = array('servico.id', '=', $request->input('id'));
            array_push($arr, $desc);
        }

        if ($request->has('descricao')) {
            $desc = array('servico.descricao', 'like', '%' . $request->input('descricao') . '%');
            array_push($arr, $desc);
        }
        
        if ($request->has('tipo_atividade')) {
            $desc = array('ta.id', '=', $request->input('tipo_atividade'));
            array_push($arr, $desc);
        }

       
        if (count($arr) > 0) {
            $servicos = DB::table('servico')
                    ->join('tipo_atividade as ta','id_tipo_atividade', 'ta.id')
                    ->select('servico.*','ta.descricao as tipo_atividade')
                    ->where($arr)->orderBy($orderkey, $order)->paginate($nrcount);
            //$tiposervicos = new ServicoCollection(Servico::where()->where($arr)->orderBy($orderkey, $order)->paginate($nrcount));            
        } else {
            $servicos = DB::table('servico')                    
                    ->join('tipo_atividade as ta','id_tipo_atividade', 'ta.id')
                    ->select('servico.*', 'ta.descricao as tipo_atividade')                    
                    ->orderBy($orderkey, $order)->paginate($nrcount);
            //$tiposervicos = DB::table('tipo_servico')->orderBy($orderkey, $order)->paginate($nrcount);
//            $tiposervicos = new ServicoCollection(Servico::orderBy($orderkey, $order)->paginate($nrcount));
        }

        return response()->json($servicos, 200) ;;
//        return $tiposervicos->response()->setStatusCode(200) ;
    }
    
    public function listServico()
    {
        $servico = Servico::all();
        return response()->json($servico, 200);
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
     * Metodo de validação da classe.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Support\Facades\Validator
     */
    private function ValitationStore(Request $request) {        
        $validator = Validator::make($request->all(), [                            
                    'descricao' => 'required|unique:servico|max:50',
        ], parent::$messages);

        return $validator;
    }
    
    /**
     * Metodo de validação da classe.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Support\Facades\Validator
     */
    private function ValitationUpdate(Request $request, Servico $servico) {        
        $validator = Validator::make($request->all(), [                            
                    'descricao' => ['required',
                                    Rule::unique('servico')->ignore($servico->id),
                                    'max:50'],
        ], parent::$messages);

        return $validator;
    }

    /**
     * Valida informações de Servico
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        
        $validator = $this->ValitationStore($request);

        if ($validator->fails()) {
            return response()->json([
                        'error' => 'Validação falhou',
                        'message' => $validator->errors()->all(),
                            ], 422);
        }

        $tiposervico = new Servico();
        $tiposervico->fill($request->all());
        $tiposervico->save();
        
        $servico = DB::table('servico')
                    ->join('tipo_atividade as ta','id_tipo_atividade', 'ta.id')
                    ->select('servico.*', 'ta.descricao as tipo_atividade') 
                    ->where('servico.id',$tiposervico->id)
                    ->get()->first();
        
        return response()->json($servico, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        $servico = DB::table('servico')
                    ->join('tipo_atividade as ta','id_tipo_atividade', 'ta.id')
                    ->select('servico.*', 'ta.descricao as tipo_atividade') 
                    ->where('servico.id',$id)
                    ->get()->first();
        return response()->json($servico, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \SGR\Servico  $servico
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Servico $servico) {
        
        $validator = $this->ValitationUpdate($request,$servico);

        if ($validator->fails()) {
            return response()->json([
                        'error' => 'Validação falhou',
                        'message' => $validator->errors()->all(),
                            ], 422);
        }
        
        $servico->update($request->all());
        
        $res = DB::table('servico')
                    ->join('tipo_atividade as ta','id_tipo_atividade', 'ta.id')
                    ->select('servico.*', 'ta.descricao as tipo_atividade') 
                    ->where('servico.id', $servico->id)
                    ->first();

        return response()->json($res, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \SGR\Servico  $servico
     * @return \Illuminate\Http\Response
     */
    public function destroy(Servico $servico) {
        if (count($servico->contrato_fornecedores()->get())){
            throw new APIException('Serviço não pode ser excluído. Pois esta sendo utilizado em um ou mais contratos');
        }
        
        if (count($servico->contrato_clientes()->get())){
            throw new APIException('Serviço não pode ser excluído. Pois esta sendo utilizado em um ou mais contratos');
        }
        $servico->delete();
        return response()->json(null, 200);
    }

}
