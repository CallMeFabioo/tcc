<template>
<div class="content">
	<a class="ui right corner label" @click.prevent="addLike()">
		<i class="like large icon" v-bind:class="{ red: userHasLiked, outline: !userHasLiked }"></i>
	</a>
	<div class="header">
		<a v-link="{ name: 'user', params: { username: media.owner.username }}">
			{{ media.owner.name }}
		</a>
	</div>
	<div class="description">
		<p>{{ media.description }}</p>
	</div>
</div>
</template>

<script>
import Like from '../../mixins/Like';

export default {
	props: ['media'],
	mixins: [Like],

	beforeCompile() {
		// INSANE POG!!!
		this.media = {
			owner: {},
			likes: {}
		};
	},

	methods: {
		addLike() {
			this.like(this.$route.params.uid, 'likes')
					.then((res) => {
						this.media = res.data;
						this.$dispatch('liked', res.data);
					});
		}
	},

	computed: {
		userHasLiked: function() {
			return this.media.likes.length ? true : false;
		}
	}

}
</script>
