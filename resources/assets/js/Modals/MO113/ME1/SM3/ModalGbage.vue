<template>
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-primary modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel17">Buscar Trabajador</h4>
                <button type="button" @click.prevent="$store.state.showModal = !$store.state.showModal;" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-12">
                        <table class="table table-sm table-hover-animation" id="trabajadores">
                            <thead>
                                <tr>
                                    <th scope="col">COD AGENDA</th>
                                    <th scope="col">NOMBRE</th>
                                    <th scope="col">TIPO DOCUMENTO</th>
                                    <th scope="col">NRO. DOCUMENTO</th>
                                    <th scope="col">ACCIONES</th>
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

import datatable from 'datatables.net-bs4'
require( 'datatables.net-buttons/js/dataTables.buttons' )
require( 'datatables.net-buttons/js/buttons.html5' )

export default {
    name: "ModalGbage",
    props: {
        form: Object
    },
    data() {
        return {
            trabajadores: Array,
            total: 0,
            texto: '',
        };
    },
    methods: {
        enviarInformacion: function(data) {
            let datos = JSON.parse(data);
            axios.get(this.route('programa.show',0), {
                params: {
                    valor: datos.gbagecage,
                    tipo: 4
                }
            })
            .then(rspta => {
                let obj = rspta.data;
                this.$emit('llenarDatos',{datos,obj});
            }); 
        }
    },
    created() {
        this.$nextTick( () => {
            $("#trabajadores").DataTable().destroy();
            let tabla = $("#trabajadores").DataTable({
                lengthMenu: [[5, 10, 15, -1], [5, 10, 15, "Todo"]],
                info: true,
                ordering: true,
                destroy:true,
                searching: true,
                processing : true,
                serverSide : true,
                responsive: true,
                ajax: {
                    url: this.route('programa.show',0),
                    data: {
                        tipo: 1
                    }
                },
                columns: [
                    { data: 'gbagecage', searchable: false },
                    { data: 'gbagenomb' },
                    { data: 'gbagetdid', searchable: false },
                    { data: 'gbagendid'},
                    {data: 'action', name: 'action', orderable: false, searchable: false}
                ]
            });

            tabla.on('click', '.btnExtraer', (obj) => { this.enviarInformacion(obj.target.dataset.object) });
        });
    }
};
</script>
