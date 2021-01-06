<template>
    <form method="POST" v-on:submit.prevent="storeDocumentation" enctype="multipart/form-data">
    <div class="modal fade" id="createDocumentation">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4>Guardar Documentacion</h4>
                    <button type="button" class="close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>
                <div     class="modal-body">
                    <label for="license">Licencia</label>
                    <input type="text" class="form-control" name="license" id="license" v-model="license">
                    <div class="input-group">
                      <div class="custom-file">
                        <input type="file" class="custom-file-input" id="license_img" @change="licenseFiles">
                        <label class="custom-file-label" for="exampleInputFile">Seleccionar Archivo</label>
                      </div>
                      <div class="input-group-append">
                        <span class="btn input-group-text" @click="uploadLicense">Subir</span>
                      </div>
                    </div>
                    
                    <label for="license">Licencia Vehicular</label>
                    <input type="text" class="form-control" name="carlicense" id="carlicense" v-model="carlicense">
                    <div class="input-group">
                      <div class="custom-file">
                        <input type="file" class="custom-file-input" id="carlicense_img">
                        <label class="custom-file-label" for="exampleInputFile">Seleccionar Archivo</label>
                      </div>
                      <div class="input-group-append">
                        <span class="input-group-text">Subir</span>
                      </div>
                    </div>

                    <label for="license">Seguro</label>
                    <input type="text" class="form-control" name="insurance" id="insurance" v-model="insurance">
                    <div class="input-group">
                      <div class="custom-file">
                        <input type="file" class="custom-file-input" id="insurance_img">
                        <label class="custom-file-label" for="exampleInputFile">Seleccionar Archivo</label>
                      </div>
                      <div class="input-group-append">
                        <span class="input-group-text">Subir</span>
                      </div>
                    </div>

                    <label for="license">VTV</label>
                    <input type="text" class="form-control" name="vtv" id="vtv" v-model="vtv">
                    <div class="input-group">
                      <div class="custom-file">
                        <input type="file" class="custom-file-input" id="vtv_img">
                        <label class="custom-file-label" for="exampleInputFile">Seleccionar Archivo</label>
                      </div>
                      <div class="input-group-append">
                        <span class="input-group-text">Subir</span>
                      </div>
                    </div>

                    <label for="license">Imagenes del Vehiculo</label>

                    <label for="license">Delantera</label>
                    <div class="input-group">
                      <div class="custom-file">
                        <input type="file" class="custom-file-input" id="front_img" @change="frontFiles">
                        <label class="custom-file-label" for="exampleInputFile">Seleccionar Archivo</label>
                      </div>
                      <div class="input-group-append">
                        <span class="input-group-text">Subir</span>
                      </div>
                    </div>

                    <label for="license">Trasera</label>
                    <div class="input-group">
                      <div class="custom-file">
                        <input type="file" class="custom-file-input" id="back_img" @change="backFiles">
                        <label class="custom-file-label" for="exampleInputFile">Seleccionar Archivo</label>
                      </div>
                      <div class="input-group-append">
                        <span class="input-group-text">Subir</span>
                      </div>
                    </div>

                    <label for="license">Derecha</label>
                    <div class="input-group">
                      <div class="custom-file">
                        <input type="file" class="custom-file-input" id="left_img" @change="rightFiles">
                        <label class="custom-file-label" for="exampleInputFile">Seleccionar Archivo</label>
                      </div>
                      <div class="input-group-append">
                        <span class="input-group-text">Subir</span>
                      </div>
                    </div>

                    <label for="license">Izquierda</label>
                    <div class="input-group">
                      <div class="custom-file">
                        <input type="file" class="custom-file-input" id="right_img" @change="leftFiles">
                        <label class="custom-file-label" for="exampleInputFile">Seleccionar Archivo</label>
                      </div>
                      <div class="input-group-append">
                        <span class="input-group-text">Subir</span>
                      </div>
                    </div>                    
                    
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
    props: ['documentation', 'base_url'],
    data (){    
        return{
            brands: [],
            models: [],
            users: [],
            user_id: '',
            license: '',
            carlicense: '',
            insurance: '',
            vtv: '',
            car_color: '',
            car_patent: '',
            license_img: '',
            front_img: '',
            back_img: '',
            left_img: '',
            right_img: '',
        }
    },
    created: function() {
        this.getUsers();
    },
    methods: {
        licenseFiles(event) {
            
            this.license_img = event.target.files[0];

        },
        frontFiles(event) {
            this.front_img = event.target.files[0];
        },
        backFiles(event) {
            this.back_img = event.target.files[0];
        },
        leftFiles(event) {
            this.left_img = event.target.files[0];
        },
        rightFiles(event) {
            this.right_img = event.target.files[0];
        },
        uploadLicense: function(){
            let formData = new FormData();
            console.log(this.license_img);
            formData.append('license_img', this.license_img);
            formData.append('user_id', this.documentation.user_id);
            var url = 'updateDocumentation';
            axios.post(url, formData).then(response => {
                console.log(response.data)
                //$('#storeDocumentation').modal('hide');
                //toastr.success('Modelo editado!');
            }).catch(error => {
                this.errors = 'Corrija para poder crear con exito!';
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
        storeCar: function() {
            var url = 'cars';
            axios.post(url, {
                user_id: this.user_id,
                model_id: this.car_model,
                car_year: this.car_year,
                car_color: this.car_color,
                car_patent: this.car_patent,
            }).then(response => {
                this.brand = '';
                this.car_model = '';
                this.car_year = '';
                this.car_color = '';
                this.car_patent = '';
                this.errors = [];
                this.$emit('recargar');
                $('#createVehiculo').modal('hide');
                toastr.success('Nuevo Vehiculo creado!');
            }).catch(error => {
                this.errors = 'Corrija para poder crear con exito!';
            });
        }
    }
}
</script>