<template>
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12 p-0">
                <div class="main-header">
                    <h4>Gastos</h4>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div class="table-style">
                            <div class="control">
                                <div class="md-input-wrapper">
                                    <input class="md-form-control" type="text" v-model="search" placeholder="Buscar..."
                                        @input="resetPagination()">
                                </div>
                                <div class="select">
                                    Mostrar:
                                    <select v-model="length" @change="resetPagination()">
                                        <option value="10">10</option>
                                        <option value="20">20</option>
                                        <option value="30">30</option>
                                    </select>
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
                                            <th v-for="column in columns" :key="column.name"
                                                @click="sortBy(column.name)"
                                                :class="sortKey === column.name ? (sortOrders[column.name] > 0 ? 'sorting_asc' : 'sorting_desc') : 'sorting'"
                                                style="width: 40%; cursor:pointer;">
                                                {{column.label}}
                                            </th>
                                            <th>Accion</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="user in paginatedUsers" :key="user.id">
                                            <td>{{user.alumno}}</td>
                                            <td>{{user.total}}</td>
                                            <td>{{user.cheque}}</td>
                                            <td>{{user.created_at}}</td>
                                            <td>
                                                <div class="button-group">
                                                    <button type="button" class="btn btn-danger btn-sm"
                                                        @click="deleteUser(user.id)">Eliminar</button>
                                                    <button type="button" class="btn btn-success btn-sm"
                                                        @click="abrirModal(1,user)">Ver</button>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <div>
                                    <nav class="pagination" v-if="!tableShow.showdata">
                                        <span class="page-stats">{{pagination.from}} - {{pagination.to}} de
                                            {{pagination.total}}</span>
                                        <a v-if="pagination.prevPageUrl"
                                            class="btn btn-sm btn-primary pagination-previous"
                                            @click="--pagination.currentPage">
                                            Ant
                                        </a>
                                        <a class="btn btn-sm btn-primary pagination-previous" v-else disabled>
                                            Ant
                                        </a>
                                        <a v-if="pagination.nextPageUrl" class="btn btn-sm pagination-next"
                                            @click="++pagination.currentPage">
                                            Sig
                                        </a>
                                        <a class="btn btn-sm btn-primary pagination-next" v-else disabled>
                                            Sig
                                        </a>
                                    </nav>
                                    <nav class="pagination" v-else>
                                        <span class="page-stats">
                                            {{pagination.from}} - {{pagination.to}} of {{filteredUsers.length}}
                                            <span v-if="`filteredUsers.length < pagination.total`"></span>
                                        </span>
                                        <a v-if="pagination.prevPage" class="btn btn-sm btn-primary pagination-previous"
                                            @click="--pagination.currentPage">
                                            Ant
                                        </a>
                                        <a class="btn btn-sm pagination-previous btn-primary" v-else disabled>
                                            Ant
                                        </a>
                                        <a v-if="pagination.nextPage" class="btn btn-sm btn-primary pagination-next"
                                            @click="++pagination.currentPage">
                                            Sig
                                        </a>
                                        <a class="btn btn-sm pagination-next btn-primary" v-else disabled>
                                            Sig
                                        </a>
                                    </nav>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--Inicio del modal agregar/actualizar-->
        <div class="modal fade" tabindex="-1" :class="{'mostrar' : modal}" role="dialog" aria-labelledby="myModalLabel"
            style="display: none;" aria-hidden="true">
            <div class="modal-dialog modal-primary modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-primary">
                        <span v-text="Titulo">Test</span>
                        <button type="button" class="close" @click="cerrarModal()" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-sm-12 table-responsive">
                                <table class="table table-bordered table-responsive table-hover nowrap">
                                    <thead>
                                        <tr>
                                            <th>Gasto</th>
                                            <th>Subtotal</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="gasto in gastos" :key="gasto.id">
                                            <td>{{gasto.gasto}}</td>
                                            <td>{{gasto.subtotal}}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <h4>Total: {{total}}</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>


