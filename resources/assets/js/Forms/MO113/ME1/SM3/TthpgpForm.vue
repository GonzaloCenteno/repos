<template>
    <form style="width: 100%">
        <mdb-navbar color="grey-gradient" class="NavbarClass">
            <mdb-navbar-nav nav left>
                <mdb-form-inline class="text-center">
                    <slot name="buttons" />
                </mdb-form-inline>
            </mdb-navbar-nav>
        </mdb-navbar>
        <mdb-container class="pt-5 mt-4 ContenedorForm">
            <mdb-col class="col-12">
                <mdb-card-title><strong>Datos Adicionales Trabajador</strong></mdb-card-title> 
                <div v-if="$store.state.errors['trabajador.tthdatcage']" class="TextInvalid">{{ $store.state.errors['trabajador.tthdatcage'][0] }}</div>
                <mdb-row class="">
                    <mdb-col class="col-5">
                        <mdb-input class="py-0 my-1 DisabledText" placeholder="" size="sm" type="text" label="NOMBRE" v-model="modal.nombre" outline disabled/>
                    </mdb-col>
                    <mdb-col class="col-1  mb-0 pt-0 ml-0 pl-0">
                        <mdb-btn @click="traerDatosTrabajador" outline="primary" size="sm" class="mt-0 BotonEstilo"><mdb-icon icon="search"/></mdb-btn>
                    </mdb-col>
                    <mdb-col class="col-6">
                        <mdb-input class="py-0 my-1 DisabledText" placeholder="" size="sm" type="text" label="DNI" v-model="modal.dni" outline disabled/>
                    </mdb-col>
                </mdb-row>
                <mdb-row class="">
                    <mdb-col class="col-4">
                        <mdb-input class="py-0 my-1 DisabledText" placeholder="" size="sm" type="text" label="USUARIO" v-model="modal.usuario" outline disabled/>
                    </mdb-col>
                    <mdb-col class="col-4">
                        <mdb-input class="py-0 my-1 DisabledText" placeholder="" size="sm" type="text" label="COD. AGENCIA" v-model="modal.codAgencia" outline disabled/>
                    </mdb-col>
                    <mdb-col class="col-4">
                        <mdb-input class="py-0 my-1 DisabledText" placeholder="" size="sm" type="text" label="ESTADO" v-model="modal.estado" outline disabled/>
                    </mdb-col>
                </mdb-row>
                <mdb-row class="">
                    <mdb-col class="col-6">
                        <mdb-input class="py-0 my-1 DisabledText" placeholder="" size="sm" type="text" label="PERFIL" v-model="modal.perfil" outline disabled/>
                    </mdb-col>
                    <mdb-col class="col-6">
                        <mdb-input class="py-0 my-1 DisabledText" placeholder="" size="sm" type="text" label="AGENCIA" v-model="modal.agencia" outline disabled/>
                    </mdb-col>
                </mdb-row>
                <mdb-row class="">
                    <mdb-col class="col-4">
                        <mdb-input class="py-0 my-1 DisabledText" placeholder="" size="sm" type="text" label="FECHA INGRESO" v-model="modal.fechaIngreso" outline disabled/>
                    </mdb-col>
                    <mdb-col class="col-4">
                        <mdb-input class="py-0 my-1 DisabledText" placeholder="" size="sm" type="text" label="FECHA REINGRESO" v-model="modal.fechaReingreso" outline disabled/>
                    </mdb-col>
                    <mdb-col class="col-4">
                        <mdb-input class="py-0 my-1 DisabledText" placeholder="" size="sm" type="text" label="FECHA CESE" v-model="modal.fechaCese" outline disabled/>
                    </mdb-col>
                </mdb-row>
                <mdb-card-title><strong>Datos Laborales</strong></mdb-card-title>
                <mdb-row class="">
                    <mdb-col class="col-4 py-0 my-2">
                        <el-select class="SelectStyle" size="mini" v-model="Formulario.trabajador.tthdattcol" filterable placeholder="T. Colaborador">
                            <el-option v-for="colaborador in tthdattcol" :key="colaborador.tadconcorr" :label="colaborador.tadcondesc" :value="colaborador.tadconcorr"></el-option>
                        </el-select>
                        <div v-if="$store.state.errors['trabajador.tthdattcol']" class="TextInvalid">{{ $store.state.errors['trabajador.tthdattcol'][0] }}</div>
                    </mdb-col>
                    <mdb-col class="col-4 py-0 my-2">
                        <el-select class="SelectStyle" size="mini" v-model="Formulario.trabajador.tthdattper" filterable placeholder="T. Personal">
                            <el-option v-for="personal in tthdattper" :key="personal.tadconcorr" :label="personal.tadcondesc" :value="personal.tadconcorr"></el-option>
                        </el-select>
                        <div v-if="$store.state.errors['trabajador.tthdattper']" class="TextInvalid">{{ $store.state.errors['trabajador.tthdattper'][0] }}</div>
                    </mdb-col>
                    <mdb-col class="col-4 py-0 my-2">
                        <el-select class="SelectStyle" size="mini" v-model="Formulario.trabajador.tthdattcon" filterable placeholder="T. Contrato">
                            <el-option v-for="contrato in tthdattcon" :key="contrato.tadconcorr" :label="contrato.tadcondesc" :value="contrato.tadconcorr"></el-option>
                        </el-select>
                        <div v-if="$store.state.errors['trabajador.tthdattcon']" class="TextInvalid">{{ $store.state.errors['trabajador.tthdattcon'][0] }}</div>
                    </mdb-col>
                </mdb-row>
                <mdb-row class="">
                    <mdb-col class="col-4 py-0 my-2">
                        <el-select class="SelectStyle" size="mini" v-model="Formulario.trabajador.tthdatgere" filterable placeholder="Gerencia">
                            <el-option v-for="gerencia in tthdatgere" :key="gerencia.tadconcorr" :label="gerencia.tadcondesc" :value="gerencia.tadconcorr"></el-option>
                        </el-select>
                        <div v-if="$store.state.errors['trabajador.tthdatgere']" class="TextInvalid">{{ $store.state.errors['trabajador.tthdatgere'][0] }}</div>
                    </mdb-col>
                    <mdb-col class="col-4 py-0 my-2">
                        <el-select class="SelectStyle" size="mini" v-model="Formulario.trabajador.tthdatdepa" filterable placeholder="Departamento">
                            <el-option v-for="departamento in tthdatdepa" :key="departamento.tadconcorr" :label="departamento.tadcondesc" :value="departamento.tadconcorr"></el-option>
                        </el-select>
                        <div v-if="$store.state.errors['trabajador.tthdatdepa']" class="TextInvalid">{{ $store.state.errors['trabajador.tthdatdepa'][0] }}</div>
                    </mdb-col>
                    <mdb-col class="col-4 py-0 my-2">
                        <el-select class="SelectStyle" size="mini" v-model="Formulario.trabajador.tthdattare" filterable placeholder="Tipo de Area">
                            <el-option v-for="area in tthdattare" :key="area.tadconcorr" :label="area.tadcondesc" :value="area.tadconcorr"></el-option>
                        </el-select>
                        <div v-if="$store.state.errors['trabajador.tthdattare']" class="TextInvalid">{{ $store.state.errors['trabajador.tthdattare'][0] }}</div>
                    </mdb-col>
                </mdb-row>
                <mdb-row class="">
                    <mdb-col class="col-4 py-0 my-2">
                        <el-select class="SelectStyle" size="mini" v-model="Formulario.trabajador.tthdatgrup" filterable placeholder="Grupo">
                            <el-option v-for="grupo in tthdatgrup" :key="grupo.tadconcorr" :label="grupo.tadcondesc" :value="grupo.tadconcorr"></el-option>
                        </el-select>
                        <div v-if="$store.state.errors['trabajador.tthdatgrup']" class="TextInvalid">{{ $store.state.errors['trabajador.tthdatgrup'][0] }}</div>
                    </mdb-col>
                    <mdb-col class="col-4 py-0 my-2">
                        <el-select class="SelectStyle" size="mini" v-model="Formulario.trabajador.tthdatnive" filterable placeholder="Nivel">
                            <el-option v-for="nivel in tthdatnive" :key="nivel.tadconcorr" :label="nivel.tadcondesc" :value="nivel.tadconcorr"></el-option>
                        </el-select>
                        <div v-if="$store.state.errors['trabajador.tthdatnive']" class="TextInvalid">{{ $store.state.errors['trabajador.tthdatnive'][0] }}</div>
                    </mdb-col>
                    <mdb-col class="col-4 py-0 my-2">
                        <el-select class="SelectStyle" size="mini" v-model="Formulario.trabajador.tthdatcate" filterable placeholder="Categoria">
                            <el-option v-for="categoria in tthdatcate" :key="categoria.tadconcorr" :label="categoria.tadcondesc" :value="categoria.tadconcorr"></el-option>
                        </el-select>
                        <div v-if="$store.state.errors['trabajador.tthdatcate']" class="TextInvalid">{{ $store.state.errors['trabajador.tthdatcate'][0] }}</div>
                    </mdb-col>
                </mdb-row>
                <mdb-row class="">
                    <mdb-col class="col-4 py-0 my-2">
                        <el-select class="SelectStyle" size="mini" v-model="Formulario.trabajador.tthdatosbs" filterable placeholder="OFICINA SBS">
                            <el-option v-for="pago in tthpgptdes" :key="pago.tadconcorr" :label="pago.tadcondesc" :value="pago.tadconcorr"></el-option>
                        </el-select>
                        <div v-if="$store.state.errors['trabajador.tthdatosbs']" class="TextInvalid">{{ $store.state.errors['trabajador.tthdatosbs'][0] }}</div>
                    </mdb-col> 
                    <mdb-col class="col-8">
                        <mdb-input class="py-0 my-1" v-model="Formulario.trabajador.tthdatncar" placeholder="" size="sm" type="text" label="NOMBRE DEL PUESTO" outline/>
                        <div v-if="$store.state.errors['trabajador.tthdatncar']" class="TextInvalid">{{ $store.state.errors['trabajador.tthdatncar'][0] }}</div>
                    </mdb-col>
                </mdb-row>
                <mdb-card-title><strong>Datos Pensiones</strong></mdb-card-title>
                <mdb-row class="">
                    <mdb-col class="col-4 py-0 my-2">
                        <el-select class="SelectStyle" size="mini" show-message="true" v-model="Formulario.trabajador.tthdatspen" filterable placeholder="SISTEMA DE PENSIONES">
                            <el-option v-for="pension in tthdatspen" :key="pension.tadconcorr" :label="pension.tadcondesc" :value="pension.tadconcorr"></el-option>
                        </el-select>
                        <div v-if="$store.state.errors['trabajador.tthdatspen']" class="TextInvalid">{{ $store.state.errors['trabajador.tthdatspen'][0] }}</div>
                    </mdb-col> 
                    <mdb-col class="col-8">
                        <mdb-input class="py-0 my-1" v-model="Formulario.trabajador.tthdatcusp" placeholder="" size="sm" type="text" label="CUSPP" outline/>
                        <div v-if="$store.state.errors['trabajador.tthdatcusp']" class="TextInvalid">{{ $store.state.errors['trabajador.tthdatcusp'][0] }}</div>
                    </mdb-col>
                </mdb-row>
                <mdb-card-title><strong>Datos Remuneracion</strong></mdb-card-title>
                <mdb-row class="">
                    <mdb-col class="col-2 py-0 my-2">
                        <el-select class="SelectStyle" size="mini" v-model="Formulario.pago.tthpgptdes" filterable placeholder="TIPO">
                            <el-option v-for="pago in tthpgptdes" :key="pago.tadconcorr" :label="pago.tadcondesc" :value="pago.tadconcorr"></el-option>
                        </el-select>
                        <div v-if="$store.state.errors['pago.tthpgptdes']" class="TextInvalid">{{ $store.state.errors['pago.tthpgptdes'][0] }}</div>
                    </mdb-col> 
                    <mdb-col class="col-4 py-0 my-2">
                        <el-select class="SelectStyle" v-model="Formulario.pago.tthpgpcent" size="mini" filterable placeholder="ENTIDAD">
                            <el-option v-for="pago in tthpgptdes" :key="pago.tadconcorr" :label="pago.tadcondesc" :value="pago.tadconcorr"></el-option>
                        </el-select>
                        <div v-if="$store.state.errors['pago.tthpgpcent']" class="TextInvalid">{{ $store.state.errors['pago.tthpgpcent'][0] }}</div>
                    </mdb-col> 
                    <mdb-col class="col-6 py-0 my-2">
                        <el-select class="SelectStyle" v-model="Formulario.pago.tthpgpcnta" size="mini" filterable placeholder="CUENTA AHORROS">
                            <el-option v-for="pago in tthpgptdes" :key="pago.tadconcorr" :label="pago.tadcondesc" :value="pago.tadconcorr"></el-option>
                        </el-select>
                        <div v-if="$store.state.errors['pago.tthpgpcnta']" class="TextInvalid">{{ $store.state.errors['pago.tthpgpcnta'][0] }}</div>
                    </mdb-col>
                </mdb-row>
                <mdb-row class="">
                    <mdb-col class="col-3 py-0 my-2">
                        <el-select class="SelectStyle" size="mini" v-model="Formulario.pago.tthpgpfpag" filterable placeholder="FRECUENCIA DE PAGO">
                            <el-option v-for="formaspago in tthpgpfpag" :key="formaspago.tadconcorr" :label="formaspago.tadcondesc" :value="formaspago.tadconcorr"></el-option>
                        </el-select>
                        <div v-if="$store.state.errors['pago.tthpgpfpag']" class="TextInvalid">{{ $store.state.errors['pago.tthpgpfpag'][0] }}</div>
                    </mdb-col> 
                    <mdb-col class="col-3">
                        <mdb-input class="py-0 my-1" v-model="Formulario.pago.tthpgpsbas" placeholder="" size="sm" type="number" label="SUELDO BASICO (S./)" outline/>
                        <div v-if="$store.state.errors['pago.tthpgpsbas']" class="TextInvalid">{{ $store.state.errors['pago.tthpgpsbas'][0] }}</div>
                    </mdb-col> 
                    <mdb-col class="col-3 py-0 my-1 text-center">
                        <div class="custom-control custom-switch">
                            <input type="checkbox" class="custom-control-input" id="customSwitches1" v-model="Formulario.pago.tthpgpr5ta">
                            <label class="custom-control-label" for="customSwitches1">Renta de Quinta</label>
                        </div>
                    </mdb-col>
                    <mdb-col class="col-2 py-0 my-1">
                        <div class="custom-control custom-switch">
                            <input type="checkbox" class="custom-control-input" id="customSwitches2" v-model="Formulario.pago.tthpgpafam">
                            <label class="custom-control-label" for="customSwitches2">Asig. Familiar</label>
                        </div>
                    </mdb-col>
                    <mdb-col class="col-1 py-0 my-1">
                        <div class="custom-control custom-switch">
                            <input type="checkbox" class="custom-control-input" id="customSwitches3" v-model="Formulario.pago.tthpgpseps">
                            <label class="custom-control-label" for="customSwitches3">EPS</label>
                        </div>
                    </mdb-col>
                </mdb-row>
                <mdb-card-title><strong>Datos Bonos</strong></mdb-card-title>
                <mdb-row class="">
                    <mdb-col class="col-4 py-0 my-1 offset-2">
                        <el-select ref="cmbBono" class="SelectStyle" size="mini" v-model="Formulario.bono" filterable placeholder="SELECCIONAR BONO">
                            <el-option v-for="bono in bonos" :key="bono.tadconcorr" :label="bono.tadcondesc" :value="bono.tadconcorr"></el-option>
                        </el-select>
                    </mdb-col> 
                    <mdb-col class="col-3">
                        <mdb-input class="py-0 my-0" v-model="Formulario.txtbono" placeholder="" size="sm" type="number" label="BONO" outline/>
                    </mdb-col>
                    <mdb-col class="col-1">
                        <mdb-btn @click="abonar($refs.cmbBono)" outline="primary" size="sm" class="mt-0 BotonEstilo"><mdb-icon icon="plus"/></mdb-btn>
                    </mdb-col>
                    <mdb-col class="col-8 py-0 my-1 offset-2 text-center">
                        <div v-if="$store.state.errors.bonos" class="TextInvalid">{{ $store.state.errors.bonos[0] }}</div>
                        <table class="table table-sm table-hover">
                            <thead>
                                <tr>
                                    <th width="10%" scope="col">#</th>
                                    <th width="60%" scope="col">BONO</th>
                                    <th width="20%" scope="col">MONTO</th>
                                    <th width="10%" scope="col">ACCIONES</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(fila, index) in Formulario.bonos" :key="index">
                                    <td class="py-0 my-0">{{ index + 1 }}</td>
                                    <td class="py-0 my-0">{{ fila.texto }}</td>
                                    <td class="py-0 my-0">{{ fila.tthbonmont }}</td>
                                    <td class="py-0 my-0"><mdb-btn @click="eliminarCelda(index)" outline="danger" size="sm" class="BotonEstilo"><mdb-icon icon="trash"/></mdb-btn></td>
                                </tr>
                            </tbody>
                        </table>
                    </mdb-col>
                </mdb-row>
            </mdb-col>
        </mdb-container>

        <ModalGbage ref="datos" @llenarDatos="llenarDatos">
            <template #buttons>
                <loading-button
                    :loading="$store.state.processing"
                    :icon="'search'"
                    @click.native="buscarTrabajador"
                >
                    Buscar
                </loading-button>
            </template>
        </ModalGbage>
    </form>
