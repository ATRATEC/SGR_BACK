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
<span>Cliente: <b>{{$cliente->razao_social}}</b></span>
<hr>
<table style="width: 100%">
    
    <tr style="background-color: #DDD; font-size: 12px">
        <th>Dt Coleta</th>        
        <th>Nº Manifesto</th>
        <th>Resíduo</th>
        <th>Transportador</th>
        <th>Destinador</th>
        <th style="text-align: right">Qtd</th>
        <th style="text-align: center">Und</th>
        <th style="text-align: right">Val Unit.</th>
        <th style="text-align: right">Val Total</th>
    </tr>
    @if (count($receitas) > 0)
        <?php $i = 0 ?>
        @foreach ($receitas as $receita)
            <?php $i += $receita->valor_total ?>
            <tr style="font-size: 10px">
                <td>{{date_format(date_create($receita->coleta), 'd/m/Y')}}</td>
                <td>{{$receita->manifesto}}</td>
                <td>{{$receita->residuo}}</td>
                <td>{{$receita->transportador}}</td>
                <td>{{$receita->destinador}}</td>
                <td style="text-align: right">{{$receita->quantidade}}</td>
                <td style="text-align: center">{{$receita->unidade}}</td>
                <td style="text-align: right">{{number_format($receita->valor_unitario,2,',','.')}}</td>
                <td style="text-align: right">{{number_format($receita->valor_total,2,',','.')}}</td>
            </tr> 
<!--            @switch($loop->index)
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
                        <th style="text-align: right">Qtd</th>
                        <th style="text-align: center">Und</th>
                        <th style="text-align: right">Val Unit.</th>
                        <th style="text-align: right">Val Total</th>
                    </tr>
                    <tr style="font-size: 8px">
                        <td>{{date_format(date_create($receita->coleta), 'd/m/Y')}}</td>
                        <td>{{$receita->manifesto}}</td>
                        <td>{{$receita->residuo}}</td>
                        <td>{{$receita->transportador}}</td>
                        <td>{{$receita->destinador}}</td>
                        <td style="text-align: right">{{$receita->quantidade}}</td>
                        <td style="text-align: center">{{$receita->unidade}}</td>
                        <td style="text-align: right">{{number_format($receita->valor_unitario,2,',','.')}}</td>
                        <td style="text-align: right">{{number_format($receita->valor_total,2,',','.')}}</td>
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
                        <th style="text-align: right">Qtd</th>
                        <th style="text-align: center">Und</th>
                        <th style="text-align: right">Val Unit.</th>
                        <th style="text-align: right">Val Total</th>
                    </tr>
                    <tr style="font-size: 8px">
                        <td>{{date_format(date_create($receita->coleta), 'd/m/Y')}}</td>
                        <td>{{$receita->manifesto}}</td>
                        <td>{{$receita->residuo}}</td>
                        <td>{{$receita->transportador}}</td>
                        <td>{{$receita->destinador}}</td>
                        <td style="text-align: right">{{$receita->quantidade}}</td>
                        <td style="text-align: center">{{$receita->unidade}}</td>
                        <td style="text-align: right">{{number_format($receita->valor_unitario,2,',','.')}}</td>
                        <td style="text-align: right">{{number_format($receita->valor_total,2,',','.')}}</td>
                    </tr>   
                    @break

                @default
                    <tr style="font-size: 8px">
                        <td>{{date_format(date_create($receita->coleta), 'd/m/Y')}}</td>
                        <td>{{$receita->manifesto}}</td>
                        <td>{{$receita->residuo}}</td>
                        <td>{{$receita->transportador}}</td>
                        <td>{{$receita->destinador}}</td>
                        <td style="text-align: right">{{$receita->quantidade}}</td>
                        <td style="text-align: center">{{$receita->unidade}}</td>
                        <td style="text-align: right">{{number_format($receita->valor_unitario,2,',','.')}}</td>
                        <td style="text-align: right">{{number_format($receita->valor_total,2,',','.')}}</td>
                    </tr>   
            @endswitch-->
        @endforeach        
    @endif
</table>
<hr>
<table style="width: 100%">
    <tr style="font-size: 10px">
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td style="text-align: right"></td>
            <td style="text-align: center"></td>                        
            <td colspan="2" style="text-align: right"><b>Total Geral:</b> {{number_format($i,2,',','.')}}</td>            
        </tr>
</table>
@endsection

