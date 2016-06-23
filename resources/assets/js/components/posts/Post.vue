<template>
	<div class="row single-post">
		<div class="sixteen wide mobile eight wide tablet nine wide computer column">
			<content :image="media.images"></content>
		</div>
		<div class="sixteen wide mobile eight wide tablet seven wide computer column">
			<div class="ui card card--single">
				<details :media="media"></details>
				<status :media.sync="media"></status>
			</div>
			<div class="ui tall segment stacked">
				<comments :media="media"></comments>
			</div>
		</div>
	</div>
</template>

<script>
import Content from './Content.vue';
import Details from './Details.vue';
import Status from './Status.vue';
import Comments from '../comments/Comments.vue';
import { API_URL } from '../../services/Auth';

export default {
	name: 'Post',
	components: { Content, Details, Status, Comments },

	data() {
		return {
			media: {}
		}
	},

	events: {
		liked: function(newMedia) {
			this.media = newMedia;
		}
	},

	ready() {
		const url = `${API_URL}/medias/${this.$route.params.uid}`;

		this.$http.get(url).then((res) => this.media = res.data);
	}
}
</script>
