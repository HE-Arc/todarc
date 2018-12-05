<template>
  <div class="card text-center">
    <h4 class="card-header">{{ name }}</h4>
    <div class="card-body">
      <h6>Tasks running : </h6>
      <ul>
        <li v-for="task in tasksToDo" :key="task.id">{{ task.name }}</li>
      </ul>
      <a :href="href"><button class="btn btn-primary btn-block">{{buttonText}}</button></a>
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
