<template>
    <div class="content-wrapper mt-3">
        <form>
        <div class="content-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Reporte Datos Trabajador</h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-6">
                                    <table class="table table-sm table-bordered">
                                        <thead class="thead-dark">
                                            <tr>
                                                <th width="100%" colspan="2" scope="col" class="text-center">Tipo Reporte</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td class="py-0 my-0">
                                                    <div class="custom-control custom-radio">
                                                        <input type="radio" id="rdoespecifico" name="rdotipo" class="custom-control-input" value="1" v-model="form.tipo" @change="seleccionarTipo($event)"/>
                                                        <label class="custom-control-label" for="rdoespecifico">Especifico</label>
                                                    </div>
                                                </td>
                                                <td class="py-0 my-0">
                                                    <div class="custom-control custom-radio">
                                                        <input type="radio" id="rdobloque" name="rdotipo" class="custom-control-input" value="2" v-model="form.tipo" @change="seleccionarTipo($event)"/>
                                                        <label class="custom-control-label" for="rdobloque">Bloque</label>
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="col-6">
                                    <table class="table table-sm table-bordered">
                                        <thead class="thead-dark">
                                            <tr>
                                                <th width="100%" colspan="2" scope="col" class="text-center">Estado Trabajador</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td class="py-0 my-0">
                                                    <div class="custom-control custom-radio">
                                                        <input type="radio" id="rdoactivo" name="rdoestado" class="custom-control-input" value="1" v-model="datos.estado"/>
                                                        <label class="custom-control-label" for="rdoactivo">Activo</label>
                                                    </div>
                                                </td>
                                                <td class="py-0 my-0">
                                                    <div class="custom-control custom-radio">
                                                        <input type="radio" id="rdocesado" name="rdoestado" class="custom-control-input" value="0" v-model="datos.estado"/>
                                                        <label class="custom-control-label" for="rdocesado">Cesado</label>
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div v-if="form.tipo == 1" class="row pt-2">
                                <div class="col-8">
                                    <div class="form-group">
                                        <div class="input-group input-group-merge form-label-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text form-control-sm"><i class="material-icons">person</i></span>
                                            </div>
                                            <input type="text" class="form-control form-control-sm" placeholder="NOMBRE" v-model="form.nombre" disabled/>
                                            <label for="nombre"><b>NOMBRE</b></label>
                                            <div class="input-group-prepend">
                                                <button data-backdrop="false" type="button" @click="traerDatosTrabajador" class="btn btn-sm btn-relief-primary btn-icon"><i class="material-icons BtnSm">search</i></button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group">
                                        <div class="input-group input-group-merge form-label-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text form-control-sm"><i class="material-icons">text_snippet</i></span>
                                            </div>
                                            <input type="text" class="form-control form-control-sm" placeholder="DNI" v-model="form.dni" disabled/>
                                            <label for="dni"><b>DNI</b></label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div v-if="form.tipo == 2" class="row pt-2">
                                <div class="col-12">
                                    <table class="table table-sm table-bordered">
                                        <thead class="thead-dark">
                                            <tr>
                                                <th width="100%" colspan="4" scope="col" class="text-center">Seleccionar Tipo de Bloque</th>
                                            </tr>
                                            <tr>
                                                <td width="50%" colspan="2" scope="col" class="text-left">
                                                    <div class="custom-control custom-radio">
                                                        <input type="radio" id="rdooptplz" name="rdoopcionesbloque" class="custom-control-input" value="1" @change="seleccionarBloque($event)" v-model="form.rdobloque"/>
                                                        <label class="custom-control-label" for="rdooptplz">Por Plaza</label>
                                                    </div>
                                                </td>
                                                <td width="50%" colspan="2" scope="col" class="text-left">
                                                    <div class="custom-control custom-radio">
                                                        <input type="radio" id="rdooptagn" name="rdoopcionesbloque" class="custom-control-input" value="2" @change="seleccionarBloque($event)" v-model="form.rdobloque"/>
                                                        <label class="custom-control-label" for="rdooptagn">Por Agencia</label>
                                                    </div>
                                                </td>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td class="pt-1 my-0">
                                                    <div class="form-group">
                                                        <el-select class="SelectStyle" size="mini" show-message="true" v-model="form.plazainicial" filterable placeholder="PLAZA INICIAL" :disabled="form.flagplaza" @change="cambiarEstadoCombos($event)">
                                                            <el-option v-for="plaza in plazas" :key="plaza.gbconcorr" :label="plaza.gbcondesc" :value="plaza.gbconcorr"></el-option>
                                                        </el-select>
                                                        <!-- <div v-if="$store.state.errors['trabajador.tthdatspen']" class="TextInvalid">{{ $store.state.errors['trabajador.tthdatspen'][0] }}</div> -->
                                                    </div>
                                                </td>
                                                <td class="pt-1 my-0">
                                                    <div class="form-group">
                                                        <el-select class="SelectStyle" size="mini" show-message="true" v-model="form.plazafinal" filterable placeholder="PLAZA FINAL" :disabled="form.flagplaza">
                                                            <el-option :disabled="parseInt(plaza.gbconcorr) < parseInt(valoractual)" v-for="plaza in plazas" :key="plaza.gbconcorr" :label="plaza.gbcondesc" :value="plaza.gbconcorr"></el-option>
                                                        </el-select>
                                                        <!-- <div v-if="$store.state.errors['trabajador.tthdatspen']" class="TextInvalid">{{ $store.state.errors['trabajador.tthdatspen'][0] }}</div> -->
                                                    </div>
                                                </td>
                                                <td class="pt-1 my-0">
                                                    <div class="form-group">
                                                        <el-select class="SelectStyle" size="mini" show-message="true" v-model="form.agenciainicial" filterable placeholder="AGENCIA INICIAL" :disabled="form.flagagencia" @change="cambiarEstadoCombos($event)">
                                                            <el-option v-for="agencia in agencias" :key="agencia.adagnagen" :label="agencia.adagndesc" :value="agencia.adagnagen"></el-option>
                                                        </el-select>
                                                        <!-- <div v-if="$store.state.errors['trabajador.tthdatspen']" class="TextInvalid">{{ $store.state.errors['trabajador.tthdatspen'][0] }}</div> -->
                                                    </div>
                                                </td>
                                                <td class="pt-1 my-0">
                                                    <div class="form-group">
                                                        <el-select class="SelectStyle" size="mini" show-message="true" v-model="form.agenciafinal" filterable placeholder="AGENCIA FINAL" :disabled="form.flagagencia">
                                                            <el-option :disabled="parseInt(agencia.adagnagen) < parseInt(valoractual)" v-for="agencia in agencias" :key="agencia.adagnagen" :label="agencia.adagndesc" :value="agencia.adagnagen"></el-option>
                                                        </el-select>
                                                        <!-- <div v-if="$store.state.errors['trabajador.tthdatspen']" class="TextInvalid">{{ $store.state.errors['trabajador.tthdatspen'][0] }}</div> -->
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="row pt-1">
                                <div class="col-6 offset-3">
                                    <div class="row">
                                        <div class="col-6 offset-3">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="chbopciones" @click="marcarOpciones()" v-model="form.principal" :disabled="form.flag"/>
                                                <label class="custom-control-label" for="chbopciones">Todas las Opciones</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row pt-1">
                                        <div v-for="(chc,index) in checks" :key="chc.id" class="col-4">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" @change='validarPrincipal()' :id="'chc'+index" v-model="form.chbopciones" :value="chc.id" :disabled="form.flag"/>
                                                <label class="custom-control-label" :for="'chc'+index">{{ chc.name }}</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" :class="{ show: $store.state.showModal }" :style=" $store.state.showModal ? $store.state.mostrarModal : $store.state.ocultarModal ">
            <ModalGbage ref="datos" @llenarDatos="llenarDatos" @buscarTrabajador="buscarTrabajador" :datatable="datatable" :detalle="detalle" :cabecera="cabecera">
                <template #buttons>
                    <loading-button
                        :loading="$store.state.processing"
                        :icon="'search'"
                    >
                        Buscar
                    </loading-button>
                </template>
            </ModalGbage>
        </div>
        </form>
    </div>
