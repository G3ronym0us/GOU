<template>
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3>{{  }}</h3>
                        <p>Comisiones por cobrar</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-bag"></i>
                    </div>
                    <a href="#" class="small-box-footer">Información <i class="fas fa-arrow-circle-right"></i></a>
                </div>

            </div>
            <div class="col-md-6">
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3>{{  }}</h3>
                        <p>Comisiones pagadas</p>
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
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Conductor</th>
                            <th>Comisión pendiente</th>
                            <th>Comisión pagada (ganancia)</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="driver in drivers" :key="driver.user_id">
                            <td>{{ driver.id }}</td>
                            <td>{{ driver.name+' '+driver.lastname }}</td>
                            <td>{{ driver.total_commision }}</td>
                            <td>{{ driver.total_paid }}</td>
                            <td></td>

                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data(){
        return{
            drivers: [],
            pagination: {
                'total': 0,
                'current_page': 0,
                'per_page': 0,
                'last_page': 0,
                'from': 0,
                'to': 0
            },
        }
    },
    created: function(){
        this.getDrivers();
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
    methods:{
        getDrivers: function(page){
            var url = 'getDrivers?page='+page;
            axios.get(url).then(response => {
                this.drivers = response.data.drivers.data
                this.pagination = response.data.pagination
            });
        },
    }
}
</script>