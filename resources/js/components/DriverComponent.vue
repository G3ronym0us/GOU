<template>
  <!-- eslint-disable-next-line vue/max-attributes-per-line -->
  <div class="container">
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#createUser">
      Nueva Conductor
    </button>
    <br>
    
    <div class="row">
      <div class="col-sm-12">
        <table class="table table-hover table-striped" id="example">
          <thead>
            <tr>
              <th>ID</th>
              <th>NOMBRES</th>
              <th>APELLIDOS</th>
              <th>TELEFONO</th>
              <th>EMAIL</th>
              <th colspan="2">&nbsp;</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="driver in drivers" :key="driver.id">
              <td>{{ driver.id }}</td>
              <td>{{ driver.name }}</td>
              <td>{{ driver.lastname }}</td>
              <td>{{ driver.phone }}</td>
              <td>{{ driver.email }}</td>
              <td>
                <button class="btn btn-info" v-on:click.prevent="rediretDocumentation(driver)"><i class="nav-icon fas fa-file-alt"></i></button>
                <button class="btn btn-info" v-on:click.prevent="addCar(driver)"><i class="nav-icon fas fa-car"></i></button>
                <button class="btn btn-warning" v-on:click.prevent="editDriver(driver)"><i class="nav-icon fas fa-edit"></i></button>
              </td>
              <td><button class="btn btn-danger" v-on:click.prevent="deleteDriver(driver)"><i class="nav-icon fas fa-trash-alt"></i></button></td>
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
  <create-user-component @recargar="getDrivers()" v-bind:rol="'DRIVER'"></create-user-component> 
  <create-documentation-component v-bind:documentation="documentation" v-bind:base_url="base_url"></create-documentation-component>
  
  <form method="POST" v-on:submit.prevent="storeCar">
    <div class="modal fade" id="addCar">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 v-if="car_registered == false">Agregar Vehiculo</h4>
                    <h4 v-if="car_registered == true">Editar Vehiculo <button class="btn btn-warning" v-on:click.prevent="activeButtonEdit()"><i class="nav-icon fas fa-edit"></i></button> </h4>
                    <button type="button" class="close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <label for="n_user_id">Usuario</label>
                    <select class="form-control" name="n_user_id" id="n_user_id" v-model="driver_id" hidden>
                        <option v-bind:value="user.id" v-for="user in users" :key="user.id">{{user.name}}</option>
                    </select>
                    <select class="form-control" v-model="driver_id" disabled>
                        <option v-bind:value="user.id" v-for="user in users" :key="user.id">{{user.name}}</option>
                    </select>

                    <label for="n_brand">Marca</label>
                    <select class="car-data form-control" name="n_brand" id="n_brand" v-model="n_brand" @change="getCarModels(n_brand)" required>
                        <option value="" disabled>Seleccione una marca de autos</option>
                        <option v-bind:value="brand.id" v-for="brand in brands" :key="brand.id">{{brand.name}}</option>
                    </select>

                    <label for="n_car_model">Modelo</label>
                    <select class="car-data form-control" name="n_car_model" id="n_car_model" v-model="n_car_model" required>
                        <option value="" disabled>Seleccione un modelo</option>
                        <option v-bind:value="car_model.id" v-for="car_model in models" :key="car_model.id">{{car_model.model_car}}</option>
                    </select>

                    <label for="n_car_year">Año</label>
                    <select class="car-data form-control" name="n_car_year" id="n_car_year" v-model="n_car_year" required>
                    </select>

                    <label for="n_car_color">Color</label>
                    <input type="text" class="car-data form-control" name="n_car_color" id="n_car_color" v-model="n_car_color" required>
                    
                    <label for="n_car_patent">Patente</label>
                    <input type="text" class="car-data form-control" name="n_car_patent" id="n_car_patent" v-model="n_car_patent" required>
                </div>
                <div class="modal-footer">
                    <input type="submit" class="btn btn-primary" value="Guardar">
                </div>
            </div>
        </div>
    </div>
</form>

