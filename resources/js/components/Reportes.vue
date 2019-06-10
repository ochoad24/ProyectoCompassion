<template>
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12 p-0">
                <div class="main-header">
                    <h4>Reportes</h4>
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
                                        <h5>Informe de Gastos</h5>
                                        <label class="col-md-3 form-control-label" for="text-input">Alumno: </label>
                                        <div class="col-md-5">
                                            <multiselect v-model="idAlumno" :options="alumnos"
                                                placeholder="Seleccione un Alumno" label="name" track-by="name">
                                            </multiselect>
                                        </div>
                                        <div class="col-md-2">
                                            <a class="btn btn-primary"
                                                v-bind:href="'/Excel/Gasto?id='+ idAlumno.id">Descargar Reporte de
                                                Gastos</a>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="form-group row">
                                        <h5>Historial Medico</h5>
                                        <label class="col-md-3 form-control-label" for="text-input">Alumno: </label>
                                        <div class="col-md-5">
                                            <multiselect v-model="idAlumno" :options="alumnos"
                                                placeholder="Seleccione un Alumno" label="name" track-by="name">
                                            </multiselect>
                                        </div>
                                        <div class="col-md-2">
                                            <a class="btn btn-primary"
                                                v-bind:href="'/Excel/Historial?id='+ idAlumno.id">Descargar Reporte de
                                                Historial Medico</a>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="form-group row">
                                        <h5>Historial Peso y Altura</h5>
                                        <label class="col-md-3 form-control-label" for="text-input">Alumno: </label>
                                        <div class="col-md-5">
                                            <multiselect v-model="idAlumno" :options="alumnos"
                                                placeholder="Seleccione un Alumno" label="name" track-by="name">
                                            </multiselect>
                                        </div>
                                        <div class="col-md-2">
                                            <a class="btn btn-primary"
                                                v-bind:href="'/Excel/Peso?id='+ idAlumno.id">Descargar Reporte de
                                                Historial Peso y Altura</a>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="form-group row">
                                        <h5>Informe de Cumpleañeros del Mes Actual</h5>
                                        <a class="btn btn-primary" v-bind:href="'/Excel/Cumple'">Descargar Reporte</a>
                                    </div>
                                    <hr>
                                    <div class="form-group row">
                                        <h5>Informe de Peso y Tallas</h5>
                                        <a class="btn btn-primary" v-bind:href="'/Excel/Alumno'">Descargar Reporte</a>
                                    </div>
                                    <hr>
                                    <div class="form-group row">
                                        <h5>Altura y Peso de los Alumnos</h5>
                                        <a class="btn btn-primary" v-bind:href="'/Excel/Altura'">Descargar Reporte</a>
                                    </div>
                                </div>
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
                idAlumno: '',
            }
        },
        methods: {
            getAlumnos() {
                axios.get('/Alumno/select')
                    .then(response => {
                        console.log(response.data);
                        this.alumnos = response.data;
                    })
                    .catch(errors => {
                        console.log(errors);
                    });
            }
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