<template>
    <mdb-container fluid>
        <mdb-row>
            <mdb-col col="3" class="px-0 mx-0">
                <mdb-treeview style="width: 100%" class="ContenedorForm" header="Netbank" colorful>
                    <mdb-treeview-item v-for="mod in $page.props.modulos" :key="mod.admodmodn" nested far :title="mod.admoddesc" class="text-white">
                        <mdb-treeview-item v-for="(menu, index) in mod.admprs" :key="index" nested far :title="menu.admprdesc" class="text-white">
                            <inertia-link :href="route('programa.index')" class="nav-link" @click="renderizar">
                                <mdb-treeview-item v-for="submenu in menu.admdts" :key="submenu.admdtmdtn" far :title="submenu.admdtdesc" class="text-white" />
                            </inertia-link>
                        </mdb-treeview-item>
                    </mdb-treeview-item>
                </mdb-treeview>
            </mdb-col>
            <mdb-col col="9" v-loading="$store.state.fullscreenLoading"
                                element-loading-text="Loading..."
                                element-loading-spinner="el-icon-loading"
                                element-loading-background="rgba(0, 0, 0, 0.3)">
                <mdb-row>
                    <slot name="main"></slot>
                </mdb-row>
            </mdb-col>
        </mdb-row>
    </mdb-container>
</template>

<script>
import { mdbContainer,mdbRow,mdbIcon,mdbTreeview,mdbTreeviewItem,mdbCol,mdbNavbar,mdbNavbarBrand,mdbNavbarToggler,mdbNavbarNav,mdbNavItem,mdbInput,mdbFormInline,mdbBtn } from "mdbvue";
import { Loading } from 'element-ui';
export default {
	name: "DashboardLayout",
	components: {
        Loading,
        mdbContainer,
        mdbRow,
        mdbIcon,
        mdbTreeview,
        mdbTreeviewItem,
        mdbCol,
        mdbNavbar,
        mdbNavbarBrand,
        mdbNavbarToggler,
        mdbNavbarNav,
        mdbNavItem,
        mdbInput,
        mdbFormInline,
        mdbBtn
    },
    data() {
        return {
            
        }
    },
    methods: {
        renderizar: function() {
            this.$store.state.fullscreenLoading = !this.$store.state.fullscreenLoading;
            this.$store.state.errors = [];
        }
    },
    mounted() {
        
    }
};
</script>