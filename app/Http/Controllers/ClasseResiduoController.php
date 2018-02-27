<?php

namespace App\Http\Controllers;

use App\ClasseResiduo;
use App\Http\Resources\ClasseResiduoCollection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use App\Exceptions\APIException;
use Illuminate\Validation\Rule;
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
        
        if ($request->has('descricao')) {
            $desc = array('descricao', 'like', '%' . $request->input('descricao') . '%');
            array_push($arr, $desc);
        }
       
        if (count($arr) > 0) {
            $classeresiduo = new ClasseResiduoCollection(ClasseResiduo::where($arr)->orderBy($orderkey, $order)->paginate($nrcount));
        } else {
            $classeresiduo = new ClasseResiduoCollection(ClasseResiduo::orderBy($orderkey, $order)->paginate($nrcount));
        }


        return $classeresiduo->response()->setStatusCode(200);
    }
    
    public function listClasseResiduo()
    {
        $classeresiduos = ClasseResiduo::all();
        return response()->json($classeresiduos, 200);
    }
    
    /**
     * Metodo de validação da classe.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Support\Facades\Validator
     */
    private function ValitationStore(Request $request) {        
        $validator = Validator::make($request->all(), [
                    'descricao' => 'required|unique:classe_residuo|max:50'
        ], parent::$messages);

        return $validator;
    }
    
    /**
     * Metodo de validação da classe.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Support\Facades\Validator
     */
    private function ValitationUpdate(Request $request, ClasseResiduo $classeresiduo) {        
        $validator = Validator::make($request->all(), [                            
                    'descricao' => ['required',
                                    Rule::unique('classe_residuo')->ignore($classeresiduo->id),
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
        $validator = $this->ValitationUpdate($request, $classeresiduo);

        if ($validator->fails()) {
            return response()->json([
                        'error' => 'Validação falhou',
                        'message' => $validator->errors()->all(),
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
