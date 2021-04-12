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
            <ExportarForm :form="form"></ExportarForm>
        </template>
    </dashboard-template>
</template>

<script>

import LoadingButton from '../../../../Components/LoadingButton'
import DashboardTemplate from './../../../DashboardTemplate'
import ExportarForm from '../../../../Forms/MO113/ME5/SM1/ExportarForm'

export default {
	name: "MO113ME5SM1IndexLayout",
	components: {
        LoadingButton,
        DashboardTemplate,
        ExportarForm
    },
    data() {
        return {
            form:{
                radio: null
            }
        };
    },
    methods: {
       exportarReporte: function() {
           if(this.form.radio == null)
           {
                this.$notify({
                    title: 'Ocurrio Un Problema',
                    message: 'Debe Seleccionar Un Tipo',
                    type: 'error',
                    duration: 3000,
                    offset: 50
                });
                return false;
           }

            this.$store.state.processing = true;
            axios.post(this.route('fth5001.store'), this.form, {responseType: 'blob'})
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
                    link.setAttribute('download', 'DescuentosCredInterno.xlsx');
                    document.body.appendChild(link);
                    link.click();   
                }
                this.form.radio = null;
                this.$store.state.processing = false;
            });
       }
    }
};

</script>