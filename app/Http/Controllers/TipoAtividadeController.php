<?php

namespace App\Http\Controllers;

use App\TipoAtividade;
use App\Http\Resources\TipoAtividadeCollection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use Validator;

class TipoAtividadeController extends Controller
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
            $tipoatividade = new TipoAtividadeCollection(TipoAtividade::where($arr)->orderBy($orderkey, $order)->paginate($nrcount));
            // $tipoatividade = DB::table('tipoatividade')->where($arr)->orderBy($orderkey, $order)->paginate($nrcount);
        } else {
            $tipoatividade = new TipoAtividadeCollection(TipoAtividade::orderBy($orderkey, $order)->paginate($nrcount));
        }


        return $tipoatividade->response()->setStatusCode(200); //response()->json($tipoatividade,200);
    }
    
    public function listTipoAtividade()
    {
        $tipoatividade = TipoAtividade::all();
        return response()->json($tipoatividade, 200);
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

        $tipoatividade = new TipoAtividade();
        $tipoatividade->fill($request->all());
        $tipoatividade->save();
        return response()->json($tipoatividade, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\tipoatividade  $tipoatividade
     * @return \Illuminate\Http\Response
     */
    public function show(TipoAtividade $tipoatividade)
    {
        return response()->json($tipoatividade, 200);
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\tipoatividade  $tipoatividade
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TipoAtividade $tipoatividade)
    {
        $validator = $this->Valitation($request);

        if ($validator->fails()) {
            return response()->json([
                        'message' => 'Validação falhou',
                        'errors' => $validator->errors()
                            ], 422);
        }
        
        $tipoatividade->update($request->all());

        return response()->json($tipoatividade, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\tipoatividade  $tipoatividade
     * @return \Illuminate\Http\Response
     */
    public function destroy(TipoAtividade $tipoatividade)
    {
        $tipoatividade->delete();
        return response()->json(null, 200);
    }
}
