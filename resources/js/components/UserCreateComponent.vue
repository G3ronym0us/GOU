<template>
    <form method="POST" v-on:submit.prevent="storeUser">
    <div class="modal fade" id="createUser">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 v-if="rol == 'DRIVER'">Nuevo Conductor</h4>
                    <h4 v-else>Nuevo Cliente</h4>
                    <button type="button" class="close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <label for="name">Nombre</label>
                    <input type="text" class="form-control" name="name" id="name" v-model="name">

                    <label for="lastname">Apellido</label>
                    <input type="text" class="form-control" name="lastname" id="lastname" v-model="lastname">

                    <label for="phone">Telefono</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-phone"></i></span>
                        </div>
                        <input type="text" class="form-control" name="phone" id="phone" v-model="phone" data-inputmask='"mask": "(999) 999-9999"' data-mask>
                  </div>

                    <label for="email">Email</label>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                        </div>
                        <input type="email" class="form-control" name="email" id="email" v-model="email">
                    </div>

                    <label for="password">Contraseña</label>
                    <input type="password" class="form-control" name="password" id="password" v-model="password">

                    <label for="rpassword">Repetir Contraseña</label>
                    <input type="password" class="form-control" name="rpassword" id="rpassword" v-model="rpassword">


                    <label for="user_type">Tipo de Usuario</label>
                    <select class="form-control" v-model="user_type" disabled>
                        <option value="DRIVER" >Conductor</option>
                        <option value="CLIENT" >Cliente</option>
                    </select>
                    <select class="form-control" name="user_type" id="user_type" v-model="user_type" hidden>
                        <option value="DRIVER" >Conductor</option>
                        <option value="CLIENT" >Cliente</option>
                    </select>

                  
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
    props: ['rol'],
    data (){    
        return{
            name: '',
            lastname: '',
            phone: '',
            email:'',
            password: '',
            rpassword: '',
            user_type: this.rol,
            
        }
    },
    created: function() {
        this.getBrands();
        this.getUsers();
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
            console.log(brand_id);
            var url = "api/getCarModels/"+brand_id;
            axios.get(url).then(response =>{
                this.models = response.data;
            }) 
        },
        storeUser: function() {
            if(this.rol == 'DRIVER'){
                var url = 'driver';}
            else{

            }
            axios.post(url, {
                name: this.name,
                lastname: this.lastname,
                phone: this.phone,
                email: this.email,
                password: this.password,
            }).then(response => {
                this.name = '';
                this.lastname = '';
                this.phone = '';
                this.email = '';
                this.password = '';
                this.errors = [];
                this.$emit('recargar');
                $('#createUser').modal('hide');
                if(this.rol == 'DRIVER'){
                     toastr.success('Nuevo Conductor creado!');
                }else{
                    toastr.success('Nuevo Cliente creado!');
                }
               
            }).catch(error => {
                this.errors = 'Corrija para poder crear con exito!';
            });
        }
    }
}
</script>