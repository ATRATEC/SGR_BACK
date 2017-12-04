<?php

namespace SGR\Http\Controllers;

use Illuminate\Http\Request;
use SGR\Proxy\MovimentoEstoque\MovimentoEstoqueProxy;
use SGR\Proxy\MovimentoEstoque\epListarRequest;
use SGR\Proxy\MovimentoEstoque\epListarResponse;
use SGR\Proxy\MovimentoEstoque\cadastros;
use SGR\Proxy\MovimentoEstoque\movimentos;

use SGR\Proxy\ConsultaEstoque\ConsultaEstoqueProxy;
use SGR\Proxy\ConsultaEstoque\ListarEstPosRequest;
use SGR\Proxy\ConsultaEstoque\ListarEstPosResponse;
use SGR\Proxy\ConsultaEstoque\estoqueMovimentoRequest;
use SGR\Proxy\ConsultaEstoque\estoqueMovimentoResponse;
use SGR\Proxy\ConsultaEstoque\estoque_mov_consulta_cadastro;
use SGR\Proxy\ConsultaEstoque\estoque_mov_consulta_cadastro_resposta;
use SGR\Proxy\ConsultaEstoque\movPeriodo;
use SGR\Proxy\ConsultaEstoque\movProduto;
use SGR\Proxy\ConsultaEstoque\produtos;

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