<!-- MODAL PARA MODIFICAR USUARIO -->

    <form method="POST" v-on:submit.prevent="updateDriver">
    <div class="modal fade" id="editDriver">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4>Editar Conductor</h4>
                    <button type="button" class="close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <label for="name_edit">Nombre</label>
                    <input type="text" class="form-control" name="name_edit" id="name_edit" v-model="driver.name">

                    <label for="lastname_edit">Apellido</label>
                    <input type="text" class="form-control" name="lastname_edit" id="lastname_edit" v-model="driver.lastname">

                    <label for="phone_edit">Telefono</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-phone"></i></span>
                        </div>
                        <input type="text" class="form-control" name="phone_edit" id="phone_edit" v-model="driver.phone" data-inputmask='"mask": "(999) 999-9999"' data-mask>
                  </div>

                    <label for="email_edit">Email</label>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                        </div>
                        <input type="email" class="form-control" name="email_edit" id="email_edit" v-model="driver.email">
                    </div>

                    <input type="checkbox" name="changePassword" id="changePassword" v-model="driver.checkPassword" value="true" @change="activeCheckPassword()"> 
                    <span>Cambiar Contraseña</span><br>

                    <div id="password_group">
                      <label for="password_edit">Contraseña</label>
                      <input type="password" class="form-control" name="password_edit" id="password_edit" v-model="driver.password" >


                      <label for="rpassword_edit">Repetir Contraseña</label>
                     <input type="password" class="form-control" name="rpassword_edit" id="rpassword_edit" v-model="driver.rpassword" >
                    </div>

                    

                    <label for="user_type_edit">Tipo de Usuario</label>
                    <select class="form-control" v-model="driver.user_type" disabled>
                        <option value="DRIVER" >Conductor</option>
                        <option value="CLIENT" >Cliente</option>
                    </select>
                    <select class="form-control" name="user_type_edit" id="user_type_edit" v-model="driver.user_type" hidden>
                        <option value="DRIVER" >Conductor</option>
                        <option value="CLIENT" >Cliente</option>
                    </select>

                    <label for="last_password">Contraseña Anterior</label>
                    <input type="password" class="form-control" name="last_password" id="last_password" v-model="driver.last_password">

                  
                </div>
                <div class="modal-footer">
                    <input type="submit" class="btn btn-primary" value="Guardar" id="btnUpdateDriver">
                </div>
            </div>
        </div>
    </div>
</form>

<!--FIN DE MODAL PARA MODIFICAR USUARIO -->

  </div>

         
</template>