</template>

<script>
import LoadingButton from '../../../../Components/LoadingButton'
import ModalGbage from '../../../../Modals/MO113/ME1/SM3/ModalGbage'
export default {
    name: "TthpgpForm",
    components: {
        ModalGbage,
        LoadingButton
    },
    props: {
        Formulario: Object,
        opciones: Array,
        modal: Object
    },
    data() {
        return {
            tthdattcol: [],
            tthdattper: [], 
            tthdattcon: [], 
            tthdatgere: [], 
            tthdatdepa: [],
            tthdattare: [],
            tthdatgrup: [], 
            tthdatnive: [], 
            tthdatcate: [], 
            tthdatspen: [], 
            tthpgptdes: [],
            tthpgpfpag: [],
            bonos: []
        }
    },
    created() {
        this.tthdattcol = this.opciones.filter(colaborador => colaborador.tadconpref == 8); 
        this.tthdattper = this.opciones.filter(personal => personal.tadconpref == 9); 
        this.tthdattcon = this.opciones.filter(contrato => contrato.tadconpref == 10); 
        this.tthdatgere = this.opciones.filter(gerencia => gerencia.tadconpref == 11); 
        this.tthdatdepa = this.opciones.filter(departamento => departamento.tadconpref == 12); 
        this.tthdattare = this.opciones.filter(area => area.tadconpref == 13); 
        this.tthdatgrup = this.opciones.filter(grupo => grupo.tadconpref == 14); 
        this.tthdatnive = this.opciones.filter(nivel => nivel.tadconpref == 15); 
        this.tthdatcate = this.opciones.filter(categoria => categoria.tadconpref == 16); 
        this.tthdatspen = this.opciones.filter(pension => pension.tadconpref == 17);
        this.tthpgptdes = this.opciones.filter(pago => pago.tadconpref == 18);
        this.tthpgpfpag = this.opciones.filter(formaspago => formaspago.tadconpref == 19);
        this.bonos = this.opciones.filter(bono => bono.tadconpref == 20);
    },
    methods: {
        buscarTrabajador: function() {
            this.$refs.datos.handleCurrentChange(0);
        },
        traerDatosTrabajador: function() {
            this.$store.state.showModal = true;
            this.$refs.datos.handleCurrentChange(0);  
        },
        llenarDatos: function(data) {
            this.$store.state.showModal = false;
            this.Formulario.trabajador.tthdatcage = data.trab.gbagecage;
            this.modal.nombre = data.trab.gbagenomb;
            this.modal.nombre = data.trab.gbagenomb;
            this.modal.dni = data.trab.gbagendid;
            this.modal.usuario = data.trab.adusrusrn;
            this.modal.codAgencia = data.trab.gbagecage;
            this.modal.estado = data.trab.adusrstat;
            this.modal.perfil = data.trab.adusrnomb;
            this.modal.agencia = data.trab.adagndesc;
            this.modal.fechaIngreso = data.trab.gbagenomb;
            this.modal.fechaReingreso = data.trab.gbagenomb;
            this.modal.fechaCese = data.trab.gbagenomb;
        },
        abonar: function(abono) { 
            if(this.Formulario.bono == null || this.Formulario.txtbono == '')
                return false;

            this.Formulario.bonos.push({ tthbonitem :this.Formulario.bono, texto: abono.selectedLabel, tthbonmont: this.Formulario.txtbono });
            this.Formulario.txtbono = '',
            this.Formulario.bono = null
        },
        eliminarCelda(row) {
            this.$delete(this.Formulario.bonos, row);
        }
    }
};
</script>