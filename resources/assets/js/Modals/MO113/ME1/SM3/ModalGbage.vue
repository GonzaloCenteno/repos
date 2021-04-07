<template>
    <div class="modal-dialog modal-dialog-centered modal-primary modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel17">Buscar Trabajador</h4>
                <button type="button" @click.prevent="$store.state.showModal = !$store.state.showModal;" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table class="table table-sm table-hover-animation" id="trabajadores">
                    <thead>
                        <tr>
                            <th scope="col">COD AGENDA</th>
                            <th scope="col">NOMBRE</th>
                            <th scope="col">TIPO DOCUMENTO</th>
                            <th scope="col">NRO. DOCUMENTO</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</template>

<script>

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
        
    },
    created() {
        this.$datatbleGlobal('#trabajadores');
    }
};
</script>
