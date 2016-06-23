<template>
	<div class="extra content">
		<span class="left floated comments">
			<comments-count :media.sync="media"></comments-count>
		</span>
		<span class="right floated likes">
			<likes-count :media.sync="media" :class="{ outline: false }"></likes-count>
		</span>
	</div>
</template>

<script>
import LikesCount from '../../countables/Likes.vue';
import CommentsCount from '../../countables/Comments.vue';

export default {
	components: { LikesCount, CommentsCount },
	props: {
		media: {
			type: Object,
			required: true
		}
	}
}
</script>
