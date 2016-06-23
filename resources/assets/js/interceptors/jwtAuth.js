export default {
	request: function (request) {
  	const token = localStorage.getItem('api_token');
		let headers = request.headers || (request.headers = {});

		if ( token !== null && token !== 'undefined') {
			headers.Authorization = 'Bearer ' + token;
		}

    return request;
  },

  response: function (response) {
  	if (
  		response.status && response.status === 400 ||
  		response.status && response.status === 401 ||
  		response.status && response.status === 404 && response.data.error === 'user_not_found') {
			localStorage.removeItem('api_token');
			localStorage.removeItem('user');
		}

		if(response.data && response.data.api_token) {
			localStorage.setItem('api_token', response.data.api_token);
			response.headers.Authorization = 'Bearer ' + response.data.api_token;
		}

    return response;
  }
}
