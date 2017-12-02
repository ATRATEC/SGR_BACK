@extends('layouts.app')

@section('content')
    @if (count($cadastros) > 0)
        @foreach ($cadastros as $cadastro)
            Codigo:{{$cadastro->nCodProd}}
            <br>
            Descrição: {{$cadastro->cDescricao}}
            <br>
            <b>Movimentações:</b> 
            <br>
            @foreach ($cadastro->movimentos as $movimento)
            &nbsp;&nbsp;&nbsp;&nbsp;Data: {{$movimento->dDataMovimento}} <br>
            &nbsp;&nbsp;&nbsp;&nbsp;QtdEntrada: {{$movimento->nQtdeEntradas}} <br>
            &nbsp;&nbsp;&nbsp;&nbsp;QtdSaida: {{$movimento->nQtdeSaidas}} <br>
            @endforeach
        @endforeach
    @endif

@endsection
