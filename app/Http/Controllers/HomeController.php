<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Proxy\MovimentoEstoque\MovimentoEstoqueProxy;
use App\Proxy\MovimentoEstoque\epListarRequest;
use App\Proxy\MovimentoEstoque\epListarResponse;
use App\Proxy\MovimentoEstoque\cadastros;
use App\Proxy\MovimentoEstoque\movimentos;

use App\Proxy\ConsultaEstoque\ConsultaEstoqueProxy;
use App\Proxy\ConsultaEstoque\ListarEstPosRequest;
use App\Proxy\ConsultaEstoque\ListarEstPosResponse;
use App\Proxy\ConsultaEstoque\estoqueMovimentoRequest;
use App\Proxy\ConsultaEstoque\estoqueMovimentoResponse;
use App\Proxy\ConsultaEstoque\estoque_mov_consulta_cadastro;
use App\Proxy\ConsultaEstoque\estoque_mov_consulta_cadastro_resposta;
use App\Proxy\ConsultaEstoque\movPeriodo;
use App\Proxy\ConsultaEstoque\movProduto;
use App\Proxy\ConsultaEstoque\produtos;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }
    
    public function movimentos()
    {
        $movimentoestoque = new MovimentoEstoqueProxy();
        
        $req = new epListarRequest();
        $req->apenas_importado_api = 'N';
        $req->pagina = 1;
        $req->registros_por_pagina = 20;
        
        $resp = $movimentoestoque->ListarMovimentos($req);
        $cad = $resp->cadastros;
        
        return view('movimentos', ['cadastros' => $cad,]);
        
    }
    
    public function consultaestoque()
    {
        $consulta = new ConsultaEstoqueProxy();
        $req = new estoqueMovimentoRequest();
        $req->id_prod = 716272801;
        
        $resp = $consulta->MovimentoEstoque($req);
        
        return json_encode($resp);
    }
}
