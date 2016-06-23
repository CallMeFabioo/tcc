export const API_URL = 'http://tcc.dev/api/v1';
export const LOGIN_URL = `${API_URL}/auth/login`;
export const LOGOUT_URL = `${API_URL}/auth/logout`;
export const SIGNUP_URL = `${API_URL}/auth/register`;
export const USERDATA_URL = `${API_URL}/users/me`;

export default {

	login(context, credentials) {
		return this.handleRequest(context, LOGIN_URL, credentials);
	},

	logout(context) {
		return new Promise((resolve, reject) => {
			context.$http.post(LOGOUT_URL)
				.then((response) => resolve(response))
				.catch((err) => reject(err));
		});
	},

	register(context, credentials) {
		return this.handleRequest(context, SIGNUP_URL, credentials);
	},

	handleRequest(context, url, credentials, redirectUrl = '/') {
		return new Promise((resolve, reject) => {
			context.$http.post(url, credentials)
				.then((response) => resolve(response))
				.catch((err) => reject(err));
		});
	},

	getUserData(context) {
		return new Promise((resolve, reject) => {
			context.$http.get(USERDATA_URL)
				.then((response) => resolve(response))
				.catch((err) => reject(err))
		});
	},

	getAuthHeader() {
		return 'Bearer ' + localStorage.getItem('api_token');
	}

}
