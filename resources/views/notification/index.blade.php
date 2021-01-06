
@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>Historial de Notificaciones</h1>
        </div>
        <div class="col-md-12 table-responsive">
            <table class="table table-stripe">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Usuario</th>
                        <th>Mensaje</th>
                        <th>Fecha</th>
                        <th>Leida</th>
                        <th>Accion</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($notifications as $n)
                        <tr>
                            <td>{{$n->id}}</td>
                            <td>{{$n->user->name}}</td>
                            <td>{{$n->mensaje}}</td>
                            <td>{{date('d/m/Y H:m:s', strtotime($n->created_at))}}</td>
                            <td>{{$n->isread == true ? "Sí" : "No"}}</td>
                            <td><button class="btn btn-info">Ver</button></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection