<template>
    <div class="container">

        <div class="float-right">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#createModelo">
                <i class="nav-icon fas fa-plus-circle"></i>&nbsp;Agregar Modelo
            </button>
        </div>

        <br><br><br>
        <div class="row">
            <div class="col-lg-8 col-md-10 col-sm-12 col-xs-12 offset-md-1 offset-lg-2 table-responsive">
                <table class="table table-hover table-striped" id="example">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>MARCA</th>
                            <th>MODELO</th>
                            <th colspan="2">&nbsp;</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="m_car in lists_models" :key="m_car.id">
                            <td>{{ m_car.id }}</td>
                            <td>{{ m_car.brand }}</td>
                            <td>{{ m_car.model_car }}</td>
                            <td><button class="btn btn-warning" v-on:click.prevent="editModelCars(m_car)"><i class="nav-icon fas fa-edit"></i>&nbsp;Editar</button></td>
                            <td><button class="btn btn-danger" v-on:click.prevent="deleteModelCar(m_car)"><i class="nav-icon fas fa-trash-alt"></i>&nbsp;Eliminar</button></td>
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
        <create-model-car-component @recargar="getModelCars()"></create-model-car-component>

         <form method="POST" v-on:submit.prevent="updateModelCar">
            <div class="modal fade" id="editModelCars">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4>Nuevo Modelo</h4>
                            <button type="button" class="close" data-dismiss="modal">
                                <span>&times;</span>
                            </button>
                        </div>
                        
                        <div class="modal-body">
                            <label for="brand">Marca</label>
                            <select name="brand" id="brand" class="form-control" v-model="fillModelCar.brand" @change="getCarModels()">
                                <option v-bind:value="brand.id" v-for="brand in brands" :key="brand.id">{{ brand.name }}</option>
                            </select>
                        </div>
                        <div class="modal-body">
                            <label for="model_car">Modelo</label>
                            <input type="text" name="model_car" id="model_car" class="form-control" v-model="fillModelCar.model_car">
                                                    
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
        props: ['rol'],
			data () {
                return{
					fillModelCar: {
						'id': '',
                        'brand': '',
                        'brand_id': '',
                        'model_car': '',
					},
                    pagination: {
                        'total': 0,
                        'current_page': 0,
                        'per_page': 0,
                        'last_page': 0,
                        'from': 0,
                        'to': 0
					},
                    lists_models: [],
                    brands: [],
                    models: [],
                    errors: [],
					offset: 3,
                }
                
            },
            created: function() {
                this.getModelCars();
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
                getBrands: function(){
                    var url = "api/getBrands";
                    axios.get(url).then(response =>{
                        this.brands = response.data;
                    })
                },
				editModelCars: function(model_cars){
					this.fillModelCar.id   = model_cars.id;
                    this.fillModelCar.brand = model_cars.brand_id;
                    this.fillModelCar.model_car = model_cars.model_car;
					$('#editModelCars').modal('show');
				},
				getModelCars: function(page){
					var url = 'api/getModelCars?page='+page;
					axios.get(url).then(response => {
						this.lists_models = response.data.model_cars.data
						this.pagination = response.data.pagination
					});
				},
				changePage: function(page) {
					this.pagination.current_page = page;
					this.getModelCars(page);
                },
                updateModelCar: function(){
                    var url = 'model_cars/'+this.fillModelCar.id;
                    axios.put(url, {
                        brand_id: this.fillModelCar.brand,
                        model_car: this.fillModelCar.model_car
                    }).then(response => {
                        this.getModelCars();
                        this.fillModelCar.brand_id = '';
                        this.fillModelCar.model_car = '';
                        this.errors = [];
                        $('#editModelCars').modal('hide');
                        toastr.success('Modelo editado!');
                    }).catch(error => {
                        this.errors = 'Corrija para poder crear con exito!';
                    });
                },
				deleteModelCar: function(model_cars) {
					var url = 'model_cars/' + model_cars.id;
					axios.delete(url).then(response => { //eliminamos
						this.getModelCars(); //listamos
						toastr.success('Eliminado correctamente'); //mensaje
                });
            },
        }
    }
</script>