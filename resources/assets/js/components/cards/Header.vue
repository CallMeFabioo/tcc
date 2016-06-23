<template>
	<div class="content card__content">
		<a v-link="{ name: 'user', params: { username: media.owner.username }}">
			<img class="ui avatar image" v-bind:src="media.owner.avatar.thumbnail.url">
			<span>{{ media.owner.username }}</span>
		</a>
		<div class="meta">{{ media.created_at }}</div>
	</div>
</template>

<script>
export default {
	props: ['media']
}
</script>
