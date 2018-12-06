<template>
  <div class="card text-center">
    <h4 class="card-header">{{ name }}</h4>
    <div class="card-body">
      <h6>Tasks : </h6>
      <ul v-if="tasksToDo.length > 0">
        <li v-for="task in tasksToDo" :key="task.id">{{ task.name }}</li>
      </ul>
      <p v-else>
        No tasks in this project
      </p>
    </div>
    <div class="card-footer">
      <a v-bind:href="buttonUri"><button class="btn btn-primary btn-block">{{buttonText}}</button></a>
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
