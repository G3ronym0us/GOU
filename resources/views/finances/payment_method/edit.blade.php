
<form method="POST" action="{{url('payment_methods').'/'.$p->id}}">
    {{ csrf_field() }}
    {{ method_field('PUT') }}
    <div class="modal fade" id="{{ 'edit-payment-'.$p->id }}">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4>Editar Metodo de Pago #{{ $p->id }}</h4>
                    <button type="button" class="close" data-dismiss="modal">
                    <span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <label for="name">Nombre</label>
                            <input class="form-control" type="text" id="name" name="name" value="{{ $p->name }}" required>
                        </div>
                        <div class="col-md-12">
                            <label for="surcharge">Porcentaje de Recargo</label>
                            <input class="form-control" type="number" id="surcharge" name="surcharge" value="{{ $p->surcharge }}" required>
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