<script>
export default {
    props: ['base_url'],
    data (){
      return{
        driver_id: '',
        users: [],
        drivers: [],
        brands: [],
        models: [],
        cars: [],
        documentation: [],
        errors: [],
        car_data:{
          'model_id': '',
          'car_color': '',
          'car_year': '',
          'car_patent': '',
        },
        fillDocumentation:{
          'user_id': '',
          'license': '',
          'license_img': '',
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
        driver:{
          'id': '',
          'name': '',
          'lastname': '',
          'phone': '',
          'email':'',
          'password': '',
          'rpassword': '',
          'last_password': '',
          'user_type': 'DRIVER',
          'checkPassword': '',
        },
        offset: 3,

        n_user_id: '',
        n_brand: '',
        n_car_model: '',
        n_car_year: '',
        n_car_color: '',
        n_car_patent: '',
        car_registered: '',
        car_id: ''
      }
    },
    created: function(){
      this.getDrivers();
      this.getUsers();
      this.getBrands();
      
    },
    mounted: function () {
        this.$nextTick(function () {
            this.loadYears();
            $('#password_group').hide();
            
        })
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
      getDrivers: function(page){
        var url = 'getDrivers?page='+page;
        axios.get(url).then(response => {
          this.drivers = response.data.drivers.data
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
      loadDocumentation: function(driver){
            var url = 'getDocumentation/'+driver.user_id;
            axios.get(url).then(response => {
                this.documentation = response.data;
                $('#createDocumentation').modal('show');
            });
      },
      rediretDocumentation: function(driver){
        window.location.href = this.base_url+'/documentation/'+driver.user_id;
      },
      addCar: function(driver){
        this.driver_id = driver.id;
        var url = 'checkCar/'+this.driver_id;
        axios.get(url).then(response => {
          if(response.data){
            this.car_id = response.data.id;
            this.n_car_model = response.data.model_id;
            this.n_car_year = response.data.car_year;
            this.n_car_color = response.data.car_color;
            this.n_car_patent = response.data.car_patent;
            this.getBrandFromModel(this.n_car_model);
            $('.car-data').prop('disabled',true);
            this.car_registered = true;

          }else{
              this.n_brand = '';
              this.n_car_model = '';
              this.n_car_year = '';
              this.car_color = '';
              this.n_car_patent = '';
              $('.car-data').prop('disabled',false);
              this.car_registered = false;
          }
        });

        $('#addCar').modal('show');
      },
      storeCar: function() {
        if(this.car_registered == false){
          var url = 'cars';
          axios.post(url, {
              user_id: this.driver_id,
              model_id: this.n_car_model,
              car_year: this.n_car_year,
              car_color: this.n_car_color,
              car_patent: this.n_car_patent,
          }).then(response => {
              this.n_brand = '';
              this.n_car_model = '';
              this.n_car_year = '';
              this.n_car_color = '';
              this.n_car_patent = '';
              this.errors = [];
              this.$emit('recargar');
              $('#addCar').modal('hide');
              toastr.success('Nuevo Vehiculo creado!');
          }).catch(error => {
              this.errors = 'Corrija para poder crear con exito!';
          });
        }else{
          var url = 'cars/'+this.car_id;
          axios.put(url, {
              user_id: this.driver_id,
              model_id: this.n_car_model,
              car_year: this.n_car_year,
              car_color: this.n_car_color,
              car_patent: this.n_car_patent,
          }).then(response => {
              this.n_brand = '';
              this.n_car_model = '';
              this.n_car_year = '';
              this.n_car_color = '';
              this.n_car_patent = '';
              this.errors = [];
              this.$emit('recargar');
              $('#addCar').modal('hide');
              toastr.success('Nuevo Vehiculo creado!');
          }).catch(error => {
              this.errors = 'Corrija para poder crear con exito!';
          });
        }
      },
      getUsers: function(){
            var url = "api/getUsers";
            axios.get(url).then(response =>{
                this.users = response.data;
            })
        },
      loadYears: function(){
          var today = new Date();
          var year = today.getFullYear();
          year = parseInt(year);
          this.n_car_year = year;
          $('#n_car_year').empty();
          while (year > 1950) {
              $('#n_car_year').append(new Option(year, year));
              year--;
          }
      },
      getBrandFromModel: function(id){
        var url = 'getBrandFromModel/'+id;
        axios.get(url).then(response => {
          this.n_brand = response.data.brand_id;
          this.getCarModels(this.n_brand);
        })
      },
      activeButtonEdit: function(){
        $('.car-data').prop('disabled',false);
      },
      editDriver: function(driver){
        this.driver.id = driver.id;
        this.driver.name = driver.name;
        this.driver.lastname = driver.lastname;
        this.driver.phone = driver.phone;
        this.driver.email = driver.email;
        $('#editDriver').modal('show');
      },
      updateDriver: function(){
        var url = 'checkPasswordUser';
        axios.post(url,{
          user_id: this.driver.id,
          password: this.driver.last_password
        }).then( response => {
          if(this.driver.password == this.driver.rpassword){
            if(response.data == true){
              var urlUpdate = 'driver/'+this.driver.id;
              if(this.driver.checkPassword == true){
                axios.put(urlUpdate,{
                  name: this.driver.name,
                  lastname: this.driver.lastname,
                  phone: this.driver.phone,
                  email: this.driver.email,
                  password: this.driver.password
                }).then(response => {
                  $('#editDriver').modal('hide');
                  this.driver.last_password = '';
                  this.driver.password = '';
                  this.driver.rpassword = '';
                  $('#password_edit').prop('required',false);
                  $('#rpassword_edit').prop('required',false);
                  $('#password_group').hide();
                  this.getDrivers();  
                  toastr.success('Conductor editado con exito!')
                });
              }else{
                axios.put(urlUpdate,{
                  name: this.driver.name,
                  lastname: this.driver.lastname,
                  phone: this.driver.phone,
                  email: this.driver.email,
                }).then(response => {
                  $('#editDriver').modal('hide');
                  this.driver.last_password = '';
                  this.driver.password = '';
                  this.driver.rpassword = '';
                  $('#password_edit').prop('required',false);
                  $('#rpassword_edit').prop('required',false);
                  $('#password_group').hide();
                  this.getDrivers();
                  toastr.success('Conductor editado con exito!')
                });
                
              }
              
            }else{
              toastr.error('La contraseña anterior no es <b>correcta<b>!');
              $('#last_password').focus();
            }
          }else{
            toastr.error('Las contraseñas no <b>coinciden<b>!');
            $('#password_edit').focus();
          }
        });
      },
      activeCheckPassword: function(){
        if(this.driver.checkPassword == true){
          $('#password_group').show();
          $('#password_edit').prop('required',true);
          $('#rpassword_edit').prop('required',true);
        }else{
          $('#password_edit').prop('required',false);
          $('#rpassword_edit').prop('required',false);
          $('#password_group').hide();

        }
      },
      deleteDriver: function(driver){
        var url = 'driver/' + driver.user_id;
        axios.delete(url).then(response => { //eliminamos
          this.getDrivers(); //listamos
          toastr.success('Usuario eliminado correctamente'); //mensaje
        });
      }

    }
}
</script>