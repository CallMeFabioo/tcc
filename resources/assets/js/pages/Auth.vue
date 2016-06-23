<template>
	<div class="row">
		<div class="six wide left floated column">
			<login-form></login-form>
		</div>
		<div class="six wide right floated column">
			<registration-form></registration-form>
		</div>
	</div>
</template>

<script>
import { router } from '../app';
import { USERDATA_URL } from '../services/Auth';

import LoginForm from '../components/auth/Login.vue';
import RegistrationForm from '../components/auth/Register.vue';

export default {
	name: 'Auth',
	components: { LoginForm, RegistrationForm },

	events: {
		'userHasFetchedToken': function() {
			this.getUserData();
		}
	},

	methods: {
		getUserData() {
			this.$http.get(USERDATA_URL)
				.then((res) => {
					this.$dispatch('userHasLoggedIn', res.data);
					router.go('/');
				})
				.catch((err) => console.log(err));
		}
	}
}
</script>
