<template>
    <mdb-container>
        <mdb-row>
            <mdb-col size="12" class="text-center mb-5">
                <mdb-modal style="position: fixed;width: 100%;height: 100%;background: rgba(0,0,0,0.7);top: 0;pointer-events: none;-webkit-transition: all 0.3s;-moz-transition: all 0.3s;transition: all 0.3s;&:target {opacity: 1;pointer-events: auto;}" class="text-left"
                 removeBackdrop size="lg" :show="$store.state.showModal" @close="$store.state.showModal = false" cascade>
                    <mdb-modal-header class="white-text" style="background: #165199">
                        <h4 class="title">Buscar Trabajador</h4>
                    </mdb-modal-header>
                    <mdb-modal-body class="grey-text">
                        <mdb-container>
                            <mdb-col class="col-12">
                                <mdb-row>
                                    <mdb-col class="col-6">
                                        <mdb-input class="py-0 my-1" placeholder="" size="sm" type="text" label="NOMBRE" outline/>
                                    </mdb-col>
                                    <mdb-col class="col-3">
                                        <mdb-input class="py-0 my-1" placeholder="" size="sm" type="text" label="DNI" outline/>
                                    </mdb-col>
                                    <mdb-col class="col-3">
                                        <mdb-input class="py-0 my-1" placeholder="" size="sm" type="text" label="CODIGO" outline/>
                                    </mdb-col>
                                </mdb-row>
                                <mdb-row>
                                    <mdb-col class="col-3 offset-5">
                                        <slot name="buttons" />
                                    </mdb-col>
                                </mdb-row>
                                <table class="table table-sm table-hover">
                                    <thead>
                                        <tr>
                                            <th width="10%" scope="col">#</th>
                                            <th width="5%" scope="col">COD AGENCIA</th>
                                            <th width="60%" scope="col">NOMBRE</th>
                                            <th width="10%" scope="col">TIPO DOCUMENTO</th>
                                            <th width="15%" scope="col">NRO. DOCUMENTO</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr @click="$emit('llenarDatos',{trab})" v-for="(trab,item) in trabajadores" :key="trab.gbagecage">
                                            <td>{{ item }}</td>
                                            <td>{{ trab.adusragen }}</td>
                                            <td>{{ trab.gbagenomb }}</td>
                                            <td>{{ trab.gbagetdid }}</td>
                                            <td v-text="(trab.gbagetdid === 'DNI' ? trab.gbagendid : trab.gbagenruc)"></td>
                                        </tr>
                                    </tbody>
                                </table>
                                <mdb-row class="text-center">
                                    <el-pagination
                                        background
                                        :total="total"
                                        @current-change="handleCurrentChange"
                                        :pager-count="11"
                                        :page-size="5"
                                        layout="prev, pager, next"
                                    >
                                    </el-pagination>
                                </mdb-row>
                            </mdb-col>
                        </mdb-container>
                    </mdb-modal-body>
                </mdb-modal>
            </mdb-col>
        </mdb-row>
    </mdb-container>
</template>

<script>
import Pagination from '../../../../Components/Pagination'
import { mdbContainer, mdbRow, mdbCol, mdbInput, mdbTextarea, mdbBtn, mdbIcon, mdbModal, mdbModalHeader, mdbModalBody, mdbModalFooter } from 'mdbvue';
export default {
    name: "ModalGbage",
    components: {
        Pagination,
        mdbContainer,
        mdbRow,
        mdbCol,
        mdbInput,
        mdbTextarea,
        mdbBtn,
        mdbIcon,
        mdbModal,
        mdbModalHeader,
        mdbModalBody,
        mdbModalFooter
    },
    props: {
        //errors: Object,
        form: Object
    },
    data() {
        return {
            trabajadores: Array,
            total: 0
        };
    },
    methods: {
        handleCurrentChange (val) {
            axios.get(this.route('programa.show', val))
            .then( rspta => {
                this.trabajadores = rspta.data.data;
                this.total = rspta.data.total;
            }); 
        }
    },
};
</script>
