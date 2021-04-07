export default {
	state: {
		fullscreenLoading: false,
		processing: false,
		errors: [],
		showModal: false,
		mostrarModal: {
			display: 'block',
			background: '#0000006b'
		},
		ocultarModal: {
			display: 'none'
		}
		// modulos: []
	},
	mutations: {
		// getModulos(state, data){
		// 	state.modulos = data;
		// }
	},
	actions: {
		// setModulos({ commit }) {
		// 	axios.get(`/menu`).then( rspta => {
		// 		commit('getModulos', rspta.data);
		// 	}).catch( error => {
		// 		console.log(error);
		// 		console.log('Algo salio mal');
		// 	});
		// }
	}
}