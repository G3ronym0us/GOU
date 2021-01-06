<template>
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <main class="contentScrollBar" style="margin-top:-25px">
          <div class="row">
            <span class="card-title col-lg-12">
              Simulador de tarifas
            </span>
            <div class="col-lg-3">
              <!-- small box -->
              <div class="small-box bg-info">
                <div class="inner">
                  <h3>{{ setting_price.base_price }}</h3>
                  <p>Precio Base</p>
                </div>
                <div class="icon">
                  <i class="ion ion-bag"></i>
                </div>
                <a href="#" class="small-box-footer">Información <i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>
            <div class="col-lg-3">
              <!-- small box -->
              <div class="small-box bg-info">
                <div class="inner">
                    <h3>{{ setting_price.limit_km }}</h3>
                    <p>Minimo de Distancia</p>
                </div>
                <div class="icon">
                    <i class="ion ion-bag"></i>
                </div>
                <a href="#" class="small-box-footer">Información <i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>
            <div class="col-lg-3">
              <!-- small box -->
              <div class="small-box bg-info">
                <div class="inner">
                  <h3>{{ setting_price.price_km }}</h3>
                  <p>Valor por KM</p>
                </div>
                <div class="icon">
                  <i class="ion ion-bag"></i>
                </div>
                <a href="#" class="small-box-footer">Información <i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>
            <div class="col-lg-3">
              <!-- small box -->
              <div class="small-box bg-info">
                <div class="inner">
                  <h3>{{ setting_price.price_min }}</h3>
                  <p>Valor por minuto adicional</p>
                </div>
                <div class="icon">
                  <i class="ion ion-bag"></i>
                </div>
                <a href="#" class="small-box-footer">Información <i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12 table-responsive">
              <table id="example" class="table table-striped">
                <thead>
                  <tr>
                    <th>Dia</th>
                    <th>Hora de inicio</th>
                    <th>Hora de finalizacion</th>
                    <th>Factor de multiplicación</th>
                    <th>Precio Final</th>
                  </tr>
                </thead>

                <tbody>

                      <tr v-for="price in prices" :key="price.id">
                        <td>{{ price.day }}</td>
                        <td>{{ price.start }}</td>
                        <td>{{ price.stop }}</td>
                        <td>{{ price.value_multi }}</td>
                        <td></td>
                      </tr>

                </tbody>
              </table>
            </div>
          </div>
          <div class="row">
            <div class="col-lg-8 offset-4">
              <a class="btn btn-warning" v-on:click.prevent="editSettingPrice()"><i class="fas fa-edit"></i>Actualizar Tarifa base</a>
              <a class="btn btn-info" v-on:click.prevent="addPrice()"><i class="fas fa-plus-square"></i>Agregar tarifa horaria</a>
            </div>
          </div>
        </main>
      </div>

    </div>

    <!-- Modal Structure -->
    <form method="POST"  v-on:submit.prevent="updateSettingPrice">
      <div class="modal fade" id="edit_setting_price">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4>Actualizar Tarifa</h4>
              <button type="button" class="close" data-dismiss="modal">
                <span>&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <div class="row">
                <div class="col-lg-12 form-group">
                  <label for="price_base">Precio base</label>
                  <input name="price_base" id="price_base" step="any" value="" type="number" class="form-control" v-model="fillSettingPrice.base_price">
                </div>
                <div class="col-lg-12 form-group">
                  <label for="limit_km1">Minimo de distancia (En Kilometros)</label>
                  <input name="limit_km" id="limit_km1" step="any" value="" type="number" class="form-control" v-model="fillSettingPrice.limit_km">
                </div>
                <div class="col-lg-12 form-group">                  
                  <label for="price_km">Valor por KM</label>
                  <input name="price_pkm" id="price_km" step="any" value="" type="number" class="form-control" v-model="fillSettingPrice.price_km">
                </div>
                <div class="col-lg-12 form-group">
                  <label for="price_min">Valor por minuto adicional</label>
                  <input name="price_pmin" id="price_min" step="any" value="" type="number" class="form-control" v-model="fillSettingPrice.price_min">
                </div>

              </div>
            </div>
            <div class="modal-footer">
              <button type="submit" class="btn btn-success">Guardar</button>
            </div>
          </div>
        </div>
      </div>
    </form>

    <form method="POST" v-on:submit.prevent="storePrice">
      <div class="modal fade" id="addPrice">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4>Crear Tarifa</h4>
              <button type="button" class="close" data-dismiss="modal">
                <span>&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <div class="row">
                <div class="col-lg-12">
                  <label>Selecciona un dia</label>
                  <select name="day" class="form-control" v-model="fillPrice.day" required>
                    <option value="" disabled selected>Selecciona un dia</option>
                    <option value="Lunes">Lunes</option>
                    <option value="Martes">Martes</option>
                    <option value="Miercoles">Miercoles</option>
                    <option value="Jueves">Jueves</option>
                    <option value="Viernes">Viernes</option>
                    <option value="Sabado">Sabado</option>
                    <option value="Domingo">Domingo</option>
                  </select>
                </div>
                <div class="col-lg-12">
                  <label for="start_time">Hora de inicio</label>
                  <input type="time" class="form-control timepicker" required id="start_time" name="start_time" v-model="fillPrice.start">
                </div>
                <div class="col-lg-12">
                  <label for="end_time">Hora de finalización</label>
                  <input type="time" class="form-control timepicker" required id="end_time" name="end_time" v-model="fillPrice.stop">
                </div>
                <div class="col-lg-12">
                  <label for="value_multi">Factor de multiplicación</label>
                  <input class="form-control" placeholder=""  name="value_multi" id="value_multi" type="number" step="any" v-model="fillPrice.value_multi" required>
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <button type="submit" class="btn btn-success">Guardar</button>
            </div>
          </div>
        </div>
      </div>
    </form>
  </div>
