<?php

namespace App\Http\Controllers;

use App\Cidade;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use Validator;

class CidadeController extends Controller
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
        $orderkey = 'cCod';
        $order = 'asc';

        $arr = array();

        if ($request->has('cUF')) {
            $desc = array('cUF', '=', $request->input('cUF'));
            array_push($arr, $desc);
        }
                               
        if (count($arr) > 0) {
            $cidade = Cidade::where($arr)->orderBy($orderkey, $order)->get();
        } else {
            $cidade = Cidade::orderBy($orderkey, $order)->get();
        }


        return response()->json($cidade,200);
    }
        
    /**
     * Display the specified resource.
     *
     * @param  \App\cidade  $cidade
     * @return \Illuminate\Http\Response
     */
    public function show(Cidade $cidade)
    {
        return response()->json($cidade, 200);
    }        
}
