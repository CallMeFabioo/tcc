<template>
	<div class="ui stackable cards" v-bind:class="chunk">
		<Card :media="media" v-for="media in medias"></Card>
	</div>
</template>

<script>
import Card from './Card.vue';

export default {
	components: { Card },
	props: {
		medias: {},
		chunk: {
			default: () => {
				return { three: true }
			}
		}
	}
}
</script>
