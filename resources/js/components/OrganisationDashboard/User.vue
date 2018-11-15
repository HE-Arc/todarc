<template>
  <div class="card text-center">
    <h4 class="card-header">{{ username }}</h4>
    <div class="card-body">
    </div>
    <div class="card-footer">
      <a v-bind:href="buttonUri">
      <button class="btn btn-light btn-block">{{buttonText}}</button></a>
    </div>
  </div>
</template>

<script>
  module.exports =
  {
    props: {
      username: String,
      buttonText: String,
      buttonUri: String
    }
  }
</script>

<style lang="scss" scoped>

</style>
