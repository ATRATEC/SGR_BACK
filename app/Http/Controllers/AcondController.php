<?php

namespace App\Http\Controllers;

use App\Acondicionamento;
use App\Http\Resources\AcondicionamentoCollection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use Validator;

class AcondController extends Controller
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
            $acondicionamento = new AcondicionamentoCollection(Acondicionamento::where($arr)->orderBy($orderkey, $order)->paginate($nrcount));
            // $acondicionamento = DB::table('acondicionamento')->where($arr)->orderBy($orderkey, $order)->paginate($nrcount);
        } else {
            $acondicionamento = new AcondicionamentoCollection(Acondicionamento::orderBy($orderkey, $order)->paginate($nrcount));
        }


        return $acondicionamento->response()->setStatusCode(200); //response()->json($acondicionamento,200);
    }
    
    public function listAcondicionamento() {
        $acondicionamento = Acondicionamento::all();
        return response()->json($acondicionamento, 200);
    }
    
    /**
     * Metodo de validação da classe.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Support\Facades\Validator
     */
    private function ValitationStore(Request $request) {        
        $validator = Validator::make($request->all(), [
                    'descricao' => 'required|unique:acondicionamento|max:50'
        ], parent::$messages);

        return $validator;
    }
    
    /**
     * Metodo de validação da classe.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Support\Facades\Validator
     */
    private function ValitationUpdate(Request $request, Acondicionamento $acondicionamento) {        
        $validator = Validator::make($request->all(), [                            
                    'descricao' => ['required',
                                    Rule::unique('acondicionamento')->ignore($acondicionamento->id),
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

        $acondicionamento = new Acondicionamento();
        $acondicionamento->fill($request->all());
        $acondicionamento->save();
        return response()->json($acondicionamento, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\acondicionamento  $acondicionamento
     * @return \Illuminate\Http\Response
     */
    public function show(Acondicionamento $acondicionamento)
    {
        return response()->json($acondicionamento, 200);
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\acondicionamento  $acondicionamento
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Acondicionamento $acondicionamento)
    {
        $validator = $this->ValitationUpdate($request,$acondicionamento);

        if ($validator->fails()) {
            return response()->json([
                        'error' => 'Validação falhou',
                        'message' => $validator->errors()->all(),
                            ], 422);
        }
        
        $acondicionamento->update($request->all());

        return response()->json($acondicionamento, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\acondicionamento  $acondicionamento
     * @return \Illuminate\Http\Response
     */
    public function destroy(Acondicionamento $acondicionamento)
    {
        $acondicionamento->delete();
        return response()->json(null, 200);
    }
}
