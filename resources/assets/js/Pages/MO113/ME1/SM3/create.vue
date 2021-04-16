<template>
    <dashboard-template>
        <template #cabecera>
            <div class="navbar-container">
                <div class="row">
                    <div class="col-12">
                        <h2 class="content-header-title float-left mb-0">1 - Modulo General</h2>
                        <div class="breadcrumb-wrapper">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#">1 - Clientes</a>
                                </li>
                                <li class="breadcrumb-item active">1 - Registro de Clientes
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-10">
                        <div class="demo-inline-spacing">
                            <loading-button :loading="$store.state.processing" :icon="'add'">Nuevo</loading-button>
                            <loading-button :loading="$store.state.processing" :icon="'save'" @click.native="submit">Guardar</loading-button>
                            <loading-button :loading="$store.state.processing" :icon="'edit'">Modificar</loading-button>
                            <loading-button :loading="$store.state.processing" :icon="'delete'">Eliminar</loading-button>
                            <loading-button :loading="$store.state.processing" :icon="'close'">Cerrar</loading-button>
                        </div>
                    </div>
                    <div class="col-2">
                        <ul class="nav navbar-nav align-items-center ml-auto">
                            <li class="nav-item d-none d-lg-block"><a class="nav-link nav-link-style"><i class="ficon" data-feather="moon"></i></a></li>
                            <li class="nav-item nav-search"><a class="nav-link nav-link-search"><i class="ficon" data-feather="search"></i></a>
                                <div class="search-input">
                                    <div class="search-input-icon"><i data-feather="search"></i></div>
                                    <input class="form-control input" type="text" placeholder="Explore Vuexy..." tabindex="-1" data-search="search">
                                    <div class="search-input-close"><i data-feather="x"></i></div>
                                    <ul class="search-list search-list-main"></ul>
                                </div>
                            </li>  
                        </ul>
                    </div>
                </div>
            </div>
        </template>
        <template #main>
            <TthdatForm :opciones="opciones" :Formulario="Formulario" :modal="modal" :oficinasbs="oficinasbs" :datos="datos"></TthdatForm>
        </template>
    </dashboard-template>
</template>

<script>

import mapValues from "lodash/mapValues"
import LoadingButton from '../../../../Components/LoadingButton'
import DashboardTemplate from './../../../DashboardTemplate'
import TthdatForm from '../../../../Forms/MO113/ME1/SM3/TthdatForm'

export default {
	name: "MO113ME1SM3CreateLayout",
	components: {
        LoadingButton,
        DashboardTemplate,
        TthdatForm 
    },
    props:
    { 
        opciones: Array,
        oficinasbs: Array
    },
    data() {
        return {
            usuarios: [],
            processing: false,
            Formulario: {
                trabajador: {
                    tthdatcage: null,
                    tthdattcol: null,
                    tthdattper: null, 
                    tthdattcon: null, 
                    tthdatgere: null, 
                    tthdatdepa: null,
                    tthdattare: null,
                    tthdatgrup: null, 
                    tthdatnive: null, 
                    tthdatcate: null, 
                    tthdatspen: null,
                    tthdatosbs: null,
                    tthdatncar: '',
                    tthdatcusp: ''
                },
                pago: {
                    tthpgptdes: null,
                    tthpgpcent: null,
                    tthpgpcnta: null,
                    tthpgpcnti: '',
                    tthpgpfpag: null,
                    tthpgpsbas: '',
                    tthpgpr5ta: false,
                    tthpgpafam: false,
                    tthpgpseps: false
                },
                bono: null,
                txtbono: '',
                bonos: []
            },
            modal: {
                nombre: '',
                dni: '',
                usuario: '',
                codAgencia: '',
                estado: '',
                perfil: '',
                agencia: '',
                fechaIngreso: '',
                fechaReingreso: '',
                fechaCese: ''
            },
            datos: {
                estado: null,
                busqueda: {}
            }
        };
    },
    methods: {
        submit: function() {
            this.$store.state.processing = true;
            axios.post(this.route('programa.store'), this.Formulario)
            .then(() => {
                this.limpiarFormulario();
                this.$notify({
                    title: 'Se Guardo Con Exito',
                    message: 'Se Registro Satisfactoriamente',
                    type: 'success',
                    duration: 3000,
                    offset: 50
                });
                this.$store.state.processing = false;
            });
        },
        limpiarFormulario: function() {
            this.Formulario.trabajador.tthdatcage = null;
            this.Formulario.trabajador.tthdattcol = null;
            this.Formulario.trabajador.tthdattper = null;
            this.Formulario.trabajador.tthdattcon = null;
            this.Formulario.trabajador.tthdatgere = null;
            this.Formulario.trabajador.tthdatdepa = null;
            this.Formulario.trabajador.tthdattare = null;
            this.Formulario.trabajador.tthdatgrup = null;
            this.Formulario.trabajador.tthdatnive = null;
            this.Formulario.trabajador.tthdatcate = null;
            this.Formulario.trabajador.tthdatspen = null;
            this.Formulario.trabajador.tthdatosbs = null;
            this.Formulario.trabajador.tthdatncar = '';
            this.Formulario.trabajador.tthdatcusp = '';
            this.Formulario.trabajador.tthdatestd = 1;
            this.Formulario.trabajador.tthdatmrcb = 0;
            this.Formulario.trabajador.tthdatfpro = '2021-03-24';
            this.Formulario.trabajador.tthdatfreg = '2021-03-24';
            this.Formulario.trabajador.tthdathora = '01:52:19';
            this.Formulario.trabajador.tthdatusrn = 'GCENTENO';
            this.modal = mapValues(this.modal, () => '');
            this.Formulario.pago.tthpgptdes = null;
            this.Formulario.pago.tthpgpcent = null;
            this.Formulario.pago.tthpgpcnti = null;
            this.Formulario.pago.tthpgpcnta = '';
            this.Formulario.pago.tthpgpfpag = null;
            this.Formulario.pago.tthpgpsbas = '';
            this.Formulario.pago.tthpgpr5ta = false;
            this.Formulario.pago.tthpgpafam = false;
            this.Formulario.pago.tthpgpseps = false;
            this.Formulario.bonos = [];
            this.Formulario.txtbono = '',
            this.Formulario.bono = null
        }
    },
    mounted() {
        
    },
    created() {
        // $.app.menu.changeMenu();
        // $.app.menu.changeMenu('xl');
        this.$store.state.fullscreenLoading = false;
    },
};

</script>