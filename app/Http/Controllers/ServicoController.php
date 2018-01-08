<?php

namespace App\Http\Controllers;

use App\Servico;
use App\Http\Resources\ServicoCollection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use Illuminate\Validation\Rule;
use Validator;

class ServicoController extends Controller
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
              
        if ($request->has('descricao')) {
            $desc = array('descricao', 'like', '%' . $request->input('descricao') . '%');
            array_push($arr, $desc);
        }
       
        if (count($arr) > 0) {
            $servico = new ServicoCollection(Servico::where($arr)->orderBy($orderkey, $order)->paginate($nrcount));
            // $servico = DB::table('servico')->where($arr)->orderBy($orderkey, $order)->paginate($nrcount);
        } else {
            $servico = new ServicoCollection(Servico::orderBy($orderkey, $order)->paginate($nrcount));
        }


        return $servico->response()->setStatusCode(200); //response()->json($servico,200);
    }
    
    public function listServico()
    {
        $servico = Servico::all();
        return response()->json($servico, 200);
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

        $servico = new Servico();
        $servico->fill($request->all());
        $servico->save();
        return response()->json($servico, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\servico  $servico
     * @return \Illuminate\Http\Response
     */
    public function show(Servico $servico)
    {
        return response()->json($servico, 200);
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\servico  $servico
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Servico $servico)
    {
        $validator = $this->ValitationUpdate($request,$servico);

        if ($validator->fails()) {
            return response()->json([
                        'error' => 'Validação falhou',
                        'message' => $validator->errors()->all(),
                            ], 422);
        }
        
        $servico->update($request->all());

        return response()->json($servico, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\servico  $servico
     * @return \Illuminate\Http\Response
     */
    public function destroy(Servico $servico)
    {
        $servico->delete();
        return response()->json(null, 200);
    }
}
