<template>
  <form method="POST" href="#" v-bind:action="deleteUrl">
    <input type="hidden" name="_method" value="delete" />
    <button class="btn btn-danger btn-block" v-on:click="requestDelete">Delete Project</button>
    <input type="hidden" name="_token" v-bind:value="csrfToken()">
  </form>
</template>

<script>
  export default
  {
    props : {
      projectId : Number,
    },
    data(){
      return {
        deleteUrl: `/projects/${this.projectId}`
      };
    },
    methods : {
      requestDelete()
      {
        let confirmed = confirm('Are you sure you want to delete this project ? ');
        if(confirmed)
        {
          axios.delete(
            `/projects/${this.projectId}`,
            {
              headers : {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
              }
            }
          ).then(response =>
          {
            window.location = response.data.redirectTo;
          }, response =>
          {
            console.log("error while deleting labels");
          });
        }
      },
      csrfToken() {
        return document.querySelector('meta[name="csrf-token"]').getAttribute('content')
      }
    }
  }
</script>

<style lang="scss" scoped>

</style>
