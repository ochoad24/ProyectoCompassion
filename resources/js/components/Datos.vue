<template>
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12 p-0">
                <div class="main-header">
                    <h4>Actualizar Datos</h4>
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
                                        <label class="col-md-3 form-control-label" for="text-input">Alumno: </label>
                                        <div class="col-md-5">
                                            <multiselect v-model="idAlumno" :options="alumnos"
                                                placeholder="Seleccione un Alumno" label="name" track-by="name">
                                            </multiselect>
                                        </div>
                                        <div class="col-md-2">
                                            <button class="btn btn-primary" @click="getDatos">Buscar</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-block">
                        <div class="row">
                            <div class="col-sm-12 table-responsive">
                                <button class="btn btn-success" @click="abrirModal">Nuevo</button>
                                <hr>
                                <table class="table table-bordered table-responsive table-hover nowrap">
                                    <thead>
                                        <tr>
                                            <th>Peso</th>
                                            <th>Altura</th>
                                            <th>Fecha de Creacion</th>
                                            <th>Opciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="item in datos" :key="item.id">
                                            <td>{{item.peso}}</td>
                                            <td>{{item.altura}}</td>
                                            <td>{{item.created_at}}</td>
                                            <td><button class="btn btn-danger"
                                                    @click="Eliminar(item.id)">Eliminar</button></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" tabindex="-1" :class="{'mostrar' : modal}" role="dialog" aria-labelledby="myModalLabel"
            style="display: none;" aria-hidden="true">
            <div class="modal-dialog modal-primary modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-primary">
                        <span>Datos</span>
                        <button type="button" class="close" @click="cerrarModal()" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="" method="post" enctype="multipart/form-data" class="form-horizontal">
                            <div class="form-group row">
                                <label class="col-md-3 form-control-label" for="text-input">Altura: </label>
                                <div class="col-md-9">
                                    <input type="text" v-model="altura" class="form-control"
                                        placeholder="Altura del Alumno en metros">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 form-control-label" for="text-input">Peso: </label>
                                <div class="col-md-9">
                                    <input type="text" v-model="peso" class="form-control"
                                        placeholder="Peso del Alumno en libras">
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" @click="cerrarModal()">Cerrar</button>
                        <button type="button" class="btn btn-primary"
                            @click="crearDato">Guardar</button>
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
                datos: [],
                altura: '',
                peso: '',
                idAlumno: '',
                modal:0

            }
        },
        methods: {
            Eliminar(id) {
                let me =this;
                swal.fire({
                    title: 'Quieres Eliminar este registro?',
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Si, Eliminalo!',
                    cancelButtonText: "Cancelar"
                }).then((result) => {
                    if (result.value) {
                        axios({
                            method: 'post',
                            url: '/Datos/delete',
                            data: {
                                id:id
                            }
                        }).then(function (response) {
                            me.getDatos();
                            swal.fire(
                                'Elimado!',
                                'El registro se ha eliminado.',
                                'success'
                            )
                        }).catch(function (error) {
                            swal.fire("Fallo!", "Hubo un problema.", "Error");
                        });
                    }
                })
            },
            crearDato(){
                let me = this;
                axios({
                    method: 'post',
                    url: '/Datos/nuevo',
                    data: {
                        peso:this.peso,
                        altura: this.altura,
                        idAlumno:this.idAlumno.id
                    }
                }).then(function (response) {
                    me.cerrarModal();
                    me.getDatos();
                    alertify.success('Dato agregado exitosamente');
                }).catch(function (error) {
                    me.getDatos();
                    alertify.error('Hubo un error');
                });
            },
            cerrarModal() {
                this.modal = 0;
                this.peso='';
                this.altura=''; 
            },
            abrirModal() {
                this.modal = 1;
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
            getDatos() {
                this.datos=[];
                var url='/Datos?id='+this.idAlumno.id
                axios.get(url)
                    .then(response => {
                        alertify.success('Datos del Alumno Cargados con Exito');
                        console.log(response.data);
                        this.datos = response.data;
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