@extends('adminlte::page')

@section('title', 'Nova Recarga')

@section('content_header')
    <h1>Fazer Retirada</h1>

    <ol class="breadcrumb">
        <li><a href="">Dashboard</a></li>
        <li><a href="">Saldo</a></li>      
        <li><a href="">Retirada</a></li>     
    </ol>
@stop

@section('content')
    <div class="box">
        <div class="box-header">
            <h3>Fazer retirada</h3>
        </div>

        <div class="box-body">
        
            @include('admin.includes.alerts')

            <form method="POST" action="{{route('withdraw.store')}}">
                {!! csrf_field() !!}
                <div class="form-group">
                    <input name="value" class="form-control" type="text" placeholder="Valor da Recarga">
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-success">Recarregar</button>
                </div>
            </form>
        </div>
    </div>
@stop