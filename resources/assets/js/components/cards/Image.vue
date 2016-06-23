<template>
	<a class="image" v-link="{ name: 'post', params: { uid: media.uid }}">
		<img class="card__image" v-bind:src="media.images.thumbnail.url">
	</a>
</template>

<script>
export default {
	props: ['media']
}
</script>

