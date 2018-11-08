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
        projectName: ''
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
        axios.post(
          '/addProject',
          this.$data,
          {
            headers : {
              'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
          }
        ).then(response =>
        {
          window.location.pathname = response.data.redirectTo;
        }, response =>
        {
          console.log("error");
        });

        return false;
      }
    }
  }
</script>

<style lang="scss" scoped>

</style>
