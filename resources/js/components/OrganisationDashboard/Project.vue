<template>
  <div class="card text-center">
    <h4 class="card-header">{{ name }}</h4>
    <div class="card-body">
      <h6>Tasks running : </h6>
      <ul>
        <li v-for="task in tasksToDo">{{ task.name }}</li>
      </ul>
    </div>
    <div class="card-footer">
      <a v-bind:href="buttonUri"><button class="btn btn-light btn-block">{{buttonText}}</button></a>
    </div>
  </div>
</template>

<script>
  module.exports =
  {
    props: {
      name: String,
      tasksToDo: Array,
      buttonText: String,
      buttonUri: String,
    }
  }
</script>

<style lang="scss" scoped>

</style>
