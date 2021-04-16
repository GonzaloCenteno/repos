<template>
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-primary modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel17">Buscar Trabajador</h4>
                <button type="button" @click.prevent="cerrarModal" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-12 pt-1">
                        <div class="row">
                            <div class="col-4">
                                <div class="form-label-group">
                                    <input type="text" class="form-control form-control-sm" placeholder="NOMBRE" @keyup.enter="buscarTrabajador" v-model="busqueda.nombre"/>
                                    <label for="nombre"><b>NOMBRE</b></label>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="form-label-group">
                                    <input type="number" class="form-control form-control-sm" placeholder="DNI" @keyup.enter="buscarTrabajador" v-model="busqueda.dni"/>
                                    <label for="dni"><b>DNI</b></label>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="form-label-group">
                                    <input type="number" class="form-control form-control-sm" placeholder="CODIGO" @keyup.enter="buscarTrabajador" v-model="busqueda.codigo"/>
                                    <label for="codigo"><b>CODIGO</b></label>
                                </div>
                            </div>
                            <div class="col-1">
                                <button type="button" @click="buscarTrabajador" class="btn btn-sm btn-relief-primary btn-icon btn-block"><i class="material-icons BtnSm">search</i></button>
                            </div>
                            <div class="col-1">
                                <button type="button" @click="limpiarCampos" class="btn btn-sm btn-relief-danger btn-icon btn-block"><i class="material-icons BtnSm">clear</i></button>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <table class="table table-sm table-hover-animation table-bordered" id="trabajadores">
                            <thead>
                                <tr>
                                    <th v-for="(cab,index) in cabecera" :key="index" scope="col">{{ cab }}</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>

import $ from 'jquery'
import datatable from 'datatables.net-bs4'
require( 'datatables.net-buttons/js/dataTables.buttons' )
require( 'datatables.net-buttons/js/buttons.html5' )
import mapValues from "lodash/mapValues"

export default {
    name: "ModalGbage",
    props: {
        form: Object,
        datatable: Object,
        cabecera: Array,
        detalle: Array
    },
    data() {
        return {
            busqueda: {
                nombre: null,
                dni: null,
                codigo: null
            }
        }
    },
    methods: {
        enviarInformacion: function(data) {
            this.$emit('llenarDatos',data,this.busqueda);
            this.busqueda = mapValues(this.busqueda, () => null);
        },
        buscarTrabajador: function() {
            this.$emit('buscarTrabajador',this.busqueda);
        },
        limpiarCampos: function() {
            this.busqueda = mapValues(this.busqueda, () => null);
            this.$emit('buscarTrabajador',this.busqueda);
        },
        cerrarModal: function() {
            this.busqueda = mapValues(this.busqueda, () => null);
            this.$emit('buscarTrabajador',this.busqueda);
            this.$store.state.showModal = !this.$store.state.showModal;
        },
        crearTabla: function() {
            this.$nextTick( () => {
                $("#trabajadores").DataTable().destroy();
                let tabla = $("#trabajadores").DataTable({
                    lengthMenu: [[5, 10, 15, -1], [5, 10, 15, "Todo"]],
                    info: true,
                    ordering: true,
                    destroy:true,
                    searching: false,
                    processing : true,
                    serverSide : true,
                    responsive: true,
                    ajax: this.datatable,
                    columns: this.detalle,
                    "language": {
                        "processing": "Cargando Informacion",
                        "lengthMenu": "Mostrando _MENU_ Registros Por Pagina",
                        "zeroRecords": "No Se Encontro Resultados",
                        "info": "Mostrando Pagina _PAGE_ de _PAGES_",
                        "infoEmpty": "No Se Encontro Resultados",
                        paginate: {
                            previous: 'Anterior',
                            next:     'Siguiente'
                        }
                    }
                });

                tabla.on('click', '.btnExtraer', (obj) => { this.enviarInformacion(obj.target.dataset.object) });
            });
        }
    }
};
</script>
