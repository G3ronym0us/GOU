<template>
    <form method="POST" v-on:submit.prevent="createCarModel">
    <div class="modal fade" id="createModelo">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4>Agregar Modelo</h4>
                    <button type="button" class="close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <label for="brand">Marca</label>
                    <select class="form-control" name="brand" id="brand" v-model="brand_id">
                        <option v-bind:value="brand.id" v-for="brand in brands" :key="brand.id">{{brand.name}}</option>
                    </select>
                </div>
                <div class="modal-body">
                    <label for="model_car">Modelo</label>
                    <input type="text" class="form-control" name="model_car" v-model="model_car">
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary"><i class="nav-icon fas fa-save"></i>&nbsp;Guardar</button>
                </div>
            </div>
        </div>
    </div>
</form>
</template>


<script>
export default {
    data (){
        return{
            brands: [],
            brand_id: 1,
            model_car: '',
            errors: [],
        }
    },
    created: function() {
        this.getBrands();
    },
    methods: {
        getBrands: function(){
            var url = "api/getBrands";
            axios.get(url).then(response =>{
                this.brands = response.data;
            })
        },
        createCarModel: function() {
            var url = 'model_cars';
            axios.post(url, {
                brand_id: this.brand_id,
                model_car: this.model_car,
            }).then(response => {
                this.brand_id = '';
                this.model_car = '';
                this.errors = [];
                this.$emit('recargar');
                $('#createModelo').modal('hide');
                toastr.success('Nuevo Modelo creado!');
            }).catch(error => {
                this.errors = 'Corrija para poder crear con exito!';
            });
        }
    }
}
</script>