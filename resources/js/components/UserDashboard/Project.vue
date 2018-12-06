<template>
  <div class="card text-center bg-light">
    <h4 class="card-header">{{ name }}</h4>
    <div class="card-body">
      <h5>Tasks running : </h5>
      <ul v-if="tasksToDo.length > 0">
        <li v-for="todo in tasksToDo" :key="todo.id">{{todo}}</li>
      </ul>
      <p v-else>
        No tasks in this project
      </p>
      <a v-bind:href="uriProject"><button class="btn btn-primary btn-block">{{buttonText}}</button></a>
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
      uriProject: String
    }
  }
</script>

<style lang="scss" scoped>

</style>
