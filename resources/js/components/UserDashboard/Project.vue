<template>
  <div class="card text-center">
    <h4 class="card-header">{{ name }}</h4>
    <div class="card-body">
      <h6>Tasks running : </h6>
      <ul>
        <li v-for="todo in tasksToDo">{{todo}}</li>
      </ul>
    </div>
    <div class="card-footer">
      <a v-bind:href="uriProject"><button class="btn btn-light btn-block">{{buttonText}}</button></a>
    </div>
  </div>
</template>

<script>
  module.exports =
  {
    props: {
      name: Number,
      tasksToDo: Array,
      buttonText: String,
      uriProject: String
    }
  }
</script>

<style lang="scss" scoped>

</style>
