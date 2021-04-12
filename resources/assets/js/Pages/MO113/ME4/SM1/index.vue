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
                            <loading-button :loading="$store.state.processing" :icon="'article'">Nuevo</loading-button>
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
import ExportarForm from '../../../../Forms/MO113/ME4/SM1/ExportarForm'

export default {
	name: "MO113ME4SM1IndexLayout",
	components: {
        LoadingButton,
        DashboardTemplate,
        ExportarForm
    },
    data() {
        return {
            form:{
                chbopciones: []
            }
        };
    },
    methods: {
       exportarReporte: function() {
           
       }
    }
};

</script>