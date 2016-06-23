<template>
	<div class="ui comments">
    <comment-box :media="media"></comment-box>
    <comment-item
    	:comment="comment"
    	v-for="comment in media.comments"
    	transition="new-comment">
    </comment-item>
  </div>
</template>

<script>
import CommentItem from './Item.vue';
import CommentBox from './Box.vue';

export default {
	components: { CommentItem, CommentBox },

	props: ['media'],

	events: {
		'new-comment': function(comment) {
			this.media.comments.unshift(comment);
		}
	}

}
</script>