</template>
<script>
    export default {
        created() {
            this.getUsers();

            Fire.$on('reloadUsers', () => {
                this.getUsers();
            })
        },

        data() {
            let sortOrders = {};
            let columns = [
                { label: 'Alumno', name: 'alumno' },
                { label: 'Total', name: 'total' },
                { label: 'No.Cheque', name: 'cheque' },
                { label: 'Fecha de Creacion', name: 'created_at' },
            ];
            columns.forEach((column) => {
                sortOrders[column.name] = -1;
            });

            return {
                modal: 0,
                causas: '',
                idNivel: '',
                Titulo: '',
                total: 0,
                tipoAccion: 0,
                errorNivel: 0,
                errorMostrarMsjNivel: [],
                users: [],
                gastos: [],
                columns: columns,
                sortKey: 'created_at',
                sortOrders: sortOrders,
                length: 10,
                search: '',
                tableShow: {
                    showdata: true,
                },
                pagination: {
                    currentPage: 1,
                    total: '',
                    nextPage: '',
                    prevPage: '',
                    from: '',
                    to: ''
                },
            }
        },
        methods: {
            cargarGastos(id) {
                var url = '/Gasto/detalle?id=' + id;
                axios.get(url)
                    .then(response => {
                        console.log(response.data);
                        this.gastos = response.data;
                    })
                    .catch(errors => {
                        console.log(errors);
                    });
            },
            cerrarModal() {
                this.modal = 0;
                this.idNivel = '';
                this.causas = '';
                this.errorNivel = '';
                this.errorMostrarMsjNivel = [];
            },
            abrirModal(Tipo, Nivel) {
                if (Tipo == 0) {
                    this.tipoAccion = 0;
                    this.Titulo = 'NUEVO';
                } else {
                    this.tipoAccion = 1;
                    this.Titulo = 'GASTOS';
                    this.total = Nivel['total'];
                    this.cargarGastos(Nivel['id']);
                }
                this.modal = 1;

            },
            deleteUser(id) {
                swal.fire({
                    title: 'Quieres eliminar este registro?',
                    text: "No podras revertir la eliminacion!",
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
                        url: '/Gasto/delete',
                        data: {
                            id:id
                        }
                    }).then(() => {
                            Fire.$emit('reloadUsers')
                            swal.fire(
                                'Eliminado!',
                                'Nivel Eliminado.',
                                'success'
                            )
                            Fire.$emit('AfterCreate');
                        }).catch(() => {
                            swal.fire("Fallo!", "Hubo un problema.", "Error");
                        });
                    }
                })
            },

            getUsers() {
                axios.get('/Gasto/', { params: this.tableShow })
                    .then(response => {
                        console.log(response.data);
                        this.users = response.data;
                        this.pagination.total = this.users.length;
                    })
                    .catch(errors => {
                        console.log(errors);
                    });
            },
            paginate(array, length, pageNumber) {
                this.pagination.from = array.length ? ((pageNumber - 1) * length) + 1 : ' ';
                this.pagination.to = pageNumber * length > array.length ? array.length : pageNumber * length;
                this.pagination.prevPage = pageNumber > 1 ? pageNumber : '';
                this.pagination.nextPage = array.length > this.pagination.to ? pageNumber + 1 : '';
                return array.slice((pageNumber - 1) * length, pageNumber * length);
            },
            resetPagination() {
                this.pagination.currentPage = 1;
                this.pagination.prevPage = '';
                this.pagination.nextPage = '';
            },
            sortBy(key) {
                this.resetPagination();
                this.sortKey = key;
                this.sortOrders[key] = this.sortOrders[key] * -1;
            },
            getIndex(array, key, value) {
                return array.findIndex(i => i[key] == value)
            },
        },
        computed: {

            filteredUsers() {
                let users = this.users;
                if (this.search) {
                    users = users.filter((row) => {
                        return Object.keys(row).some((key) => {
                            return String(row[key]).toLowerCase().indexOf(this.search.toLowerCase()) > -1;
                        })
                    });
                }
                let sortKey = this.sortKey;
                let order = this.sortOrders[sortKey] || 1;
                if (sortKey) {
                    users = users.slice().sort((a, b) => {
                        let index = this.getIndex(this.columns, 'name', sortKey);
                        a = String(a[sortKey]).toLowerCase();
                        b = String(b[sortKey]).toLowerCase();
                        if (this.columns[index].type && this.columns[index].type === 'date') {
                            return (a === b ? 0 : new Date(a).getTime() > new Date(b).getTime() ? 1 : -1) * order;
                        } else if (this.columns[index].type && this.columns[index].type === 'number') {
                            return (+a === +b ? 0 : +a > +b ? 1 : -1) * order;
                        } else {
                            return (a === b ? 0 : a > b ? 1 : -1) * order;
                        }
                    });
                }
                return users;
            },
            paginatedUsers() {
                return this.paginate(this.filteredUsers, this.length, this.pagination.currentPage);
            }
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