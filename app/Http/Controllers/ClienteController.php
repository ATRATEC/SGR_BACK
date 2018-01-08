<?php

namespace App\Http\Controllers;

use App\Cliente;
use App\Http\Resources\ClienteCollection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use Illuminate\Validation\Rule;
use Validator;

class ClienteController extends Controller
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
        
        if ($request->has('codigo_omie')) {
            $desc = array('codigo_omie', 'like', '%' . $request->input('codigo_omie') . '%');
            array_push($arr, $desc);
        }

        if ($request->has('cnpj_cpf')) {
            $desc = array('cnpj_cpf', 'like', '%' . $request->input('cnpj_cpf') . '%');
            array_push($arr, $desc);
        }
        
        if ($request->has('razao_social')) {
            $desc = array('razao_social', 'like', '%' . $request->input('razao_social') . '%');
            array_push($arr, $desc);
        }
        
        if ($request->has('contato')) {
            $desc = array('contato', 'like', '%' . $request->input('contato') . '%');
            array_push($arr, $desc);
        }
        
        if ($request->has('telefone1_numero')) {
            $desc = array('telefone1_numero', 'like', '%' . $request->input('telefone1_numero') . '%');
            array_push($arr, $desc);
        }
        
        if ($request->has('email')) {
            $desc = array('email', 'like', '%' . $request->input('email') . '%');
            array_push($arr, $desc);
        }
       
        if (count($arr) > 0) {
            $cliente = new ClienteCollection(Cliente::where($arr)->orderBy($orderkey, $order)->paginate($nrcount));
            // $cliente = DB::table('cliente')->where($arr)->orderBy($orderkey, $order)->paginate($nrcount);
        } else {
            $cliente = new ClienteCollection(Cliente::orderBy($orderkey, $order)->paginate($nrcount));
        }


        return $cliente->response()->setStatusCode(200); //response()->json($cliente,200);
    }
    
    /**
     * Metodo de validação da classe.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Support\Facades\Validator
     */
    private function ValitationStore(Request $request) {        
        $validator = Validator::make($request->all(), [                                
                    'razao_social' => 'required|max:60',
                    'cnpj_cpf' => 'required|unique:cliente|max:20',
        ], parent::$messages);

        return $validator;
    }
    
    /**
     * Metodo de validação da classe.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Support\Facades\Validator
     */
    private function ValitationUpdate(Request $request, Cliente $cliente) {        
        $validator = Validator::make($request->all(), [                                
                    'razao_social' => 'required|max:60',
                    'cnpj_cpf' => ['required',
                                    Rule::unique('cliente')->ignore($cliente->id),
                                    'max:20'],
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

        $cliente = new Cliente();
        $cliente->fill($request->all());
        $cliente->save();
        return response()->json($cliente, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function show(Cliente $cliente)
    {
        return response()->json($cliente, 200);
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cliente $cliente)
    {
        $validator = $this->ValitationUpdate($request, $cliente);

        if ($validator->fails()) {
            return response()->json([
                        'error' => 'Validação falhou',
                        'message' => $validator->errors()->all(),
                            ], 422);
        }
        
        $cliente->update($request->all());

        return response()->json($cliente, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cliente $cliente)
    {
        $cliente->delete();
        return response()->json(null, 200);
    }
}
