<?php

namespace App\Http\Controllers;

use App\Produto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use Validator;

class ProdutoController extends Controller {

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

        if ($request->has('descricao')) {
            $desc = array('descricao', 'like', '%' . $request->input('descricao') . '%');
            array_push($arr, $desc);
        }

        if ($request->has('codigo')) {
            $desc = array('codigo', 'like', '%' . $request->input('codigo') . '%');
            array_push($arr, $desc);
        }


        if (count($arr) > 0) {
            $produtos = DB::table('produto')->where($arr)->orderBy($orderkey, $order)->paginate($nrcount);
        } else {
            $produtos = DB::table('produto')->orderBy($orderkey, $order)->paginate($nrcount);
        }


        return $produtos;
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
    private function produtoValitation(Request $request) {        
        $validator = Validator::make($request->all(), [
                    'codigo_produto' => 'required',
                    'codigo_produto_integracao' => 'max:20',
                    'codigo' => 'required|max:20',
                    'descricao' => 'required|max:100',
                    'ean' => 'max:14',
                    'ncm' => 'required|max:20',
                    'quantidade_estoque' => 'numeric'
        ], parent::$messages);

        return $validator;
    }

    /**
     * Valida informações de Produto
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        
        $validator = $this->produtoValitation($request);

        if ($validator->fails()) {
            return response()->json([
                        'message' => 'Validação falhou',
                        'errors' => $validator->errors()
                            ], 422);
        }

        $produto = new Produto();
        $produto->fill($request->all());
        $produto->save();
        return response()->json($produto, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \SGR\produto  $produto
     * @return \Illuminate\Http\Response
     */
    public function show(Produto $produto) {
        return response()->json($produto, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \SGR\Produto  $produto
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Produto $produto) {
        
        $validator = $this->produtoValitation($request);

        if ($validator->fails()) {
            return response()->json([
                        'message' => 'Validação falhou',
                        'errors' => $validator->errors()
                            ], 422);
        }
        
        $produto->update($request->all());

        return response()->json($produto, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \SGR\produto  $produto
     * @return \Illuminate\Http\Response
     */
    public function destroy(Produto $produto) {
        $produto->delete();
        return response()->json(null, 200);
    }

}
