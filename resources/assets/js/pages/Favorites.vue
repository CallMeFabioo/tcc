<template>
	<div class="row">
	  <div class="sixteen wide column">
	  	<div class="ui stackable cards four">
				<div class="ui grey card" v-for="media in favorites">
					<card-header :media="media"></card-header>
					<card-image :media="media"></card-image>
				</div>
			</div>
	  </div>
	</div>
</template>

<script>
import { API_URL } from '../services/Auth';
import CardHeader from '../components/cards/Header.vue';
import CardImage from '../components/cards/Image.vue';

export default {
	name: 'Favorites',

	components: {
		CardHeader,
		CardImage
	},

	data() {
  	return {
  		favorites: [],
  		chunk: {
  			four: true
  		}
  	}
  },

  ready() {
    this.fetchData();
  },

  methods: {
  	fetchData() {
  		this.$http.get(`${API_URL}/users/favorites`).then((res) => {
	  		this.favorites = res.data;
			});
  	}
  }
}
</script>
