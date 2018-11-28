<template>
  <button class="btn btn-danger btn-block" @click="requestDelete">Delete Project</button>
</template>

<script>
export default {
  props: {
    projectId : Number,
  },
  methods: {
    requestDelete() {
      let confirmed = confirm('Are you sure you want to delete this project ? ');
      if(confirmed) {
        axios.delete( `/projects/${this.projectId}`).then(response => {
          window.location = response.data.redirectTo;
        })
        .catch(response => {
          console.log("Error while deleting label");
        });
      }
    }
  }
};
</script>

<style lang="scss" scoped>

</style>
