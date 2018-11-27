<template>
  <div>

    <button class="btn btn-primary btn-lg" href="#" role="button" v-on:click="newOrganisation">{{ buttonText }}</button>
    <modal
      v-on:confirmed="sendOrganisation"
      v-model="orgName"
      ref="modalNewOrganisation"
      title="New Organisation"
      input-label="Organisation name"
      data-input=""
    ></modal>
  </div>
</template>

<script>
export default {
  data() {
    return {
      orgName: ''
    }
  },
  props: {
    buttonText: String,
    userId: Number,
  },
  methods: {
    newOrganisation() {
      this.$refs.modalNewOrganisation.open();
    },
    sendOrganisation() {
      axios.post('/organisations', this.$data, {
          headers : {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
          }
        }
      ).then(response => {
        window.location = response.data.redirectTo;
      })
      .catch(response => {
        console.log("Error while creating organisation");
      });

      return false;
    }
  }
};
</script>

<style lang="scss" scoped>

</style>