</template>

<script>
import ModalGbage from '../../../../Modals/MO113/ME1/SM3/ModalGbage'

export default {
	name: "MO113ME4SM1ExportarForm",
    components: {
        ModalGbage
    },
    props: { 
        form: Object,
        plazas: Array,
        agencias: Array,
        datos: Object
    },
    data() {
        return {
            checks: [ 
                { "id": "1", "name": "Personal" },
                { "id": "2", "name": "Laboral" },
                { "id": "3", "name": "Familiar" },
                { "id": "4", "name": "Direcciones" },
                { "id": "5", "name": "Remuneración" },
                { "id": "6", "name": "Contratos" }, 
                { "id": "7", "name": "Instrucción" }
            ],
            cabecera: ["#","NOMBRE","DNI","ACCIONES"],
            detalle: [
                { data: 'gbagecage', searchable: false },
                { data: 'gbagenomb' },
                { data: 'nrodoc', searchable: false },
                { data: 'action', name: 'action', orderable: false, searchable: false, class:'text-center' }
            ],
            datatable: {
                url: this.route('fth5000.show',0),
                data: {
                    tipo: 1,
                    parametros: this.datos
                }
            },
            valoractual: 0
        };
    },
    methods: {
        traerDatosTrabajador: function() {
            if(this.datos.estado == '' || this.datos.estado == null)
            {
                this.$notify({
                    title: 'Ocurrio Un Problema',
                    message: 'Debe Seleccionar Un Estado',
                    type: 'warning',
                    duration: 3000,
                    offset: 50
                });
                return false;
            }
            this.$refs.datos.crearTabla();
            this.$store.state.showModal = true;
        },
        marcarOpciones: function() {
            this.form.principal = !this.form.principal;
            this.form.chbopciones = [];
            if(this.form.principal) {
                for (var key in this.checks) {
                    this.form.chbopciones.push(this.checks[key].id);
                }
            }
        },
        validarPrincipal: function() {
            (this.form.chbopciones.length == this.checks.length) ? this.form.principal = true : this.form.principal = false;
        },
        seleccionarTipo: function(data) {
            this.form.tipo = data.target.value;
            this.form.gbagecage = null;
            this.form.nombre = null;
            this.form.dni = null; 
            this.bloque = true;
            this.form.flag = true;
            this.form.plazainicial = null;
            this.form.plazafinal = null;
            this.form.agenciainicial = null;
            this.form.agenciafinal = null;
        },
        llenarDatos: function(data,busqueda) {
            let datos = JSON.parse(data);
            this.form.gbagecage = datos.gbagecage;
            this.form.nombre = datos.gbagenomb;
            this.form.dni = datos.nrodoc;
            this.form.flag = false;
            this.$store.state.showModal = false;
        },
        buscarTrabajador: function(busqueda) {
            this.datos.busqueda = busqueda;
            this.$refs.datos.crearTabla();
        },
        seleccionarBloque: function(data) {
            if(data.target.value == 1){
                this.form.flagplaza = false;
                this.form.flagagencia = true
            }
            else{
                this.form.flagagencia = false
                this.form.flagplaza = true;
            }
            this.form.plazainicial = null;
            this.form.plazafinal = null;
            this.form.agenciainicial = null;
            this.form.agenciafinal = null;
        },
        cambiarEstadoCombos: function(data) {
            this.valoractual = data;
            this.form.flag = false;
            this.form.plazafinal = null;
            this.form.agenciafinal = null;
        }
    }
};

</script>