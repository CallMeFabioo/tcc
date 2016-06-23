<template>
	<div class="row">
		<div class="column">
			<div class="ui segment">
				<h2>User: {{ user.name }}</h2>
			</div>
		</div>
	</div>
</template>
<script>
import { API_URL } from '../../services/Auth';

export default {
	name: 'User',

	data() {
		return {
			user: {}
		}
	},

	ready() {
		const username = this.$route.params.username;

		this.$http.get(`${API_URL}/users/${username}`)
				.then((res) => this.user = res.data);
	}
}
</script>
