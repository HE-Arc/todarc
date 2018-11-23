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
    data: function ()
    {
      return {
        orgId: Number,
        projectName: String,
      }
    },
    props:
    {
      buttonText: String
    },
    methods:
    {
      newProject: function()
      {
        this.$refs.modalNewProject.open();
      },
      sendProject: function()
      {
        /*
        return axios
          .post('/organisations', {id:this.userId})
          .then((response) => {
            console.log("user add");
            window.location = response.data.redirectTo;
          })
          .catch();
          */

        return false;
      }
    }
  }
</script>

<style lang="scss" scoped>

</style>
