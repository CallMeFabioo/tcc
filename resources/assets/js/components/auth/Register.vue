<template>
	<div class="auth-form">
		<h2 class="ui teal image header">
		  <div class="content">
				<p>Create new account</p>
		  </div>
		</h2>
		<form class="ui large form error">
		  <div class="ui stacked segment">
		  	<div class="field" v-bind:class="{ error: errors.name }">
			   	<label v-if="errors.name" v-for="error in errors.name">{{ error }}</label>
				  <div class="ui left icon input">
					<i class="user icon"></i>
					<input type="text" name="name" placeholder="Name" v-model="user.name">
				  </div>
				</div>
		  	<div class="field" v-bind:class="{ error: errors.username }">
		  		<label v-if="errors.username" v-for="error in errors.username">{{ error }}</label>
				  <div class="ui left icon input">
						<i class="user icon"></i>
						<input type="text" name="username" placeholder="Username" v-model="user.username">
				  </div>
				</div>
				<div class="field" v-bind:class="{ error: errors.email }">
					<label v-if="errors.email" v-for="error in errors.email">{{ error }}</label>
				  <div class="ui left icon input">
						<i class="mail icon"></i>
						<input type="email" name="email" placeholder="E-mail address" v-model="user.email">
				  </div>
				</div>
				<div class="field" v-bind:class="{ error: errors.password }">
					<label v-if="errors.password" v-for="error in errors.password">{{ error }}</label>
				  <div class="ui left icon input">
						<i class="lock icon"></i>
						<input type="password" name="password" placeholder="Password" v-model="user.password">
				  </div>
				</div>
				<button class="ui fluid large teal submit button" :class="{ loading: loading }" @click.prevent="register()">Create account</button>
		  </div>
		</form>
	</div>
</template>

<script>
import Auth from '../../services/Auth';

export default {
	data() {
		return {
			user: {
				name: '',
				username: '',
				email: '',
				password: '',
			},
			errors: [],
			loading: false
		}
	},

	methods: {
		register() {
			this.loading = true;

			Auth.register(this, this.user)
				.then((response) => {
					this.$dispatch('userHasFetchedToken', response.data);
					this.loading = false;
				})
				.catch((err) => {
					this.errors = err.data;
					this.loading = false;
				});
		}
	}
}
</script>
