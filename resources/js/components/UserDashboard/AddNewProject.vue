<template>
  <div>
    <button class="btn btn-primary btn-lg" href="#" role="button" v-on:click="newProject">{{ buttonText }}</button>
    <modal
      v-on:confirmed="sendProject"
      v-model="projectName"
      ref="modalNewProject"
      title="New Project"
      input-label="Project name"
      data-input=""
    ></modal>
  </div>
</template>

<script>
  module.exports =
  {
    data: function () {
      return {
        projectName: String,
      }
    },
    props: {
      userId: Number,
      buttonText: String
    },
    methods: {
      newProject: function() {
        this.$refs.modalNewProject.open();
      },
      sendProject: function() {
        return axios
          .post('/users/'+this.userId+"/projects", { projectName : this.projectName }
            )
          .then((response) => {
            window.location = response.data.redirectTo;
          })
          .catch();
        return false;
      }
    }
  }
</script>

<style lang="scss" scoped>

</style>
