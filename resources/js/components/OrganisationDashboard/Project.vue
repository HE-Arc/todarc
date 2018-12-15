<template>
  <div class="card text-center">
    <h4 class="card-header">{{ name }}</h4>
    <div class="card-body">
      <h6>Tasks : </h6>
      <ul class="pl-0" v-if="tasksToDo.length > 0">
        <li v-for="(task, index) in tasksToDo" :key="index">{{ task }}</li>
      </ul>
      <p v-else>
        No running tasks in this project
      </p>
    </div>
    <div class="card-footer">
      <a v-bind:href="href"><button class="btn btn-primary btn-block">{{buttonText}}</button></a>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    projectId: Number,
    name: String,
    tasksToDo: Array,
    buttonText: String,
    buttonUri: String,
  },
  computed: {
    href(){
      return "/projects/"+this.projectId;
    }
  }
}
</script>

<style lang="scss" scoped>

</style>
