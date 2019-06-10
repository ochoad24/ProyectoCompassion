<template>
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12 p-0">
                <div class="main-header">
                    <h4>Donaciones</h4><h5>Total: {{Total}}</h5>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-block">
                        <div class="row">
                            <div class="col-sm-12 table-responsive">
                                <table class="table table-bordered table-responsive table-hover nowrap">
                                    <thead>
                                        <tr>
                                            <th>Donacion</th>
                                            <th>Cantidad</th>
                                            <th>Estado</th>
                                            <th>Fecha</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="donacion in donaciones" :key="donacion.id">
                                            <td>{{donacion.title}}</td>
                                            <td>{{donacion.price}}</td>
                                            <td>{{donacion.payment_status}}</td>
                                            <td>{{donacion.created_at}}</td>
                                        </tr>
                                    </tbody>
                                   
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


</template>
<script>
    export default {
        data() {
            return {
                donaciones:[],
                Total:0
            }
        },
        methods: {
            Sumar(){
                this.donaciones.forEach(element => {
                    this.Total+=parseFloat(element.price);
                });
            },
            getDonaciones() {
                axios.get('/Donacion')
                    .then(response => {
                        console.log(response.data);
                        this.donaciones = response.data;
                        this.Sumar();
                    })
                    .catch(errors => {
                        console.log(errors);
                    });
            }
        },
        mounted(){
            this.getDonaciones();
        }
    };
</script>
<style>
    .mostrar {
        display: list-item !important;
        opacity: 1 !important;
        position: absolute !important;
        background-color: #3c29297a !important;
    }

    .modal-content {
        width: 100% !important;
        position: absolute !important;
    }

    .div-error {
        display: flex;
        justify-content: center;
    }

    .text-error {
        color: red !important;
        font-weight: bold;
    }
</style>