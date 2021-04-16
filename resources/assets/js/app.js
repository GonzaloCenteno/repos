

require('./bootstrap');

import locale from 'element-ui/lib/locale/lang/es'
import 'element-ui/lib/theme-chalk/index.css'
import 'zingchart/es6'
import zingchartVue from 'zingchart-vue';

import { InertiaApp } from '@inertiajs/inertia-vue'
import ElementUI from 'element-ui'
import Vue from 'vue'
import 'material-icons/iconfont/material-icons.css';
import Vuex from 'vuex'
import storeIndex from './store/index'
import services from './store/handler'
import 'boxicons'

// import datatable from 'datatables.net-bs4'
// require( 'datatables.net-buttons/js/dataTables.buttons' )
// require( 'datatables.net-buttons/js/buttons.html5' )
// import print from 'datatables.net-buttons/js/buttons.print'
// import jszip from 'jszip/dist/jszip'
// import pdfMake from 'pdfmake/build/pdfmake'
// import pdfFonts from 'pdfmake/build/vfs_fonts'

// pdfMake.vfs = pdfFonts.pdfMake.vfs;
// window.JSZip = jszip

// Vue.prototype.$datatbleGlobal = function(nombreTabla) {
//     this.$nextTick( () => {
//         $(nombreTabla).DataTable().destroy();
//         $(nombreTabla).DataTable({
//             //dom: 'Bfrtip',
//             lengthMenu: [[5, 10, 15, -1], [5, 10, 15, "Todo"]],
// 			info: true,
// 			ordering: true,
// 			destroy:true,
// 			searching: true,
// 			processing : true,
// 			serverSide : true,
// 			responsive: true,
//             ajax: {
//                 url: "programa/0",
//                 // data: function (data) {
//                 //     data.params = {
//                 //         sac: "helo"
//                 //     }
//                 // }
//             },
//             columns: [
//                 { data: 'adusragen', searchable: false },
//                 { data: 'gbagenomb' },
//                 { data: 'gbagetdid', searchable: false },
//                 { data: 'gbagendid'}
//             ],
//             dom:    "B<'row'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6'f>>" +
//                     "<'row'<'col-sm-12'tr>>" +
//                     "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
//             buttons: [
//                 {
//                     "extend" : "copyHtml5",
//                     "text" : " Copiar",
//                     "titleAttr" : "Copiar",
//                     "className" : "btn btn-secondary"
//                 },
//                 {
//                     "extend" : "excelHtml5",
//                     "text" : "<i class='fas fa-file-excel'></i> Excel",
//                     "titleAttr" : "Exportar Excel",
//                     "className" : "btn btn-success"
//                 },
//                 {
//                     "extend" : "pdfHtml5",
//                     "text" : "<i class='fas fa-file-excel'></i> PDF",
//                     "titleAttr" : "Exportar PDF",
//                     "className" : "btn btn-danger"
//                 },
//                 {
//                     "extend" : "csvHtml5",
//                     "text" : "<i class='fas fa-file-csv'></i> CSV",
//                     "titleAttr" : "Exportar CSV",
//                     "className" : "btn btn-info"
//                 },
//                 {
//                     "extend" : "print",
//                     "text" : "<i class='fas fa-file-csv'></i> Imprimir",
//                     "titleAttr" : "Imprimir Archivo",
//                     "className" : "btn btn-secondary"
//                 }
//             ]
//         });
//     });
// }

window.Vue = require('vue');
Vue.mixin({ methods: { route: window.route } })
Vue.use(ElementUI, { locale })
Vue.use(InertiaApp)
Vue.use(Vuex)
let store = new Vuex.Store(storeIndex);

const app = document.getElementById('app')

Vue.config.productionTip = false

Vue.use({
	install(Vue) {
		Object.defineProperty(Vue.prototype, '$services', {
			value: services
		})
	}
})

new Vue({
    store,
    render: h => h(InertiaApp, {
        props: {
            initialPage: JSON.parse(app.dataset.page),
            resolveComponent: name => require(`./Pages/${name}`)
        },
    })
}).$mount(app)
