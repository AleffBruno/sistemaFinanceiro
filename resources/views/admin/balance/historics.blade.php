@extends('adminlte::page')

@section('title', 'Historico')

@section('content_header')
    <h1>Historico</h1>
    

    <ol class="breadcrumb">
        <li><a href="">Dashboard</a></li>
        <li><a href="">Historico</a></li>        
    </ol>
@stop

@section('content')
    <div class="box">
        <div class="box-header">
        </div>

        <div class="box-body">
            <table class="table table-borderedtable-hover">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Valor</th>
                        <th>Saldo</th>
                        <th>Data</th>
                        <th>Sender</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($historics as $historic)
                    <tr>
                        <td>{{$historic->id}}</td>
                        <td>{{$historic->amount}}</td>
                        <td>{{$historic->type}}</td>
                        <td>{{$historic->date}}</td>
                        <td>{{$historic->user_id_transaction}}</td>
                    </tr>
                    @empty
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@stop