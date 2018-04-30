@extends('adminlte::page')

@section('title', 'Confirmar Transferencia')

@section('content_header')
    <h1>Confirmar Transferencia</h1>

    <ol class="breadcrumb">
        <li><a href="">Dashboard</a></li>
        <li><a href="">Saldo</a></li>      
        <li><a href="">Transferir</a></li>  
        <li><a href="">Confirmação</a></li>    
    </ol>
@stop

@section('content')
    <div class="box">
        <div class="box-header">
            <h3>Confirmar Transferencia</h3>
        </div>

        <div class="box-body">
        
            @include('admin.includes.alerts')

            <!-- sender received from balance -->
            <p><strong>Recebedor: </strong>{{$sender->name}}</p>

            <form method="POST" action="{{route('transfer.store')}}">
                {!! csrf_field() !!}

                <input name="sender_id"type="hidden" value="{{$sender->id}}">

                <div class="form-group">
                    <input name="balance" class="form-control" type="text" placeholder="Valor">
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-success">Transferir</button>
                </div>
            </form>
        </div>
    </div>
@stop