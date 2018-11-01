<template>
  <button class="btn btn-primary btn-lg" href="#" role="button" v-on:click="clicked">{{ buttonText }}</button>
</template>

<script>
  module.exports =
  {
    props:
    {
      buttonText: String
    },
    methods:
    {
      clicked: function()
      {
        console.log('ici');
      }
    }
  }
</script>

<style lang="scss" scoped>

</style>
