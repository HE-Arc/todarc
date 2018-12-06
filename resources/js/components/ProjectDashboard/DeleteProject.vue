<template>
  <form v-bind:action="href" method="post" @submit="requestDelete">
    <input type="hidden" name="_method" value="DELETE">
    <input type="hidden" name="_token" id="csrf-token" v-bind:value="csrf" />
    <button type="submit" class="btn btn-danger btn-block">Delete Project</button>
  </form>

</template>

<script>
export default {
  props: {
    projectId : Number,
  },
  methods: {
    requestDelete(e)
    {
      let confirmed = confirm('Are you sure you want to delete this project ? ');

      if(!confirmed)
      {
        e.preventDefault();
      }
    }
  },
  computed: {
    href: function()
    {
      return `/projects/${this.projectId}`;
    },
    csrf: function()
    {
      return document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    }
  }
};
</script>

<style lang="scss" scoped>

</style>
