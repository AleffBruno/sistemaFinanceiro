@extends('adminlte::page')

@section('title', 'Transferir')

@section('content_header')
    <h1>Transferir</h1>

    <ol class="breadcrumb">
        <li><a href="">Dashboard</a></li>
        <li><a href="">Saldo</a></li>      
        <li><a href="">Transferir</a></li>     
    </ol>
@stop

@section('content')
    <div class="box">
        <div class="box-header">
            <h3>Transferir o saldo (informe o recebedor)</h3>
        </div>

        <div class="box-body">
        
            @include('admin.includes.alerts')

            <form method="POST" action="{{route('confirm.transfer')}}">
                {!! csrf_field() !!}
                <div class="form-group">
                    <input name="sender" class="form-control" type="text" placeholder="Informação de quem vai receber">
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-success">Proxima Etapa</button>
                </div>
            </form>
        </div>
    </div>
@stop