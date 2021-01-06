<template>
    <form method="POST" v-on:submit.prevent="storeCar">
    <div class="modal fade" id="addCar">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4>Nuevo Vehiculo</h4>{{id}}
                    <button type="button" class="close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <pre>
                        {{$data}}
                    </pre>
                    <label for="n_user_id">Usuario</label>
                    <select class="form-control" name="n_user_id" id="n_user_id" v-model="n_user_id" @change="getCarModels(n_user_id)" required>
                        <option value="" disabled>SELECCIONE UN USUARIO</option>
                        <option v-bind:value="user.id" v-for="user in users" :key="user.id">{{user.name}}</option>
                    </select>

                    <label for="n_brand">Marca</label>
                    <select class="form-control" name="n_brand" id="n_brand" v-model="n_brand" @change="getCarModels(n_brand)" required>
                        <option value="" disabled>SELECCIONE UNA MARCA</option>
                        <option v-bind:value="brand.id" v-for="brand in brands" :key="brand.id">{{brand.name}}</option>
                    </select>

                    <label for="n_car_model">Modelo</label>
                    <select class="form-control" name="n_car_model" id="n_car_model" v-model="n_car_model" required>
                        <option value="" disabled>Seleccione un modelo</option>
                        <option v-bind:value="car_model.id" v-for="car_model in models" :key="car_model.id">{{car_model.model_car}}</option>
                    </select>

                    <label for="n_car_year">Año</label>
                    <select class="form-control" name="n_car_year" id="n_car_year" v-model="n_car_year" required>
                    </select>

                    <label for="n_car_color">Color</label>
                    <input type="text" class="form-control" name="n_car_color" id="n_car_color" v-model="n_car_color" required>
                    
                    <label for="n_car_patent">Patente</label>
                    <input type="text" class="form-control" name="n_car_patent" id="n_car_patent" v-model="n_car_patent" required>
                </div>
                <div class="modal-footer">
                    <input type="submit" class="btn btn-primary" value="Guardar">
                </div>
            </div>
        </div>
    </div>
</form>
</template>

<script>
export default {
    props: ['id'],
    data (){    
        return{
            n_user_id: '',
            n_brand: '',
            n_car_model: '',
            n_car_year: '',
            n_car_color: '',
            n_car_patent: '',
            brands: [],
            models: [],
            users: [],
            
            
        }
    },
    created: function() {

        this.getBrands();
        this.getUsers();
    },
    mounted: function () {
        this.$nextTick(function () {
            this.loadYears();
            
        })
    },
    methods: {
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
            var url = "api/getCarModels/"+brand_id;
            axios.get(url).then(response =>{
                this.models = response.data;


            }) 
        },
        storeCar: function() {
            var url = 'cars';
            axios.post(url, {
                user_id: this.n_user_id,
                model_id: this.n_car_model,
                car_year: this.n_car_year,
                car_color: this.n_car_color,
                car_patent: this.n_car_patent,
            }).then(response => {
                this.n_brand = '';
                this.n_car_model = '';
                this.n_car_year = '';
                this.car_color = '';
                this.n_car_patent = '';
                this.errors = [];
                this.$emit('recargar');
                $('#createVehiculo').modal('hide');
                toastr.success('Nuevo Vehiculo creado!');
            }).catch(error => {
                this.errors = 'Corrija para poder crear con exito!';
            });
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
        }
    }
}
</script>