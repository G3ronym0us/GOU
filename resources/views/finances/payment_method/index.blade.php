
@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-11">
        <button class="btn btn-success float-right" data-toggle="modal" data-target="#createPaymentMethod">Nuevo Metodo de Pago</button>
    </div>
    <div class="col-md-12">
            <div class="container table-responsive">
                <span class="card-title">Métodos de pago</span>
                <table id="example" class="table table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nombre</th>
                            <th>Porcentaje de recargo</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                
                    <tbody>
                        @foreach ($paymentMethods as $p)
                            <tr>
                                <td>{{$p->id}}</td>
                                <td>{{$p->name}}</td>
                                <td>{{$p->surcharge}}%</td>
                                <td><button class="btn btn-warning" data-toggle="modal" data-target="#{{ 'edit-payment-'.$p->id }}">Editar</button></td>
                            </tr>
                        @include('finances.payment_method.edit')
                        @endforeach
                    </tbody>
                </table>
               
                {{ $paymentMethods->render() }}
                
            </div>
    </div>
</div>


<form method="POST" action="{{url('payment_methods')}}">
    {{ csrf_field() }}
    <div class="modal fade" id="createPaymentMethod">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4>Crear Metodo de Pago</h4>
                    <button type="button" class="close" data-dismiss="modal">
                    <span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <label for="name">Nombre</label>
                            <input class="form-control" type="text" id="name" name="name" required>
                        </div>
                        <div class="col-md-12">
                            <label for="surcharge">Porcentaje de Recargo</label>
                            <input class="form-control" type="number" id="surcharge" name="surcharge" required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Enviar</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                </div>
            </div>
        </div>
    </div>
</form>



@endsection