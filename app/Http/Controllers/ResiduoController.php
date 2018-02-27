<?php

namespace App\Http\Controllers;

use App\Residuo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use App\Exceptions\APIException;
use Illuminate\Validation\Rule;
use Validator;

class ResiduoController extends Controller {

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
            $desc = array('residuo.id', '=', $request->input('id'));
            array_push($arr, $desc);
        }

        if ($request->has('descricao')) {
            $desc = array('residuo.descricao', 'like', '%' . $request->input('descricao') . '%');
            array_push($arr, $desc);
        }

        if ($request->has('classe_residuo')) {
            $desc = array('cr.descricao', 'like', '%' . $request->input('classe_residuo') . '%');
            array_push($arr, $desc);
        }
        
        if ($request->has('tipo_residuo')) {
            $desc = array('tr.descricao', 'like', '%' . $request->input('tipo_residuo') . '%');
            array_push($arr, $desc);
        }
        
        if ($request->has('acondicionamento')) {
            $desc = array('ac.descricao', 'like', '%' . $request->input('acondicionamento') . '%');
            array_push($arr, $desc);
        }
        
        if ($request->has('tratamento')) {
            $desc = array('tt.descricao', 'like', '%' . $request->input('tratamento') . '%');
            array_push($arr, $desc);
        }
       
        if (count($arr) > 0) {
            $residuos = DB::table('residuo')
                    ->leftJoin('classe_residuo as cr', 'id_classe', 'cr.id')
                    ->leftJoin('tipo_residuo as tr', 'id_tipo_residuo', 'tr.id')
                    ->leftJoin('acondicionamento as ac', 'id_acondicionamento', 'ac.id')
                    ->leftJoin('tipo_tratamento as tt', 'id_tratamento', 'tt.id')
                    ->select('residuo.*','cr.descricao as classe_residuo', 'tr.descricao as tipo_residuo', 'ac.descricao as acondicionamento', 'tt.descricao as tratamento')
                    ->where($arr)->orderBy($orderkey, $order)->paginate($nrcount);
            //$tiporesiduos = new ResiduoCollection(Residuo::where()->where($arr)->orderBy($orderkey, $order)->paginate($nrcount));            
        } else {
            $residuos = DB::table('residuo')
                    ->leftJoin('classe_residuo as cr', 'id_classe', 'cr.id')
                    ->leftJoin('tipo_residuo as tr', 'id_tipo_residuo', 'tr.id')
                    ->leftJoin('acondicionamento as ac', 'id_acondicionamento', 'ac.id')
                    ->leftJoin('tipo_tratamento as tt', 'id_tratamento', 'tt.id')
                    ->select('residuo.*','cr.descricao as classe_residuo', 'tr.descricao as tipo_residuo', 'ac.descricao as acondicionamento', 'tt.descricao as tratamento')
                    ->orderBy($orderkey, $order)->paginate($nrcount);
            //$tiporesiduos = DB::table('tipo_residuo')->orderBy($orderkey, $order)->paginate($nrcount);
//            $tiporesiduos = new ResiduoCollection(Residuo::orderBy($orderkey, $order)->paginate($nrcount));
        }

        return response()->json($residuos, 200) ;;
