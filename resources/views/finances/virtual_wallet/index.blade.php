
@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h2>Billetera Virtual</h2>
        </div>
        <div class="col-md-4">
            <div class="small-box bg-info">
                <div class="inner">
                    <h3>{{ $virtualWallet->sum('total_pending') }}</h3>
                    <p>Total a Pagar a Conductores</p>
                </div>
                <div class="icon">
                    <i class="ion ion-bag"></i>
                </div>
                <a href="#" class="small-box-footer">Información <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <div class="col-md-4">
            <div class="small-box bg-info">
                <div class="inner">
                    <h3>{{ $virtualWallet->sum('total_paid') }}</h3>
                    <p>Total Pagado</p>
                </div>
                <div class="icon">
                    <i class="ion ion-bag"></i>
                </div>
                <a href="#" class="small-box-footer">Información <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <div class="col-md-4">
            <div class="small-box bg-info">
                <div class="inner">
                    <h3>{{ $virtualWallet->sum('total_commission') }}</h3>
                    <p>(Ganancia) Comisión Acumulada</p>
                </div>
                <div class="icon">
                    <i class="ion ion-bag"></i>
                </div>
                <a href="#" class="small-box-footer">Información <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <div class="col-md-12 table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Conductor</th>
                        <th>Total por pagar a conductores</th>
                        <th>Total ganado en comisión (ganancia)</th>
                        <th>Total ya pagado</th>
                        <th class="text-nowrap">% Comisión</th>
                        <th class="text-nowrap">Último pago</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($virtualWallet as $vw)
                        <tr>
                            <td>{{ $vw->id }}</td>
                            <td>{{ $vw->driver->user->name }}</td>
                            <td>${{$vw->total_pending}}</td>
                            <td>${{$vw->total_commission}}</td>
                            <td>${{$vw->total_paid}}</td>
                            <td>{{isset($vw->driver->vehicle) == true ? $vw->driver->car->typeVehicle->name.': '.$vw->driver->vehicle->typeVehicle->commission.'%' : ''}}</td>
                            <td>{{$vw->last_payment == null ? 'Sin fecha' : date('d-m-Y', strtotime($vw->last_payment))}}</td>
                            <td><button class="btn btn-info">Ver</button></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection