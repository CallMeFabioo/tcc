<template>
	<div class="row">
	  <div class="sixteen wide column">
		  <div class="ui four stackable cards">
				<div class="ui card" v-for="follow in followers">
				  <a class="image" v-link="{ name: 'user', params: { username: follow.username }}">
				    <img v-bind:src="follow.avatar.standard.url">
				  </a>
				  <div class="content">
				    <a class="header"
				    	style="text-align: center;"
				    	v-link="{ name: 'user', params: { username: follow.username }}">
				    	{{ follow.name }}
				    </a>
				  </div>
				</div>
		  </div>
		</div>
	</div>
</template>

<script>
import { API_URL } from '../services/Auth';

export default {
	name: 'Followers',

	data() {
  	return {
  		followers: {}
  	}
  },

  created() {
  	this.$http.get(`${API_URL}/users/followers`)
  		.then((res) => this.followers = res.data);
  },

}
</script>
