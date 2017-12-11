<?php

namespace App\Http\Controllers;

use App\ClasseResiduo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use Validator;

class ClasseResiduoController extends Controller
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
        
        if ($request->has('codigo')) {
            $desc = array('codigo', 'like', '%' . $request->input('codigo') . '%');
            array_push($arr, $desc);
        }

        if ($request->has('descricao')) {
            $desc = array('descricao', 'like', '%' . $request->input('descricao') . '%');
            array_push($arr, $desc);
        }
       
        if (count($arr) > 0) {
            $classeresiduo = DB::table('classeresiduo')->where($arr)->orderBy($orderkey, $order)->paginate($nrcount);
        } else {
            $classeresiduo = DB::table('classeresiduo')->orderBy($orderkey, $order)->paginate($nrcount);
        }


        return response()->json($classeresiduo,200);
    }
    
    /**
     * Metodo de validação da classe.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Support\Facades\Validator
     */
    private function Valitation(Request $request) {        
        $validator = Validator::make($request->all(), [                    
                    'codigo' => 'required|integer',
                    'descricao' => 'required|max:50'                    
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

        $classeresiduo = new ClasseResiduo();
        $classeresiduo->fill($request->all());
        $classeresiduo->save();
        return response()->json($classeresiduo, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\acondicionamento  $classeresiduo
     * @return \Illuminate\Http\Response
     */
    public function show(ClasseResiduo $classeresiduo)
    {
        return response()->json($classeresiduo, 200);
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\acondicionamento  $classeresiduo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ClasseResiduo $classeresiduo)
    {
        $validator = $this->Valitation($request);

        if ($validator->fails()) {
            return response()->json([
                        'message' => 'Validação falhou',
                        'errors' => $validator->errors()
                            ], 422);
        }
        
        $classeresiduo->update($request->all());

        return response()->json($classeresiduo, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\acondicionamento  $classeresiduo
     * @return \Illuminate\Http\Response
     */
    public function destroy(ClasseResiduo $classeresiduo)
    {
        $classeresiduo->delete();
        return response()->json(null, 200);
    }
}
