<template>
	<div class="comment">
		<div class="comment animated">
	    <a class="avatar">
	      <img v-bind:src="comment.owner.avatar.thumbnail.url">
	    </a>
	    <div class="content">
	      <a class="author" v-link="{ name: 'user', params: { username: comment.owner.username } }">
	      	{{ comment.owner.name }}
	     	</a>
	      <div class="metadata">
	        <div class="date">{{ comment.created_at }}</div>
	      </div>
	      <div class="text">
	         <p>{{ comment.text }}</p>
	      </div>
	      <div class="actions">
	        <a class="like" @click.prevent="addLike(comment.id)">
	        	<likes-count :media="comment" :class="{ outline: !userHasLiked }"></likes-count>
	        </a>
	      </div>
	    </div>
	  </div>
	</div>
</template>

<script>
import LikesCount from '../../countables/Likes.vue';
import Like from '../../mixins/Like';

export default {
	components: { LikesCount },
	mixins: [Like],
	props: ['comment'],

	methods: {
		addLike(comment_id) {
			this.like(this.$route.params.uid, 'comments', { comment_id })
					.then((res) => this.comment = res.data);
		},
	},

	computed: {
		userHasLiked: function() {
			return this.comment.likes.length ? true : false;
		}
	}

}
</script>
