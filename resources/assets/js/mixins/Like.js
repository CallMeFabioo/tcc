import { API_URL } from '../services/Auth';

export default {

	methods: {
		like(postId, url = '', data = {}) {
			const endpoint = `${API_URL}/medias/${postId}/${url}`;

			return new Promise((resolve, reject) => {
				this.$http[this.getRequestMethod()](endpoint, data)
						.then((response) => resolve(response))
						.catch((err) => resolve(err));
			});
		},

		getRequestMethod() {
			return (this.userHasLiked ? 'delete' : 'post').toLowerCase();
		}
	}

}
