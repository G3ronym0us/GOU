
@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>Notificaciones Push</h1>
        </div>
        <div class="col-md-12 table-responsive">
            <table class="table table-stripe">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Título</th>
                        <th>Contenido</th>
                        <th>Destinatarios</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($notifications as $n)
                        <tr>
                            <td>{{$n->id}}</td>
                            <td>{{$n->title}}</td>
                            <td>{{$n->content}}</td>
                            <td>{{$n->destination}}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection