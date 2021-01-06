
@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">DOCUMENTOS</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                    <!-- we are adding the accordion ID so Bootstrap's collapse plugin detects it -->
                        <div id="accordion">
                            @if($documentation->license)
                            <div class="card card-success">
                            @else
                            <div class="card card-danger">
                            @endif
                                <div class="card-header inline-block">
                                    <h4 class="card-title w-100">
                                        <a class="d-block w-100" data-toggle="collapse" href="#collapseOne">
                                        @if($documentation->license)
                                            <i class="nav-icon fas fa-check-circle"></i>
                                        @else
                                            <i class="nav-icon fas fa-exclamation-circle"></i>
                                        @endif
                                            Licencia
                                        @if($documentation->license) 
                                            @if($documentation->license_status)
                                                (Aprobada)
                                            @else
                                                (Por Aprobar)
                                            @endif
                                        @endif
                                        </a>
                                        
                                    </h4>
                                    
                                </div>
                                <div id="collapseOne" class="collapse" data-parent="#accordion">
                                    <div class="card-body">
                                    @if($documentation->license)
                                        <a class="pull-right btn btn-warning" data-toggle="modal" data-target="#editLicense">
                                            <i class="nav-icon fas fa-edit"></i>
                                            Editar
                                        </a>
                                        @if(!$documentation->license_status)
                                            <button class="btn btn-success" data-toggle="modal" data-target="#approveLicense">Aprobar</button>
                                        @endif
                                        <img src="{{ asset('img/'.$documentation->license_img) }}" class="w-100">
                                        <input type="text" class="form-control" value="{{$documentation->license}}" readonly>
                                    @else
                                        <p class="text-danger">El usuario posee licencia registrada, por favor registre una.</p>
                                        <form action="{{ url('documentation').'/'.$documentation->user_id }}" method="POST" enctype="multipart/form-data">
                                            {{ csrf_field() }}
                                            {{ method_field('PUT') }}
                                            <input name="_method" type="hidden" value="PATCH">
                                            <label for="license">Ingrese el numero de licencia</label>
                                            <input type="text" class="form-control" name="license" id="license">
                                            <label for="license_img">Cargue la imagen de la licencia</label>
                                            <input type="file" name="license_img" id="license_img"><br><br>
                                            <button type="submit" class="btn btn-success">Enviar</button>
                                        </form>
                                    @endif
                                    </div>
                                </div>
                            </div>
                            @if($documentation->carlicense)
                            <div class="card card-success">
                            @else
                            <div class="card card-danger">
                            @endif
                                <div class="card-header">
                                    <h4 class="card-title w-100">
                                        <a class="d-block w-100" data-toggle="collapse" href="#collapseTwo">
                                        @if($documentation->carlicense)
                                        <i class="nav-icon fas fa-check-circle"></i>
                                        @else
                                            <i class="nav-icon fas fa-exclamation-circle"></i>
                                        @endif
                                            Carnet de Circulacion de Vehiculo
                                            @if($documentation->carlicense)
                                                @if($documentation->carlicense_status)
                                                    (Aprobada)
                                                @else
                                                    (Por Aprobar)
                                                @endif
                                            @endif
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapseTwo" class="collapse" data-parent="#accordion">
                                    <div class="card-body">
                                    @if($documentation->carlicense)
                                    <a class="pull-right btn btn-warning" data-toggle="modal" data-target="#editCarLicense">
                                        <i class="nav-icon fas fa-edit"></i>
                                        Editar
                                    </a>
                                    @if(!$documentation->carlicense_status)
                                            <button class="btn btn-success" data-toggle="modal" data-target="#approveCarLicense">Aprobar</button>
                                    @endif
                                    <img src="{{ asset('img/carlicense/'.$documentation->carlicense_img) }}" class="w-100">
                                    <input type="text" class="form-control" value="{{$documentation->carlicense}}" readonly>
                                    @else
                                        <p class="text-danger">El usuario no posee carnet de circulacion de vehiculo registrado, por favor registre uno.</p>
                                        <form action="{{ url('documentation').'/'.$documentation->user_id }}" method="POST" enctype="multipart/form-data">
                                            {{ csrf_field() }}
                                            {{ method_field('PUT') }}
                                            <label for="carlicense">Ingrese el numero de carnet de circulación/label>
                                            <input type="text" class="form-control" name="carlicense" id="carlicense" required>
                                            <label for="carlicense_img">Cargue la imagen del carnet de circulación</label>
                                            <input type="file" name="carlicense_img" id="carlicense_img" required><br><br>
                                            <button type="submit" class="btn btn-success">Enviar</button>
                                        </form>
                                    @endif
                                    </div>
                                </div>
                            </div>
                            @if($documentation->insuranse)
                            <div class="card card-success">
                            @else
                            <div class="card card-danger">
                            @endif
                                <div class="card-header">
                                    <h4 class="card-title w-100">
                                        <a class="d-block w-100" data-toggle="collapse" href="#collapseThree">
                                        @if($documentation->insuranse)
                                            <i class="nav-icon fas fa-check-circle"></i>
                                        @else
                                            <i class="nav-icon fas fa-exclamation-circle"></i>
                                        @endif
                                            Seguro
                                        @if($documentation->insurance) 
                                            @if($documentation->insurance_status)
                                                (Aprobada)
                                            @else
                                                (Por Aprobar)
                                            @endif
                                        @endif
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapseThree" class="collapse" data-parent="#accordion">
                                    <div class="card-body">
                                    @if($documentation->insuranse)
                                        <a class="pull-right btn btn-warning" data-toggle="modal" data-target="#editInsuranse">
                                            <i class="nav-icon fas fa-edit"></i>
                                            Editar
                                        </a>
                                        @if(!$documentation->insurance_status)
                                            <button class="btn btn-success" data-toggle="modal" data-target="#approveInsurance">Aprobar</button>
                                        @endif
                                        <img src="{{ asset('img/insuranse/'.$documentation->insuranse_img) }}" class="w-100">
                                        <input type="text" class="form-control" value="{{$documentation->insuranse}}" readonly>
                                    @else
                                        <p class="text-danger">El usuario no posee seguro registrado, por favor registre uno.</p>
                                        <form action="{{ url('documentation').'/'.$documentation->user_id }}" method="POST" enctype="multipart/form-data">
                                            {{ csrf_field() }}
                                            {{ method_field('PUT') }}
                                            <input name="_method" type="hidden" value="PATCH">
                                            <label for="insuranse">Ingrese el numero de seguro</label>
                                            <input type="text" class="form-control" name="insuranse" id="insuranse" required>
                                            <label for="insuranse_img">Cargue la imagen del seguro</label>
                                            <input type="file" name="insuranse_img" id="insuranse_img" required><br><br>
                                            <button type="submit" class="btn btn-success">Enviar</button>
                                        </form>
                                    @endif
                                    </div>
                                </div>
                            </div>
                            @if($documentation->vtv)
                            <div class="card card-success">
                            @else
                            <div class="card card-danger">
                            @endif
                                <div class="card-header">
                                    <h4 class="card-title w-100">
                                        <a class="d-block w-100" data-toggle="collapse" href="#collapseFour">
                                        @if($documentation->vtv)
                                            <i class="nav-icon fas fa-check-circle"></i>
                                        @else
                                            <i class="nav-icon fas fa-exclamation-circle"></i>
                                        @endif
                                            VTV
                                            @if($documentation->vtv) 
                                                @if($documentation->vtv_status)
                                                    (Aprobada)
                                                @else
                                                    (Por Aprobar)
                                                @endif
                                            @endif
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapseFour" class="collapse" data-parent="#accordion">
                                    <div class="card-body">
                                    @if($documentation->vtv)
                                        <a class="pull-right btn btn-warning" data-toggle="modal" data-target="#editVTV">
                                            <i class="nav-icon fas fa-edit"></i>
                                            Editar
                                            @if(!$documentation->vtv_status)
                                                <button class="btn btn-success" data-toggle="modal" data-target="#approveVTV">Aprobar</button>
                                            @endif
                                        </a>
                                        <img src="{{ asset('img/vtv/'.$documentation->vtv_img) }}" class="w-100">
                                        <input type="text" class="form-control" value="{{$documentation->vtv}}" readonly>
                                    @else
                                        <p class="text-danger">El usuario no posee VTV registrado, por favor registre uno.</p>
                                        <form action="{{ url('documentation').'/'.$documentation->user_id }}" method="POST" enctype="multipart/form-data">
                                            {{ csrf_field() }}
                                            {{ method_field('PUT') }}
                                            <input name="_method" type="hidden" value="PATCH">
                                            <label for="vtv">Ingrese el numero del VTV</label>
                                            <input type="text" class="form-control" name="vtv" id="vtv" required>
                                            <label for="vtv_img">Cargue la imagen del VTV</label>
                                            <input type="file" name="vtv_img" id="vtv_img" required><br><br>
                                            <button type="submit" class="btn btn-success">Enviar</button>
                                        </form>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">IMAGENES DEL VEHICULO</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                    <!-- we are adding the accordion ID so Bootstrap's collapse plugin detects it -->
                        <div id="accordion">
                            @if($documentation->front_img)
                            <div class="card card-success">
                            @else
                            <div class="card card-danger">
                            @endif
                                <div class="card-header">
                                    <h4 class="card-title w-100">
                                        <a class="d-block w-100" data-toggle="collapse" href="#collapseFive">
                                        @if($documentation->front_img)
                                            <i class="nav-icon fas fa-check-circle"></i>
                                        @else
                                            <i class="nav-icon fas fa-exclamation-circle"></i>
                                        @endif
                                            Frontal
                                            @if($documentation->front_img) 
                                                @if($documentation->front_status)
                                                    (Aprobada)
                                                @else
                                                    (Por Aprobar)
                                                @endif
                                            @endif
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapseFive" class="collapse" data-parent="#accordion">
                                    <div class="card-body">
                                    @if($documentation->front_img)
                                        <a class="pull-right btn btn-warning" data-toggle="modal" data-target="#editFront">
                                            <i class="nav-icon fas fa-edit"></i>
                                            Editar
                                        </a>
                                        @if(!$documentation->front_status)
                                            <button class="btn btn-success" data-toggle="modal" data-target="#approveFront">Aprobar</button>
                                        @endif
                                        <img src="{{ asset('img/front_car/'.$documentation->front_img) }}" class="w-100">
                                    @else
                                        <p class="text-danger">El usuario no ha registrado foto frontal del vehiculo.</p>
                                        <form action="{{ url('documentation').'/'.$documentation->user_id }}" method="POST" enctype="multipart/form-data">
                                            {{ csrf_field() }}
                                            {{ method_field('PUT') }}
                                            <input name="_method" type="hidden" value="PATCH">
                                            <label for="front_img">Cargue la foto</label>
                                            <input type="file" name="front_img" id="front_img"><br><br>
                                            <button type="submit" class="btn btn-success">Enviar</button>
                                        </form>
                                    @endif
                                    </div>
                                </div>
                            </div>
                            @if($documentation->back_img)
                            <div class="card card-success">
                            @else
                            <div class="card card-danger">
                            @endif
                                <div class="card-header">
                                    <h4 class="card-title w-100">
                                        <a class="d-block w-100" data-toggle="collapse" href="#collapseSix">
                                        @if($documentation->back_img)
                                            <i class="nav-icon fas fa-check-circle"></i>
                                        @else
                                            <i class="nav-icon fas fa-exclamation-circle"></i>
                                        @endif
                                            Trasera
                                            @if($documentation->back_img) 
                                                @if($documentation->back_status)
                                                    (Aprobada)
                                                @else
                                                    (Por Aprobar)
                                                @endif
                                            @endif
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapseSix" class="collapse" data-parent="#accordion">
                                    <div class="card-body">
                                    @if($documentation->back_img)
                                        <a class="pull-right btn btn-warning" data-toggle="modal" data-target="#editBack">
                                            <i class="nav-icon fas fa-edit"></i>
                                            Editar
                                        </a>
                                        @if(!$documentation->back_status)
                                            <button class="btn btn-success" data-toggle="modal" data-target="#approveBack">Aprobar</button>
                                        @endif
                                        <img src="{{ asset('img/back_car/'.$documentation->back_img) }}" class="w-100">
                                    @else
                                        <p class="text-danger">El usuario no ha registrado una foto trasera del vehiculo.</p>
                                        <form action="{{ url('documentation').'/'.$documentation->user_id }}" method="POST" enctype="multipart/form-data">
                                            {{ csrf_field() }}
                                            {{ method_field('PUT') }}

                                            <label for="back_img">Cargue la foto</label>
                                            <input type="file" name="back_img" id="back_img"><br><br>
                                            <button type="submit" class="btn btn-success">Enviar</button>
                                        </form>
                                    @endif
                                    </div>
                                </div>
                            </div>
                            @if($documentation->right_img)
                            <div class="card card-success">
                            @else
                            <div class="card card-danger">
                            @endif
                                <div class="card-header">
                                    <h4 class="card-title w-100">
                                        <a class="d-block w-100" data-toggle="collapse" href="#collapseSeven">
                                        @if($documentation->right_img)
                                            <i class="nav-icon fas fa-check-circle"></i>
                                        @else
                                            <i class="nav-icon fas fa-exclamation-circle"></i>
                                        @endif
                                            Derecha
                                            @if($documentation->right_img) 
                                                @if($documentation->right_status)
                                                    (Aprobada)
                                                @else
                                                    (Por Aprobar)
                                                @endif
                                            @endif
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapseSeven" class="collapse" data-parent="#accordion">
                                    <div class="card-body">
                                    @if($documentation->right_img)
                                        <a class="pull-right btn btn-warning" data-toggle="modal" data-target="#editRight">
                                            <i class="nav-icon fas fa-edit"></i>
                                            Editar
                                        </a>
                                        @if(!$documentation->right_status)
                                            <button class="btn btn-success" data-toggle="modal" data-target="#approveRight">Aprobar</button>
                                        @endif
                                        <img src="{{ asset('img/right_car/'.$documentation->right_img) }}" class="w-100">
                                    @else
                                        <p class="text-danger">El usuario no ha registrado una foto del lado derecho del vehiculo.</p>
                                        <form action="{{ url('documentation').'/'.$documentation->user_id }}" method="POST" enctype="multipart/form-data">
                                            {{ csrf_field() }}
                                            {{ method_field('PUT') }}
                                            <input name="_method" type="hidden" value="PATCH">

                                            <label for="right_img">Cargue la foto.</label>
                                            <input type="file" name="right_img" id="right_img"><br><br>
                                            <button type="submit" class="btn btn-success">Enviar</button>
                                        </form>
                                    @endif
                                    </div>
                                </div>
                            </div>
                            @if($documentation->left_img)
                            <div class="card card-success">
                            @else
                            <div class="card card-danger">
                            @endif
                                <div class="card-header">
                                    <h4 class="card-title w-100">
                                        <a class="d-block w-100" data-toggle="collapse" href="#collapseEight">
                                        @if($documentation->left_img)
                                            <i class="nav-icon fas fa-check-circle"></i>
                                        @else
                                            <i class="nav-icon fas fa-exclamation-circle"></i>
                                        @endif
                                            Izquierda
                                            @if($documentation->left_img) 
                                                @if($documentation->left_status)
                                                    (Aprobada)
                                                @else
                                                    (Por Aprobar)
                                                @endif
                                            @endif
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapseEight" class="collapse" data-parent="#accordion">
                                    <div class="card-body">
                                    @if($documentation->left_img)
                                        <a class="pull-right btn btn-warning" data-toggle="modal" data-target="#editLeft">
                                            <i class="nav-icon fas fa-edit"></i>
                                            Editar
                                        </a>
                                        @if(!$documentation->left_status)
                                            <button class="btn btn-success" data-toggle="modal" data-target="#approveLeft">Aprobar</button>
                                        @endif
                                        <img src="{{ asset('img/left_car/'.$documentation->left_img) }}" class="w-100">
                                    @else
                                        <p class="text-danger">El usuario no ha registrado foto del lado izquierdo del vehiculo.</p>
                                        <form action="{{ url('documentation').'/'.$documentation->user_id }}" method="POST" enctype="multipart/form-data">
                                            {{ csrf_field() }}
                                            {{ method_field('PUT') }}
                                            <input name="_method" type="hidden" value="PATCH">

                                            <label for="left_img">Cargue la imagen de la licencia</label>
                                            <input type="file" name="left_img" id="left_img"><br><br>
                                            <button type="submit" class="btn btn-success">Enviar</button>
                                        </form>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
            
        </div>
        <!-- /.row -->       
    </div>
    <!-- END ACCORDION & CAROUSEL-->    



    <!-- EDIT LICENSE-->    
    <div class="modal fade" id="editLicense">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4>Editar Licencia</h4>
                    <button type="button" class="close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ url('documentation').'/'.$documentation->user_id }}" method="POST" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        {{ method_field('PUT') }}
                        <input name="_method" type="hidden" value="PATCH">
                        <label for="license">Ingrese el numero de licencia</label>
                        <input type="text" class="form-control" name="license" id="license">
                        <label for="license_img">Cargue la imagen de la licencia</label>
                        <input type="file" name="license_img" id="license_img"><br><br>
                        <button type="submit" class="btn btn-success">Enviar</button>
                    </form>
                </div>
                <div class="modal-footer">
                    <input type="submit" class="btn btn-primary" value="Guardar">
                </div>
            </div>
        </div>
    </div>
    <!-- END EDIT LICENSE-->

    <!-- EDIT CARLICENSE-->    
    <div class="modal fade" id="editCarlicense">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4>Editar Carnet de Circulacion del Vehiculo</h4>
                    <button type="button" class="close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ url('documentation').'/'.$documentation->user_id }}" method="POST" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        {{ method_field('PUT') }}
                        <label for="carlicense">Ingrese el numero de carnet de circulación/label>
                        <input type="text" class="form-control" name="carlicense" id="carlicense">
                        <label for="carlicense_img">Cargue la imagen del carnet de circulación</label>
                        <input type="file" name="carlicense_img" id="carlicense_img"><br><br>
                        <button type="submit" class="btn btn-success">Enviar</button>
                    </form>
                </div>
                <div class="modal-footer">
                    <input type="submit" class="btn btn-primary" value="Guardar">
                </div>
            </div>
        </div>
    </div>
    <!-- END EDIT CARLICENSE-->

    <!-- EDIT INSURANSE -->    
    <div class="modal fade" id="editInsurance">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4>Editar Seguro</h4>
                    <button type="button" class="close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ url('documentation').'/'.$documentation->user_id }}" method="POST" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        {{ method_field('PUT') }}
                        <input name="_method" type="hidden" value="PATCH">
                        <label for="insuranse">Ingrese el numero de seguro</label>
                        <input type="text" class="form-control" name="insuranse" id="insuranse">
                        <label for="insuranse_img">Cargue la imagen del seguro</label>
                        <input type="file" name="insuranse_img" id="insuranse_img"><br><br>
                        <button type="submit" class="btn btn-success">Enviar</button>
                    </form>
                </div>
                <div class="modal-footer">
                    <input type="submit" class="btn btn-primary" value="Guardar">
                </div>
            </div>
        </div>
    </div>
    <!-- END EDIT INSURANSE-->

    <!-- EDIT VTV-->    
    <div class="modal fade" id="editVTV">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4>Editar Licencia</h4>
                    <button type="button" class="close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ url('documentation').'/'.$documentation->user_id }}" method="POST" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        {{ method_field('PUT') }}
                        <input name="_method" type="hidden" value="PATCH">
                        <label for="vtv">Ingrese el numero del VTV</label>
                        <input type="text" class="form-control" name="vtv" id="vtv">
                        <label for="vtv_img">Cargue la imagen del VTV</label>
                        <input type="file" name="vtv_img" id="vtv_img"><br><br>
                        <button type="submit" class="btn btn-success">Enviar</button>
                    </form>
                </div>
                <div class="modal-footer">
                    <input type="submit" class="btn btn-primary" value="Guardar">
                </div>
            </div>
        </div>
    </div>
    <!-- END EDIT VTV-->

    <!-- EDIT FRONT CAR-->    
    <div class="modal fade" id="editFront">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4>Editar Foto Frontal del Vehiculo</h4>
                    <button type="button" class="close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ url('documentation').'/'.$documentation->user_id }}" method="POST" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        {{ method_field('PUT') }}
                        <input name="_method" type="hidden" value="PATCH">
                        <label for="front_img">Cargue la foto</label>
                        <input type="file" name="front_img" id="front_img"><br><br>
                        <button type="submit" class="btn btn-success">Enviar</button>
                    </form>
                </div>
                <div class="modal-footer">
                    <input type="submit" class="btn btn-primary" value="Guardar">
                </div>
            </div>
        </div>
    </div>
    <!-- END EDIT FRONT CAR-->

    <!-- EDIT BACK CAR-->    
    <div class="modal fade" id="editBack">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4>Editar Foto trasera del vehiculo</h4>
                    <button type="button" class="close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ url('documentation').'/'.$documentation->user_id }}" method="POST" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        {{ method_field('PUT') }}

                        <label for="back_img">Cargue la foto</label>
                        <input type="file" name="back_img" id="back_img"><br><br>
                        <button type="submit" class="btn btn-success">Enviar</button>
                    </form>
                </div>
                <div class="modal-footer">
                    <input type="submit" class="btn btn-primary" value="Guardar">
                </div>
            </div>
        </div>
    </div>
    <!-- END EDIT BACK CAR-->

    <!-- EDIT RIGHT CAR-->    
    <div class="modal fade" id="editRight">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4>Editar foto derecha del vehiculo</h4>
                    <button type="button" class="close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ url('documentation').'/'.$documentation->user_id }}" method="POST" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        {{ method_field('PUT') }}
                        <input name="_method" type="hidden" value="PATCH">

                        <label for="right_img">Cargue la foto.</label>
                        <input type="file" name="right_img" id="right_img"><br><br>
                        <button type="submit" class="btn btn-success">Enviar</button>
                    </form>
                </div>
                <div class="modal-footer">
                    <input type="submit" class="btn btn-primary" value="Guardar">
                </div>
            </div>
        </div>
    </div>
    <!-- END EDIT RIGHT CAR-->

    <!-- EDIT LEFT CAR-->    
    <div class="modal fade" id="editLeft">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4>Editar foto izquierda del vehiculo</h4>
                    <button type="button" class="close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ url('documentation').'/'.$documentation->user_id }}" method="POST" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        {{ method_field('PUT') }}
                        <input name="_method" type="hidden" value="PATCH">

                        <label for="left_img">Cargue la imagen de la licencia</label>
                        <input type="file" name="left_img" id="left_img"><br><br>
                        <button type="submit" class="btn btn-success">Enviar</button>
                    </form>
                </div>
                <div class="modal-footer">
                    <input type="submit" class="btn btn-primary" value="Guardar">
                </div>
            </div>
        </div>
    </div>
    <!-- END EDIT LEFT CAR-->

    <!-- APROVE  LICENSE-->

    <div class="modal fade" id="approveLicense">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4>Aprovar Licencia</h4>
                    <button type="button" class="close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>
                <form action="{{ url('approveDocumentation').'/'.$documentation->id }}" method="POST" enctype="multipart/form-data">
                    <div class="modal-body">
                            {{ csrf_field() }}
                            <input type="text" id="document" name="document" value="license" hidden>
                            <input type="text" id="user_id" name="user_id" value="{{$documentation->user_id}}" hidden>
                            Esta seguro que desea aprobar la licencia {{ $documentation->license}}?
                    </div>
                    <div class="modal-footer">
                        <input type="submit" class="btn btn-primary" value="Guardar">
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- fIN DE APPROVE lICENSE-->

    <!-- APROVE  CARLICENSE-->

    <div class="modal fade" id="approveCarLicense">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4>Aprovar Licencia Vehicular</h4>
                    <button type="button" class="close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>
                <form action="{{ url('approveDocumentation').'/'.$documentation->id }}" method="POST" enctype="multipart/form-data">
                    <div class="modal-body">
                            {{ csrf_field() }}
                            <input type="text" id="document" name="document" value="carlicense" hidden>
                            <input type="text" id="user_id" name="user_id" value="{{$documentation->user_id}}" hidden>
                            Esta seguro que desea aprobar la licencia vehicular {{ $documentation->carlicense}}?
                    </div>
                    <div class="modal-footer">
                        <input type="submit" class="btn btn-primary" value="Guardar">
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- FIN DE APPROVE CARLICENSE-->

    <!-- APROVE  INSURANCE-->

    <div class="modal fade" id="approveInsurance">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4>Aprovar Seguro</h4>
                    <button type="button" class="close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>
                <form action="{{ url('approveDocumentation').'/'.$documentation->id }}" method="POST" enctype="multipart/form-data">
                    <div class="modal-body">
                            {{ csrf_field() }}
                            <input type="text" id="document" name="document" value="insurance" hidden>
                            <input type="text" id="user_id" name="user_id" value="{{$documentation->user_id}}" hidden>
                            Esta seguro que desea aprobar el seguro {{ $documentation->insurance}}?
                    </div>
                    <div class="modal-footer">
                        <input type="submit" class="btn btn-primary" value="Guardar">
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- fIN DE APPROVE INSURANCE -->

    <!-- APROVE  VTV-->

    <div class="modal fade" id="approveVTV">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4>Aprovar VTV</h4>
                    <button type="button" class="close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>
                <form action="{{ url('approveDocumentation').'/'.$documentation->id }}" method="POST" enctype="multipart/form-data">
                    <div class="modal-body">
                            {{ csrf_field() }}
                            <input type="text" id="document" name="document" value="vtv" hidden>
                            <input type="text" id="user_id" name="user_id" value="{{$documentation->user_id}}" hidden>
                            Esta seguro que desea aprobar el vtv {{ $documentation->vtv}}?
                    </div>
                    <div class="modal-footer">
                        <input type="submit" class="btn btn-primary" value="Guardar">
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- fIN DE APPROVE VTV-->

    <!-- APROVE FRONT-->

    <div class="modal fade" id="approveFront">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4>Aprovar Imagen Frontal del Vehiculo</h4>
                    <button type="button" class="close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>
                <form action="{{ url('approveDocumentation').'/'.$documentation->id }}" method="POST" enctype="multipart/form-data">
                    <div class="modal-body">
                            {{ csrf_field() }}
                            <input type="text" id="document" name="document" value="front_img" hidden>
                            <input type="text" id="user_id" name="user_id" value="{{$documentation->user_id}}" hidden>
                            Esta seguro que desea aprobar la imagen frontal del vehiculo?
                    </div>
                    <div class="modal-footer">
                        <input type="submit" class="btn btn-primary" value="Guardar">
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- FIN DE APPROVE FRONT-->

    <!-- APROVE BACK-->

    <div class="modal fade" id="approveBack">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4>Aprovar Imagen Trasera del Vehiculo</h4>
                    <button type="button" class="close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>
                <form action="{{ url('approveDocumentation').'/'.$documentation->id }}" method="POST" enctype="multipart/form-data">
                    <div class="modal-body">
                            {{ csrf_field() }}
                            <input type="text" id="document" name="document" value="back_img" hidden>
                            <input type="text" id="user_id" name="user_id" value="{{$documentation->user_id}}" hidden>
                            Esta seguro que desea aprobar la imagen trasera del vehiculo?
                    </div>
                    <div class="modal-footer">
                        <input type="submit" class="btn btn-primary" value="Guardar">
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- FIN DE APPROVE BACK-->

    <!-- APPROVE RIGHT-->

    <div class="modal fade" id="approveRight">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4>Aprovar Imagen Derecha del Vehiculo</h4>
                    <button type="button" class="close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>
                <form action="{{ url('approveDocumentation').'/'.$documentation->id }}" method="POST" enctype="multipart/form-data">
                    <div class="modal-body">
                            {{ csrf_field() }}
                            <input type="text" id="document" name="document" value="right_img" hidden>
                            <input type="text" id="user_id" name="user_id" value="{{$documentation->user_id}}" hidden>
                            Esta seguro que desea aprobar la imagen derecha del vehiculo?
                    </div>
                    <div class="modal-footer">
                        <input type="submit" class="btn btn-primary" value="Guardar">
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- FIN DE APPROVE RIGHT-->

    <!-- APROVE LEFT-->

    <div class="modal fade" id="approveLeft">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4>Aprovar Imagen Izquierda del Vehiculo</h4>
                    <button type="button" class="close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>
                <form action="{{ url('approveDocumentation').'/'.$documentation->id }}" method="POST" enctype="multipart/form-data">
                    <div class="modal-body">
                            {{ csrf_field() }}
                            <input type="text" id="document" name="document" value="left_img" hidden>
                            <input type="text" id="user_id" name="user_id" value="{{$documentation->user_id}}" hidden>
                            Esta seguro que desea aprobar la imagen izquierda del vehiculo?
                    </div>
                    <div class="modal-footer">
                        <input type="submit" class="btn btn-primary" value="Guardar">
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- FIN DE APPROVE LEFT-->

@endsection