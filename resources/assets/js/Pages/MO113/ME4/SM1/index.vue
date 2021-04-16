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
                            <loading-button :loading="$store.state.processing" :icon="'article'" @click.native="limpiarData">Nuevo</loading-button>
                            <loading-button :loading="$store.state.processing" :icon="'print'" @click.native="exportarReporte">Exportar</loading-button>
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
            <ExportarForm :form="form" :plazas="plazas" :agencias="agencias" :datos="datos"></ExportarForm>
        </template>
    </dashboard-template>
</template>

<script>

import LoadingButton from '../../../../Components/LoadingButton'
import DashboardTemplate from './../../../DashboardTemplate'
import ExportarForm from '../../../../Forms/MO113/ME4/SM1/ExportarForm'

export default {
	name: "MO113ME4SM1IndexLayout",
	components: {
        LoadingButton,
        DashboardTemplate,
        ExportarForm
    },
    props: {
        plazas: Array,
        agencias: Array
    },
    data() {
        return {
            form:{
                chbopciones: [],
                plazainicial: null,
                plazafinal: null,
                agenciainicial: null,
                agenciafinal: null,
                tipo: null,
                principal: false,
                flag: true,
                gbagecage: null,
                nombre: null,
                dni: null,
                flagplaza: true,
                flagagencia: true,
                rdobloque: null
            },
            datos: {
                estado: null,
                busqueda: {}
            }
        };
    },
    methods: {
       limpiarData: function() {
            this.form.chbopciones = [];
            this.form.principal = false;
            this.form.tipo = '',
            this.datos.estado = '';
            this.form.plazainicial = null;
            this.form.plazafinal = null;
            this.form.agenciainicial = null;
            this.form.agenciafinal = null;
            this.form.nombre = null;
            this.form.dni = null;
            this.form.flag = true;
            this.form.flagplaza = true;
            this.form.flagagencia = true;
            this.form.rdobloque = null;
       },
       exportarReporte: function() {
           console.log(this.form.chbopciones.length);
           if(this.form.tipo == '' || this.form.tipo == null)
           {
                this.$notify({
                    title: 'Alerta',
                    message: 'Debe Seleccionar Un Tipo Reporte',
                    type: 'warning',
                    duration: 3000,
                    offset: 50
                });
                return false;
           }

           if(this.datos.estado == '' || this.datos.estado == null)
           {
                this.$notify({
                    title: 'Alerta',
                    message: 'Debe Seleccionar El Estado del Trabajador',
                    type: 'warning',
                    duration: 3000,
                    offset: 50
                });
                return false;
           }

           if(this.form.chbopciones.length == 0)
           {
                this.$notify({
                    title: 'Alerta',
                    message: 'Debe Seleccionar Una Opcion',
                    type: 'warning',
                    duration: 3000,
                    offset: 50
                });
                return false;
           }

            this.$store.state.processing = true;
            this.$set(this.form, 'est', this.datos.estado);
            axios.post(this.route('fth5000.store'), this.form, {responseType: 'blob'})
            .then(response => {
                if(response.data.type == 'text/html')
                {
                    this.$notify({
                        title: 'No Se Encontraron Datos',
                        message: 'Reporte No Generado',
                        type: 'warning',
                        duration: 3000,
                        offset: 50
                    });
                }
                else
                {
                    const url = window.URL.createObjectURL(new Blob([response.data]));
                    const link = document.createElement('a');
                    link.href = url;
                    link.setAttribute('download', 'DATOSPERSONALFONDESURCO.xlsx');
                    document.body.appendChild(link);
                    link.click();   
                }
                this.limpiarData();
                this.$store.state.processing = false;
            });
       }
    }
};

</script>