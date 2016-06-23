<template>
	<div>
		<i class="heart red icon" v-bind:class="class"></i>
		<span>{{ likes }} {{ likes | pluralize 'like' }}</span>
	</div>
</template>

<script>
export default {
	props: {
		media: {},
		class: {
			type: Object,
			default: () => {
				return { outline: false }
			}
		}
	},

	computed: {
		likes: function() {
			return this.media.likes_count;
		}
	}

}
</script>
