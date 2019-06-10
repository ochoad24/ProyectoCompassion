<template>
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12 p-0">
                <div class="main-header">
                    <h4>Nuevo Gasto</h4>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div class="table-style">
                            <div class="control">
                                <div class="form-horizontal">
                                    <div class="form-group row">
                                        <label class="col-md-3 form-control-label" for="text-input">Cheque: </label>
                                        <div class="col-md-9">
                                            <input type="text" v-model="cheque" class="form-control"
                                                placeholder="Cheque del alumno">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-3 form-control-label" for="text-input">Alumno: </label>
                                        <div class="col-md-9">
                                            <multiselect v-model="idAlumno" :options="alumnos"
                                                placeholder="Seleccione un Alumno" label="name" track-by="name">
                                            </multiselect>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-3 form-control-label" for="text-input">Gasto: </label>
                                        <div class="col-md-5">
                                            <input type="text" v-model="gasto" class="form-control"
                                                placeholder="Gasto del alumno">
                                        </div>
                                        <div class="col-md-2">
                                            <input type="number" v-model="subtotal" class="form-control">
                                        </div>
                                        <div class="col-md-2">
                                            <button class="btn btn-success" @click="Agregar">Agregar</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-block">
                        <div class="row">
                            <div class="col-sm-12 table-responsive">
                                <table class="table table-bordered table-responsive table-hover nowrap">
                                    <thead>
                                        <tr>
                                            <th>Descripcion</th>
                                            <th>Subtotal</th>
                                            <th>Opciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="item in gastos" :key="item.gasto">
                                            <td>{{item.gasto}}</td>
                                            <td>{{item.subtotal}}</td>
                                            <td><button class="btn btn-danger"
                                                    @click="Quitar(item.gasto)">Quitar</button></td>
                                        </tr>
                                    </tbody>
                                </table>
                                <h4>Total: {{total}}</h4><button class="btn btn-primary" @click="Guardar">Guardar</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    import Multiselect from 'vue-multiselect';
    export default {
        components: {
            Multiselect
        },
        data() {

            return {
                alumnos: [],
                gastos: [],
                total: 0.0,
                cheque: '',
                idAlumno: '',
                detalle: [],
                gasto: '',
                subtotal: '',

            }
        },
        methods: {
            Guardar() {
                swal.fire({
                    title: 'Quieres Guardar este Gasto?',
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Si, Guardalo!',
                    cancelButtonText: "Cancelar"
                }).then((result) => {
                    if (result.value) {
                        axios({
                            method: 'post',
                            url: '/Gasto/nuevo',
                            data: {
                                total:this.total,
                                idAlumno:this.idAlumno.id,
                                cheque:this.cheque,
                                detalle:this.gastos
                            }
                        }).then(function (response) {
                            swal.fire(
                                'Guardado!',
                                'Gasto Guardado.',
                                'success'
                            )
                        }).catch(function (error) {
                            swal.fire("Fallo!", "Hubo un problema.", "Error");
                        });
                        this.total=0.0;
                        this.idAlumno='';
                        this.cheque='';
                        this.gastos=[];
                    }
                })
            },
            ActualzarTotal() {
                this.total = 0;
                for (var i = 0; i < this.gastos.length; i++) {
                    this.total += parseFloat(this.gastos[i].subtotal);
                }
            },
            Quitar(id) {

                for (var i = 0; i < this.gastos.length; i++) {
                    if (this.gastos[i].gasto === id) {
                        this.gastos.splice(i, 1);
                    }
                }
                this.ActualzarTotal();
            },
            Agregar() {
                var dato = {
                    gasto: this.gasto,
                    subtotal: this.subtotal
                }
                this.gastos.push(dato);
                this.gasto = '';
                this.subtotal = 0;
                this.ActualzarTotal();
            },
            getAlumnos() {
                axios.get('/Alumno/select')
                    .then(response => {
                        console.log(response.data);
                        this.alumnos = response.data;
                    })
                    .catch(errors => {
                        console.log(errors);
                    });
            },
        },
        mounted() {
            this.getAlumnos();
        },
        computed: {

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