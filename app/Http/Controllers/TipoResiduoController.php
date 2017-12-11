<?php

namespace App\Http\Controllers;

use App\TipoResiduo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use Validator;

class TipoResiduoController extends Controller {

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
            $tiporesiduos = DB::table('tiporesiduo')->where($arr)->orderBy($orderkey, $order)->paginate($nrcount);
        } else {
            $tiporesiduos = DB::table('tiporesiduo')->orderBy($orderkey, $order)->paginate($nrcount);
        }


        return $tiporesiduos;
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
    private function tiporesiduoValitation(Request $request) {        
        $validator = Validator::make($request->all(), [
                    'codigo' => 'required|integer',
                    'descricao' => 'required|max:50'
        ], parent::$messages);

        return $validator;
    }

    /**
     * Valida informações de TipoResiduo
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        
        $validator = $this->tiporesiduoValitation($request);

        if ($validator->fails()) {
            return response()->json([
                        'message' => 'Validação falhou',
                        'errors' => $validator->errors()
                            ], 422);
        }

        $tiporesiduo = new TipoResiduo();
        $tiporesiduo->fill($request->all());
        $tiporesiduo->save();
        return response()->json($tiporesiduo, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \SGR\tiporesiduo  $tiporesiduo
     * @return \Illuminate\Http\Response
     */
    public function show(TipoResiduo $tiporesiduo) {
        return response()->json($tiporesiduo, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \SGR\TipoResiduo  $tiporesiduo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TipoResiduo $tiporesiduo) {
        
        $validator = $this->tiporesiduoValitation($request);

        if ($validator->fails()) {
            return response()->json([
                        'message' => 'Validação falhou',
                        'errors' => $validator->errors()
                            ], 422);
        }
        
        $tiporesiduo->update($request->all());

        return response()->json($tiporesiduo, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \SGR\tiporesiduo  $tiporesiduo
     * @return \Illuminate\Http\Response
     */
    public function destroy(TipoResiduo $tiporesiduo) {
        $tiporesiduo->delete();
        return response()->json(null, 200);
    }

}
