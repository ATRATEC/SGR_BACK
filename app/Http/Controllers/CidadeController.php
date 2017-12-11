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
        $nrcount = $request->input('nrcount', 15);
        $orderkey = $request->input('orderkey', 'id');
        $order = $request->input('order', 'asc');

        $arr = array();

        if ($request->has('cUF')) {
            $desc = array('cUF', '=', $request->input('cUF'));
            array_push($arr, $desc);
        }
                               
        if (count($arr) > 0) {
            $cidade = DB::table('cidade')->where($arr)->orderBy($orderkey, $order)->paginate($nrcount);
        } else {
            $cidade = DB::table('cidade')->orderBy($orderkey, $order)->paginate($nrcount);
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
