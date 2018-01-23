<?php

namespace App\Http\Controllers;

use App\TipoResiduo;
use App\Http\Resources\TipoResiduoCollection;
use App\Exceptions\APIException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use Illuminate\Validation\Rule;
use Validator;

class TipoResiduoController extends Controller
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
            $tiporesiduo = new TipoResiduoCollection(TipoResiduo::where($arr)->orderBy($orderkey, $order)->paginate($nrcount));
            // $tiporesiduo = DB::table('tiporesiduo')->where($arr)->orderBy($orderkey, $order)->paginate($nrcount);
        } else {
            $tiporesiduo = new TipoResiduoCollection(TipoResiduo::orderBy($orderkey, $order)->paginate($nrcount));
        }


        return $tiporesiduo->response()->setStatusCode(200); //response()->json($tiporesiduo,200);
    }
    
    public function listTipoResiduo()
    {
        $tiporesiduo = TipoResiduo::all();
        return response()->json($tiporesiduo, 200);
    }
    
    /**
     * Metodo de validação da classe.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Support\Facades\Validator
     */
    private function ValitationStore(Request $request) {        
        $validator = Validator::make($request->all(), [                            
                    'descricao' => 'required|unique:tipo_residuo|max:50',
        ], parent::$messages);

        return $validator;
    }
    
    /**
     * Metodo de validação da classe.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Support\Facades\Validator
     */
    private function ValitationUpdate(Request $request, TipoResiduo $tiporesiduo) {        
        $validator = Validator::make($request->all(), [                            
                    'descricao' => ['required',
                                    Rule::unique('tiporesiduo')->ignore($tiporesiduo->id),
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

        $tiporesiduo = new TipoResiduo();
        $tiporesiduo->fill($request->all());
        $tiporesiduo->save();
        return response()->json($tiporesiduo, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\tiporesiduo  $tiporesiduo
     * @return \Illuminate\Http\Response
     */
    public function show(TipoResiduo $tiporesiduo)
    {
        return response()->json($tiporesiduo, 200);
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\tiporesiduo  $tiporesiduo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TipoResiduo $tiporesiduo)
    {
        $validator = $this->ValitationUpdate($request,$tiporesiduo);

        if ($validator->fails()) {
            return response()->json([
                        'error' => 'Validação falhou',
                        'message' => $validator->errors()->all(),
                            ], 422);
        }
        
        $tiporesiduo->update($request->all());

        return response()->json($tiporesiduo, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\tiporesiduo  $tiporesiduo
     * @return \Illuminate\Http\Response
     */
    public function destroy(TipoResiduo $tiporesiduo)
    {        
        $tiporesiduo->delete();
        return response()->json(null, 200);
    }
}
