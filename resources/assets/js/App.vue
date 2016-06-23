<template>
  <div class="ui grid container" id="app">
    <div class="row">
      <div class="column">
        <div class="ui menu icon labeled">
			    <div class="item">
			    	<a v-link="{ name: 'home' }">
			    		<img src="/images/avatar_thumbnail.png">
			    	</a>
			    </div>
			    <a class="item" v-link="{ name: 'home' }" v-if="authenticated">
		        <i class="home blue large icon"></i>
		        <!-- <div class="floating circular ui grey label">22</div> -->
		        Home
			    </a>
			    <a class="item" v-link="{ name: 'followers' }" v-if="authenticated">
		        <i class="heart red large icon"></i>
		        <!-- <div class="floating circular ui green label">22</div> -->
		        Followers
			    </a>
			    <a class="item" v-link="{ name: 'folowing' }" v-if="authenticated">
		        <i class="users teal large icon"></i>
		        Following
			    </a>
			    <a class="item" v-link="{ name: 'favorites' }" v-if="authenticated">
		        <i class="star yellow large icon"></i>
		        Favorites
			    </a>
			    <a class="item right" v-link="{ name: 'login' }" v-if="!authenticated">
			        <i class="sign in icon"></i>
			        Sign-in
			    </a>
			    <a class="item right" @click="logout()" v-if="authenticated">
		        <i class="sign out icon"></i>
		        Logout
			    </a>
				</div>
      </div>
    </div>

    <router-view></router-view>
  </div>
</template>

<script>
import Auth from './services/Auth';

export default {
	data() {
		return {
			user: null,
			authenticated: false,
			token: null
		}
	},

	events: {
		'userHasLoggedIn': function(user) {
			this.login(user);
		},
		'userHasLoggedOut': function() {
			this.logout();
		}
	},

	ready() {

    const token = localStorage.getItem('api_token');
    const user = JSON.parse(localStorage.getItem('user'));

    if (user === null || token === null) {
      Auth.getUserData(this).then((res) => {
      	this.login(res.data);
      });
    } else {
    	this.login(user);
    }
	},

	methods: {

		login(user) {
			this.user = user;
      this.authenticated = true;
      this.token = localStorage.getItem('api_token');
      if(localStorage.getItem('user') === null) {
      	localStorage.setItem('user', JSON.stringify(user));
      }
    },

    logout() {
      // Cleanup when token was invalid our user has logged out
      this.user = {};
      this.authenticated = null;
      this.token = null;
      Auth.logout(this).then((res) => {
      	console.log(res.data);
      });;
      localStorage.removeItem('api_token');
    	localStorage.removeItem('user');
      if (this.$route.auth) this.$route.router.go('/login');
    }
	}
}
</script>
