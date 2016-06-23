<template>
	<div>
		<i class="comment large icon"></i>
		<span>{{ comments }} {{ comments | pluralize 'comment' }}</span>
	</div>
</template>

<script>
export default {
	props: {
		media: {
			type: Object
		}
	},

	computed: {
		comments: function() {
			return this.media.comments_count;
		}
	}
}
</script>
