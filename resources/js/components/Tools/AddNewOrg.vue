<template>
  <div>
    <button class="btn btn-primary btn-lg" href="#" role="button" @click="newOrganisation">{{ buttonText }}</button>
    <modal
      @confirmed="sendOrganisation"
      v-model="orgName"
      ref="modalNewOrganisation"
      title="New Organisation"
      input-label="Organisation name"
      data-input=""
    ></modal>
  </div>
</template>

<script>
import Modal from './Modal';

export default {
  data() {
    return {
      orgName: ''
    }
  },
  components: { Modal },
  props: {
    buttonText: String,
    userId: Number,
  },
  methods: {
    newOrganisation() {
      this.$refs.modalNewOrganisation.open();
    },
    sendOrganisation() {
      return axios.post('/organisations', this.$data).then(response => {
        window.location = response.data.redirectTo;
      })
      .catch(response => {
        console.log("Error while creating organisation");
      });
    }
  }
};
</script>

<style lang="scss" scoped>

</style>
