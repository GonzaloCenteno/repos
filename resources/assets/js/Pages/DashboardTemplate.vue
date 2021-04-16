<template>
    <div>
        <nav class="header-navbar navbar navbar-expand-lg align-items-center floating-nav navbar-light navbar-shadow">
            <slot name="cabecera"></slot>
        </nav>

        <div class="main-menu menu-fixed menu-light menu-accordion menu-shadow" data-scroll-to-active="true">
            <div class="navbar-header">
                <ul class="nav navbar-nav flex-row">
                    <li class="nav-item mr-auto"><a class="navbar-brand" href="#"><span class="material-icons">home</span>
                            <h2 class="brand-text">NetBank</h2>
                        </a></li>
                    <li class="nav-item nav-toggle"><a class="nav-link modern-nav-toggle pr-0" data-toggle="collapse"><i class="d-block d-xl-none text-primary toggle-icon font-medium-4" data-feather="x"></i><i class="d-none d-xl-block collapse-toggle-icon font-medium-4  text-primary" data-feather="disc" data-ticon="disc"></i></a></li>
                </ul>
            </div>
            <div class="shadow-bottom"></div>
            <div class="main-menu-content">
                <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
                    <li v-for="mod in $page.props.modulos" :key="mod.admodmodn" class=" nav-item"><a class="d-flex align-items-center" href="#"><i class="FondoNumero">{{ mod.admodmodn }}</i><span class="menu-title text-truncate" style="font-size: 0.8em !important" data-i18n="Menuasdas Levels" >{{ mod.admoddesc }}</span></a>
                        <ul class="menu-content">
                            <li v-for="(menu, index) in mod.admprs" :key="index"><a class="d-flex align-items-center" href="#"><i class="material-icons">panorama_fish_eye</i><span class="menu-item text-truncate" style="font-size: 0.8em !important" data-i18n="Second Level">{{ menu.admprdesc }}</span></a>
                                <ul class="menu-content">
                                    <li v-for="submenu in menu.admdts" :key="submenu.admdtmdtn">
                                        <inertia-link class="d-flex align-items-center" :href="route('programa.index')" @click="renderizar">
                                            <span class="menu-item text-truncate" style="font-size: 0.8em !important" :title="submenu.admdtdesc" data-i18n="Third Level">
                                                {{ submenu.admdtdesc }}
                                            </span>
                                        </inertia-link>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>

        <div class="app-content content ">
            <div class="content-overlay"></div>
            <div class="header-navbar-shadow"></div>
                <slot name="main"></slot>
        </div>
        
    </div>
</template>

<script>
import { Loading } from 'element-ui';
export default {
	name: "DashboardTemplate",
	components: {
        Loading
    },
    data() {
        return {
            
        }
    },
    methods: {
        renderizar: function() {
            this.$store.state.fullscreenLoading = !this.$store.state.fullscreenLoading;
            this.$store.state.errors = [];
        },
        probar: function() {
            console.log('23312asdas');
            // this.$inertia.get(this.route('programa.index'), { search: 'John' }, 
            // {
            //     preserveState: (page) => Object.keys(page.props.modulos),
            // });
            this.$inertia.visit(this.route('programa.index'))
        }
    },
    mounted() {
        
    }
};
</script>