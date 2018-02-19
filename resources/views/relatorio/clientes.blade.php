@extends('layouts.relatorio')

@section('content')


<table class="a4" style="padding: 0px 0px 0px 0px; margin: 0px 0px 0px 0px" border="0">
    <tr>
        <th style="background-color: #FFFFFF; width: 200px">                
            <img src="{{URL::asset('assets/imagens/logo_av.png')}}" alt="profile Pic" height="60px" width="200px">
        </th>
        <th style="background-color: #FFFFFF">            
            <div style="background-color: #FFFFFF"><center><h2>Relatório gerencial de Receitas</h2></center></div>
            <div style="background-color: #FFFFFF"><center>Período {{$periodode}} até {{$periodoate}}</center></div>
        </th>
        <th style="background-color: #FFFFFF; width: 200px">
            <div style="text-align: right; font-size: 10px">Data/Hora:{{date('d/m/Y - H:i')}}</div>
            <!--<div style="text-align: right">{{date('')}}</div>-->
            <div style="text-align: right">info</div>
        </th>
    </tr>
</table>
<hr>
<span>Cliente: <b>Lojas Renner S/A.</b></span>
<hr>
<table style="width: 100%">
    
    <tr style="background-color: #DDD; font-size: 12px">
        <th>Dt Coleta</th>        
        <th>Nº Manifesto</th>
        <th>Resíduo</th>
        <th>Transportador</th>
        <th>Destinador</th>
        <th>Qtd</th>
        <th>Und</th>
        <th>Val Unit.</th>
        <th>Val Total</th>
    </tr>
    @if (count($clientes) > 0)
        @foreach ($clientes as $cliente)
            @switch($loop->index)
                @case(60)
                    </table>
                    <div class="page-break"></div>
                    <table style="width: 100%">
                    <tr style="background-color: #DDD; font-size: 12px">
                        <th>Dt Coleta</th>        
                        <th>Nº Manifesto</th>
                        <th>Resíduo</th>
                        <th>Transportador</th>
                        <th>Destinador</th>
                        <th>Qtd</th>
                        <th>Und</th>
                        <th>Val Unit.</th>
                        <th>Val Total</th>
                    </tr>
                    <tr style="font-size: 8px">
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td >{{$cliente->id}}</td>
                        <td>{{$cliente->cnpj_cpf}}</td>
                        <td>{{$cliente->razao_social}}</td>
                    </tr>   
                    @break

                @case(80)
                    </table>        
                    <div class="page-break"></div>
                    <table style="width: 100%">
                    <tr style="background-color: #DDD; font-size: 12px">
                        <th>Dt Coleta</th>        
                        <th>Nº Manifesto</th>
                        <th>Resíduo</th>
                        <th>Transportador</th>
                        <th>Destinador</th>
                        <th>Qtd</th>
                        <th>Und</th>
                        <th>Val Unit.</th>
                        <th>Val Total</th>
                    </tr>
                    <tr style="font-size: 8px">
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td >{{$cliente->id}}</td>
                        <td>{{$cliente->cnpj_cpf}}</td>
                        <td></td>
                    </tr>   
                    @break

                @default
                    <tr style="font-size: 8px">
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>{{$cliente->id}}</td>
                        <td>{{$cliente->cnpj_cpf}}</td>
                        <td></td>
                    </tr>   
            @endswitch
        @endforeach
    @endif
</table>
            
<!--<div style="float: none; position: absolute; width: 100%; display: inline-block">
    <div style="float: left; position: static; background-color: red;display: inline; width: 150px">imagem</div>
    <div style="background-color: blue; width: 550px">titulo</div>
    <div style="float: right; position: relative; background-color: green; width: 150px">infopag</div>
</div>-->
<!--<div style="display: inline-block; width: 100%; background-color: gray">linha</div>-->

<!--<table>
    <tr style="background-color: #DDD">
        <th>Código</th>        
        <th>CNPJ / CPF</th>
        <th>Razão Social</th>
    </tr>
    @if (count($clientes) > 0)
        @foreach ($clientes as $cliente)
            <tr>
                <td >{{$cliente->id}}</td>
                <td>{{$cliente->cnpj_cpf}}</td>
                <td>{{$cliente->razao_social}}</td>
            </tr>            
        @endforeach
    @endif
</table>-->
@endsection

