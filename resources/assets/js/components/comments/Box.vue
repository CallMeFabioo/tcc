<template>
	<div class="extra content">
    <form class="ui reply transparent form" @submit.prevent="addComment" v-bind:class="{ loading: loading }">
      <div class="field">
        <textarea cols="25" rows="0" v-model="comment" placeholder="Add Comment..." data-role="none"></textarea>
        <button class="ui icon basic button">
          <i class="send grey outline icon"></i>
        </button>
      </div>
    </form>
  </div>
</template>

<script>
import { API_URL } from '../../services/Auth';

export default {

	props: ['media'],

	data() {
    return {
      comment: '',
      loading: false
    }
  },

  methods: {
    addComment() {
    	const url = `${API_URL}/medias/${this.$route.params.uid}/comments`;

      if(this.comment !== '') {
      	const data = {
	      	comment: this.comment,
	      	post_id: this.media.id
	      };

	      this.loading = true;

      	this.$http.post(url, data).then((res) => {
      		this.loading = false;
      		this.comment = '';
      		this.$dispatch('new-comment', res.data);
      	});
      }

    },
  }
}
</script>
