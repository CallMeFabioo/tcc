<template>
	<div class="ui segment">
		<img class="ui fluid image" v-bind:src="image.standard.url">
	</div>
</template>

<script>
export default {

	props: ['image'],

	beforeCompile() {
		// INSANE POG!!!
		this.image = {
			standard: {
				url: ''
			}
		};
	}

}
</script>
