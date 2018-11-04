<template>
  <button class="btn btn-primary btn-lg" href="#" role="button" v-on:click="clicked">{{ buttonText }}</button>
</template>

<script>
  module.exports =
  {
    data: function ()
    {
      return {
        projectName: '',
        projectDescription: ''
      }
    },
    props:
    {
      buttonText: String
    },
    methods:
    {
      clicked: function()
      {
        console.log(this.projectName);
      }
    }
  }
</script>

<style lang="scss" scoped>

</style>
