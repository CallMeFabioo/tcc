<template>
	<div class="auth-form">
		<h2 class="ui teal image header">
		  <div class="content">
				<p>Log-in to your account</p>
		  </div>
		</h2>
		<form class="ui large form error">
		  <div class="ui stacked segment">
				<div class="field">
				  <div class="ui left icon input">
					<i class="user icon"></i>
					<input type="email" name="email" placeholder="E-mail address" v-model="credentials.email">
				  </div>
				</div>
				<div class="field">
				  <div class="ui left icon input">
					<i class="lock icon"></i>
					<input type="password" name="password" placeholder="Password" v-model="credentials.password">
				  </div>
				</div>
				<div class="field" v-bind:class="{ error: error }">
		  		<label v-if="error">{{ error.message }}</label>
		  	</div>
				<button class="ui fluid large teal submit button" :class="{ loading: loading }" @click.prevent="submit()">Login</button>
		  </div>
		</form>
	</div>
</template>

<script>
import Auth from '../../services/Auth';

export default {
	data() {
		return {
			credentials: {
				email: '',
				password: ''
			},
			loading: false,
			error: null
		}
	},

	methods: {
		submit() {

			const credentials = {
				email: this.credentials.email,
				password: this.credentials.password
			};

			this.loading = true;

			Auth.login(this, credentials)
				.then((res) => {
					this.$dispatch('userHasFetchedToken', res.data);
					this.loading = false;
				})
				.catch((err) => {
					this.error = err.data;
					this.loading = false;
				});
		}
	}
}
</script>
