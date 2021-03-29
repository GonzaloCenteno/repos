

require('./bootstrap');

require("bootstrap-css-only/css/bootstrap.min.css")
require("mdbvue/lib/css/mdb.min.css")
require("@fortawesome/fontawesome-free/css/all.min.css")

import locale from 'element-ui/lib/locale/lang/es'
import 'element-ui/lib/theme-chalk/index.css'
import 'zingchart/es6'
import zingchartVue from 'zingchart-vue';

import { InertiaApp } from '@inertiajs/inertia-vue'
import ElementUI from 'element-ui'
import Vue from 'vue'
import Vuex from 'vuex'
import storeIndex from './store/index'
import services from './store/handler'

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
