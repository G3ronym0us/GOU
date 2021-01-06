<template>
      <!-- eslint-disable-next-line vue/max-attributes-per-line -->
  <div class="container">
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#createVehiculo">
      Nuevo Vehiculo
    </button>
    <br>
    <div class="row">
      <div class="col-sm-4">
        <pre>{{ $data }}</pre>
      </div>
      <div class="col-sm-8">
        <table class="table table-hover table-striped" id="example">
          <thead>
            <tr>
              <th>ID</th>
              <th>USUARIO</th>
              <th>MARCA</th>
              <th>MODELO</th>
              <th>AÑO</th>
              <th>COLOR</th>
              <th>PATENTE</th>
              <th colspan="2">&nbsp;</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="car in cars" :key="car.id">
              <td>{{ car.id }}</td>
              <td>{{ car.user }}</td>
              <td>{{ car.brand }}</td>
              <td>{{ car.model }}</td>
              <td>{{ car.car_year }}</td>
              <td>{{ car.car_color }}</td>
              <td>{{ car.car_patent }}</td>
              <td><button class="btn btn-warning" v-on:click.prevent="editCar(car)">Editar</button></td>
              <td><button class="btn btn-danger" v-on:click.prevent="deleteCar(car)">Eliminar</button></td>
            </tr>
          </tbody>
        </table>
        <nav>
          <ul class="pagination">
            <li class="page-item" v-if="pagination.current_page > 1">
              <a class="page-link" href="#" @click.prevent="changePage(pagination.current_page - 1)">
                <span>Atras</span>
              </a>
            </li>

            <li class="page-item" v-for="page in pagesNumber" :key="page" v-bind:class="[page == isActived ? 'active' : '']">
              <a class="page-link" href="#" @click.prevent="changePage(page)">
                {{ page }}
              </a>
            </li>
        
            <li class="page-item" v-if="pagination.current_page < pagination.last_page">
              <a class="page-link" href="#" @click.prevent="changePage(pagination.current_page + 1)">
                <span>Siguiente</span>
              </a>
            </li>
          </ul>
        </nav>
      </div>
  </div>
  <create-car-component @recargar="getCars()"></create-car-component> 
  
  <form method="POST" v-on:submit.prevent="updateCar">
    <div class="modal fade" id="editVehiculo">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h4>Editar Vehiculo</h4>
            <button type="button" class="close" data-dismiss="modal">
              <span>&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <label for="user_id">Usuario</label>
            <select class="form-control" name="user_id" id="user_id" v-model="fillCar.user_id"  @change="getCarModels(user_id)">
                <option v-bind:value="user.id" v-for="user in users" :key="user.id" >{{user.name}}</option>
            </select>

            <label for="brand">Marca</label>
            <select class="form-control" name="brand" id="brand" v-model="fillCar.brand_id" @change="getCarModels(fillCar.brand_id)">
                <option v-bind:value="brand.id" v-for="brand in brands" :key="brand.id">{{brand.name}}</option>
            </select>

            <label for="car_model">Modelo</label>
            <select class="form-control" name="car_model" id="car_model" v-model="fillCar.car_model">
                <option v-bind:value="car_model.id" v-for="car_model in models" :key="car_model.id">{{car_model.model_car}}</option>
            </select>

            <label for="car_year">Año</label>
            <input type="text" class="form-control" name="car_year" id="car_year" v-model="fillCar.car_year">

            <label for="car_color">Color</label>
            <input type="text" class="form-control" name="car_color" id="car_color" v-model="fillCar.car_color">
            
            <label for="car_patent">Patente</label>
            <input type="text" class="form-control" name="car_patent" id="car_patent" v-model="fillCar.car_patent">
                  </div>
                  <div class="modal-footer">
                      <input type="submit" class="btn btn-primary" value="Guardar">
                  </div>
              </div>
          </div>
      </div>
  </form>
  </div>

         
</template>

<script>
export default {
    data (){
      return{
        users: [],
        brands: [],
        models: [],
        cars: [],
        errors: [],
        fillCar:{
          'id': '',
          'user_id': '',
          'brand_id': '',
          'car_model': '',
          'car_year': '',
          'car_color': '',
          'car_patent': '',
        },
        pagination: {
          'total': 0,
          'current_page': 0,
          'per_page': 0,
          'last_page': 0,
          'from': 0,
          'to': 0
        },
        offset: 3,
      }
    },
    created: function(){
      this.getCars();
      this.getUsers();
      this.getBrands();
      
    },
    computed: {
				isActived: function() {
					return this.pagination.current_page;
				},
				withoutErrors: function() {
					this.errors = '';
				},
				pagesNumber: function() {
					if(!this.pagination.to){
						return [];
					}
		
					var from = this.pagination.current_page - this.offset; 
					if(from < 1){
						from = 1;
					}
		
					var to = from + (this.offset * 2); 
					if(to >= this.pagination.last_page){
						to = this.pagination.last_page;
					}
		
					var pagesArray = [];
					while(from <= to){
						pagesArray.push(from);
						from++;
					}
					return pagesArray;
				}
			},
    methods: {
      getCars: function(page){
        var url = 'api/getCars?page='+page;
        axios.get(url).then(response => {
          this.cars = response.data.cars.data
          this.pagination = response.data.pagination
        });
      },
      getUsers: function(){
          var url = "api/getUsers";
          axios.get(url).then(response =>{
              this.users = response.data;
          })
      },
      getBrands: function(){
          var url = "api/getBrands";
          axios.get(url).then(response =>{
              this.brands = response.data;
          })
      },
      getCarModels: function(brand_id){
          console.log(brand_id);
          var url = "api/getCarModels/"+brand_id;
          axios.get(url).then(response =>{
              this.models = response.data;
          }) 
      },
      editCar: function(car){
        this.fillCar.id   = car.id;
        this.fillCar.user_id = car.user_id;
        this.fillCar.brand_id = car.brand_id;
        this.fillCar.car_model = car.model_id;
        this.fillCar.car_year = car.car_year;
        this.fillCar.car_color = car.car_color;
        this.fillCar.car_patent = car.car_patent;
        this.getCarModels(this.fillCar.brand_id);
        $('#editVehiculo').modal('show');
      },
      deleteCar: function(car) {
        var url = 'cars/' + car.id;
        axios.delete(url).then(response => { //eliminamos
          this.getCars(); //listamos
          toastr.success('Eliminado correctamente'); //mensaje
        });
      },
    }
}
</script>


