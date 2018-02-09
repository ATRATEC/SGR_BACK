@extends('layouts.relatorio')

@section('content')
<table>
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
</table>
@endsection

