<template>
<h1>asdasd</h1>
    <!-- <dashboard-layout>
        <template #main>
            <TthpgpForm :opciones="opciones" :Formulario="Formulario" :modal="modal">
                <template #buttons>
                    <loading-button :loading="$store.state.processing" :icon="'file'">Nuevo</loading-button>
                    <loading-button :loading="$store.state.processing" :icon="'save'" @click.native="submit">Guardar</loading-button>
                    <loading-button :loading="$store.state.processing" :icon="'edit'">Modificar</loading-button>
                    <loading-button :loading="$store.state.processing" :icon="'trash'">Eliminar</loading-button>
                    <loading-button :loading="$store.state.processing" :icon="'trash'">Cerrar</loading-button>
                </template>
            </TthpgpForm>

            <zingchart :data="chartData"></zingchart>
            <table class="table table-hover" id="sample">
                <thead>
                    <tr>
                    <th scope="col">#</th>
                    <th scope="col">First</th>
                    <th scope="col">Last</th>
                    <th scope="col">Handle</th>
                    </tr>
                </thead>
                <!-- <tbody>
                    <tr v-for="user in usuarios" :key="user.gbagecage">
                        <td>{{ user.gbagecage }}</td>
                        <td>{{ user.gbagendid }}</td>
                        <td>{{ user.gbagenomb }}</td>
                        <td>{{ user.gbagedir1 }}</td>
                    </tr>
                </tbody> -->
            </table>
        </template>
    </dashboard-layout> -->
</template>

<script>

import mapValues from "lodash/mapValues"
import LoadingButton from '../../../../Components/LoadingButton'
import TthpgpForm from '../../../../Forms/MO113/ME1/SM3/TthpgpForm'
import zingchartVue from 'zingchart-vue';

export default {
	name: "MO113ME1SM3Layout",
	components: {
        zingchart: zingchartVue,
        LoadingButton,
        DashboardLayout,
        TthpgpForm 
    },
    props:
    { 
        opciones: Array
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
            chartData: {
                type: "pie",
                plot: {
                    borderColor: "#2B313B",
                    borderWidth: 5,
                    // slice: 90,
                    valueBox: {
                    placement: 'out',
                    text: '%t\n%npv%',
                    fontFamily: "Open Sans"
                    },
                    tooltip: {
                    fontSize: '18',
                    fontFamily: "Open Sans",
                    padding: "5 10",
                    text: "%npv%"
                    },
                    animation: {
                    effect: 2,
                    method: 5,
                    speed: 900,
                    sequence: 1,
                    delay: 1000
                    }
                },
                source: {
                    text: 'gs.statcounter.com',
                    fontColor: "#8e99a9",
                    fontFamily: "Open Sans"
                },
                title: {
                    fontColor: "#8e99a9",
                    text: 'Global Browser Usage',
                    align: "left",
                    offsetX: 10,
                    fontFamily: "Open Sans",
                    fontSize: 25
                },
                subtitle: {
                    offsetX: 10,
                    offsetY: 10,
                    fontColor: "#8e99a9",
                    fontFamily: "Open Sans",
                    fontSize: "16",
                    text: 'May 2016',
                    align: "left"
                },
                 plotarea: {
                    margin: "20 0 0 0"
                },
                series: [
                    {
                        values: [11.38],
                        text: "Internet Explorer",
                        backgroundColor: '#50ADF5',
                    },
                    {
                        values: [56.94],
                        text: "Chrome",
                        backgroundColor: '#FF7965',
                        detached: true
                    },
                    {
                        values: [24.4],
                        text: 'Firefox',
                        backgroundColor: '#FFCB45',
                        detached: true
                    },
                    {
                        text: 'Safari',
                        values: [9.69],
                        backgroundColor: '#6877e5'
                    },
                    {
                        text: 'Other',
                        values: [7.48],
                        backgroundColor: '#6FB07F'
                    }
                ]
            }
        };
    },
    methods: {
        // getUsuarios: function() {
        //     axios.get('pruebas').then( rspta => {
        //         $("#sample").DataTable({
        //             data: rspta.data,
        //             columns: [
        //                 { data: 'gbagecage' },
        //                 { data: 'gbagenomb' },
        //                 { data: 'gbagendid' },
        //                 { data: 'gbagedir1' }
        //             ]
        //         });
        //     });
        // },
        getUsuarios: function() {
            axios.get('pruebas').then( rspta => {
                this.usuarios = rspta.data;
                this.$datatbleGlobal('#sample');
            });
        },
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
            this.Formulario.pago.tthpgpcnta = null;
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
        this.$datatbleGlobal('#sample');
        //this.getUsuarios();
    },
    created() {
        this.$store.state.fullscreenLoading = false;
    },
};

</script>