<template>
	<div class="ui grey card">
		<card-header :media="media"></card-header>
		<card-image :media="media"></card-image>
		<div class="content">
			<div class="card__metadata">
				<div class="card__metadata__comments">
					<card-comments :media="media"></card-comments>
				</div>
				<div class="card__metadata__likes">
					<a href="#" @click.prevent="addLike()">
						<card-likes
							:media="media"
							:user="user"
							:class="{ large: true, outline: !userHasLiked }">
						</card-likes>
					</a>
				</div>
			</div>
		</div>
	</div>
</template>

<script>
import { API_URL } from '../../services/Auth';
import Like from '../../mixins/Like';

import CardHeader from './Header.vue';
import CardImage from './Image.vue';
import CardComments from '../../countables/Comments.vue';
import CardLikes from '../../countables/Likes.vue';

export default {
	props: ['media'],
	components: { CardHeader, CardImage, CardComments, CardLikes },
	mixins: [Like],

	data() {
		return {
			user: JSON.parse(localStorage.getItem('user'))
		}
	},

	methods: {
		addLike() {
			this.like(this.media.uid, 'likes').then((res) => {
				this.media = res.data;
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