//        return $tiporesiduos->response()->setStatusCode(200) ;
    }
    
    public function listResiduo()
    {
        $residuo = Residuo::orderby('descricao')->get();
        return response()->json($residuo, 200);
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
//    private function tiporesiduoValitation(Request $request) {        
//        $validator = Validator::make($request->all(), [
//                    'descricao' => 'required|unique:servico|max:50'
//        ], parent::$messages);
//
//        return $validator;
//    }
    
    /**
     * Metodo de validação da classe.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Support\Facades\Validator
     */
    private function ValitationStore(Request $request) {        
        $validator = Validator::make($request->all(), [
                    'descricao' => 'required|unique:residuo|max:50',
                    'tipo_receita' => 'required',
        ], parent::$messages);

        return $validator;
    }
    
    /**
     * Metodo de validação da classe.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Support\Facades\Validator
     */
    private function ValitationUpdate(Request $request, Residuo $residuo) {        
        $validator = Validator::make($request->all(), [                            
                    'descricao' => ['required',
                                    Rule::unique('residuo')->ignore($residuo->id),
                                    'max:50'],
                    'tipo_receita' => 'required',                
        ], parent::$messages);

        return $validator;
    }

    /**
     * Valida informações de Residuo
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

        $tiporesiduo = new Residuo();
        $tiporesiduo->fill($request->all());
        $tiporesiduo->save();
        
        $residuo = DB::table('residuo')
                    ->leftJoin('classe_residuo as cr', 'id_classe', 'cr.id')
                    ->leftJoin('tipo_residuo as tr', 'id_tipo_residuo', 'tr.id')
                    ->leftJoin('acondicionamento as ac', 'id_acondicionamento', 'ac.id')
                    ->leftJoin('tipo_tratamento as tt', 'id_tratamento', 'tt.id')
                    ->select('residuo.*','cr.descricao as classe_residuo', 'tr.descricao as tipo_residuo', 'ac.descricao as acondicionamento', 'tt.descricao as tratamento')
                    ->where('residuo.id',$tiporesiduo->id)
                    ->get()->first();
        
        return response()->json($residuo, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \SGR\Residuo  $residuo
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        $residuo = DB::table('residuo')
                    ->leftJoin('classe_residuo as cr', 'id_classe', 'cr.id')
                    ->leftJoin('tipo_residuo as tr', 'id_tipo_residuo', 'tr.id')
                    ->leftJoin('acondicionamento as ac', 'id_acondicionamento', 'ac.id')
                    ->leftJoin('tipo_tratamento as tt', 'id_tratamento', 'tt.id')
                    ->select('residuo.*','cr.descricao as classe_residuo', 'tr.descricao as tipo_residuo', 'ac.descricao as acondicionamento', 'tt.descricao as tratamento')
                    ->where('residuo.id',$id)
                    ->get()->first();
        return response()->json($residuo, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \SGR\Residuo  $residuo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Residuo $residuo) {
        
        $validator = $this->ValitationUpdate($request, $residuo);

        if ($validator->fails()) {
            return response()->json([
                        'error' => 'Validação falhou',
                        'message' => $validator->errors()->all(),
                            ], 422);
        }
        
        $residuo->update($request->all());
        
        $res = DB::table('residuo')
                    ->leftJoin('classe_residuo as cr', 'id_classe', 'cr.id')
                    ->leftJoin('tipo_residuo as tr', 'id_tipo_residuo', 'tr.id')
                    ->leftJoin('acondicionamento as ac', 'id_acondicionamento', 'ac.id')
                    ->leftJoin('tipo_tratamento as tt', 'id_tratamento', 'tt.id')
                    ->select('residuo.*','cr.descricao as classe_residuo', 'tr.descricao as tipo_residuo', 'ac.descricao as acondicionamento', 'tt.descricao as tratamento')
                    ->where('residuo.id', $residuo->id)
                    ->first();

        return response()->json($res, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \SGR\Residuo  $tiporesiduo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Residuo $tiporesiduo) {
        if (count($tiporesiduo->contrato_fornecedores()->get())){
            throw new APIException('Resíduo não pode ser excluído. Pois esta sendo utilizado em um ou mais contratos de Fornecedores');
        }
        
        if (count($tiporesiduo->contrato_clientes()->get())){
            throw new APIException('Resíduo não pode ser excluído. Pois esta sendo utilizado em um ou mais contratos de Clientes');
        }
        
        if (count($tiporesiduo->manifesto_servicos()->get())){
            throw new APIException('Resíduo não pode ser excluído. Pois esta sendo utilizado em um ou mais Manifestos');
        }
        $tiporesiduo->delete();
        return response()->json(null, 200);
    }

}
