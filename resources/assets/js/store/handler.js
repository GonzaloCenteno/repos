import store from './index';

import Axios from 'axios'

import { Notification } from 'element-ui';

Axios.defaults.headers.common.Accept = 'application/json';

Axios.interceptors.response.use(
	response => {
		if (response.status === 200 || response.status === 201) {
			store.state.errors = [];
			return Promise.resolve(response);
		} else {
			store.state.errors = [];
			return Promise.reject(response);
		}
	},
	error => {
		if (error.response.status) {
			switch (error.response.status) {
				case 422:
					store.state.errors = error.response.data.errors;
                    Notification.info({
                        title: 'Ocurrio Un Problema',
                        message: 'Debe Llenar Correctamente el formulario',
                        duration: 3000,
						offset: 50
                    });
				    store.state.processing = false;
				break;

				case 401:
					alert("session expired");
				break;

				case 403:
					alert('page not exist');
				break;

				case 404:
					alert('page not exist');
				break;

				case 500:
                    Notification.error({
                        title: 'Ocurrio Un Error',
                        message: 'Ocurrio un Problema con el Servidor',
                        duration: 3000,
						offset: 50
                    });
					store.state.fullscreenLoading = false;
					store.state.processing = false;
				break;

				case 502:
					Notification.error({
                        title: 'Ocurrio Un Error',
                        message: 'Ocurrio un Problema con el Servidor',
                        duration: 3000,
						offset: 50
                    });
					store.state.fullscreenLoading = false;
					store.state.processing = false;
			}
			return Promise.reject(error.response);
		}
	}
);

export default { }