</template>

<script>
export default {
    data(){
        return {
            fillSettingPrice: {
              base_price: '',
              price_km: '',
              price_min: '',
              limit_km: '',
            },
            fillPrice:{
              day: '',
              start: '',
              stop: '',
              value_multi: '',
            },
            setting_price: [],
            prices: [],
        }
    },
    created(){
        this.getSettingPrice();
        this.getPrices();
    },  
    methods:{
        getSettingPrice: function(){
            var url = 'getSettingPrice';
            axios.get(url).then(response => {
                this.setting_price = response.data
            });
        },
        getPrices: function(){
          var url = 'getPrice';
            axios.get(url).then(response => {
                this.prices = response.data
            });
        },
        editSettingPrice: function(){
          this.fillSettingPrice.base_price = this.setting_price.base_price;
          this.fillSettingPrice.limit_km = this.setting_price.limit_km;
          this.fillSettingPrice.price_km = this.setting_price.price_km;
          this.fillSettingPrice.price_min = this.setting_price.price_min;
          $('#edit_setting_price').modal('show');
        },
        updateSettingPrice: function(){
          var url = 'setting_price/'+this.setting_price.id;
            axios.put(url, {
                base_price: this.fillSettingPrice.base_price,
                price_km: this.fillSettingPrice.price_km,
                price_min: this.fillSettingPrice.price_min,
                limit_km: this.fillSettingPrice.limit_km,
            }).then(response => {
                this.getSettingPrice();
                this.fillSettingPrice.base_price = '';
                this.fillSettingPrice.price_km = '';
                this.fillSettingPrice.price_min = '';
                this.fillSettingPrice.limit_km = '';
                this.errors = [];
                $('#edit_setting_price').modal('hide');
                toastr.success('Modelo editado!');
            }).catch(error => {
                this.errors = 'Corrija para poder crear con exito!';
            });
        },
        addPrice: function(){
          $('#addPrice').modal('show');
        },
        storePrice: function(){
          var url = 'price';
            axios.post(url, {
                day: this.fillPrice.day,
                start: this.fillPrice.start,
                stop: this.fillPrice.stop,
                value_multi: this.fillPrice.value_multi,
            }).then(response => {
                this.getSettingPrice();
                this.fillPrice.day = '';
                this.fillPrice.start = '';
                this.fillPrice.stop = '';
                this.fillPrice.value_multi = '';
                this.errors = [];
                $('#addPrice').modal('hide');
                this.getPrices();
                toastr.success('Precio agregado!');
            }).catch(error => {
                this.errors = 'Corrija para poder crear con exito!';
            });
        },
    }
}
</script>