<template>
  <div class="card text-center bg-light">
    <h4 class="card-header">{{ name }}</h4>
    <div class="card-body">
      <h5>Tasks running : </h5>
      <ul class="pl-0" v-if="tasksToDo.length > 0">
        <li v-for="(task, index) in tasksToDo" :key="index">{{ task }}</li>
      </ul>
      <p v-else>
        No running tasks in this project
      </p>
      <a v-bind:href="uriProject"><button class="btn btn-primary btn-block">{{buttonText}}</button></a>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    name: String,
    tasksToDo: Array,
    buttonText: String,
    uriProject: String
  }
};
</script>

<style lang="scss" scoped>

</style>
