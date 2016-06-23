<template>
	<div class="row">
	  <div class="twelve wide column">
	    <cards :medias="medias"></cards>
	  </div>
	  <div class="four wide column">
	  	<div class="ui piled segment">
		  	<h4 class="ui header">People to follow</h4>
				<div class="ui cards">

				  <div class="card" v-for="user in users" track-by="id" transition="fade">
				    <div class="content">
				      <img class="right floated mini ui image" v-bind:src="user.avatar.thumbnail.url">
				      <div class="header">{{ user.name }}</div>
				      <div class="meta">New Member</div>
				      <!-- <div class="description">
				        <p>Jenny wants to add you to the group <b>best friends</b></p>
				      </div> -->
				    </div>
				    <button class="ui blue bottom attached button" @click.prevent="follow(user.id)">
				      <i class="add icon"></i>
				      <span>Follow</span>
				    </button>
				  </div>

				</div>
			</div>
		</div>
	</div>
</template>

<script>
import { API_URL } from '../services/Auth';

import Cards from '../components/cards/Cards.vue';

export default {
	name: 'Home',

	data() {
  	return {
  		medias: [],
  		users: []
  	}
  },

  components: { Cards },

  watch: {
  	'users': function(val, Oldval) {
  		if(val.length === 0) {
  			this.fetchUsers();
  		}
  	}
  },

  ready() {
    this.fetchData();
    this.fetchUsers();
  },

  methods: {
  	follow(user_id) {
  		this.$http.post(`${API_URL}/users/followers`, { user_id }).then((res) => {
	  		this.users = this.users.filter((user) => {
	  			return user.id !== user_id;
	  		});
			});
  	},
  	fetchData() {
  		this.$http.get(`${API_URL}/medias`, { take: 12 }).then((res) => {
	  		this.medias = res.data;
			});
  	},
  	fetchUsers() {
  		this.$http.get(`${API_URL}/users`, { take: 5 }).then((res) => {
	  		this.users = res.data;
			});
  	}
  }
}
</script>
