<?php

namespace App\Http\Controllers;

use App\Fornecedor;
use App\Http\Resources\FornecedorCollection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use Validator;

class FornecedorController extends Controller
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
            $fornecedor = new FornecedorCollection(Fornecedor::where($arr)->orderBy($orderkey, $order)->paginate($nrcount));
            // $fornecedor = DB::table('fornecedor')->where($arr)->orderBy($orderkey, $order)->paginate($nrcount);
        } else {
            $fornecedor = new FornecedorCollection(Fornecedor::orderBy($orderkey, $order)->paginate($nrcount));
        }


        return $fornecedor->response()->setStatusCode(200); //response()->json($fornecedor,200);
    }
    
    /**
     * Metodo de validação da classe.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Support\Facades\Validator
     */
    private function Valitation(Request $request) {        
        $validator = Validator::make($request->all(), [                    
                    'razao_social' => 'required|max:60'                    
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
        $validator = $this->Valitation($request);

        if ($validator->fails()) {
            return response()->json([
                        'message' => 'Validação falhou',
                        'errors' => $validator->errors()
                            ], 422);
        }

        $fornecedor = new Fornecedor();
        $fornecedor->fill($request->all());
        $fornecedor->save();
        return response()->json($fornecedor, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\fornecedor  $fornecedor
     * @return \Illuminate\Http\Response
     */
    public function show(Fornecedor $fornecedor)
    {
        return response()->json($fornecedor, 200);
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\fornecedor  $fornecedor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Fornecedor $fornecedor)
    {
        $validator = $this->Valitation($request);

        if ($validator->fails()) {
            return response()->json([
                        'message' => 'Validação falhou',
                        'errors' => $validator->errors()
                            ], 422);
        }
        
        $fornecedor->update($request->all());

        return response()->json($fornecedor, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\fornecedor  $fornecedor
     * @return \Illuminate\Http\Response
     */
    public function destroy(Fornecedor $fornecedor)
    {
        $fornecedor->delete();
        return response()->json(null, 200);
    }
}
