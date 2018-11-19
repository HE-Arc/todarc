<template>
  <div class="node node-task list-group-item bg-secondary">
    <span v-if="task" font-color="green" class="label">{{ task.name }}</span>
  </div>
</template>

<script>
export default {
  name: "nodeTask",
  props: {
    id: Number
  },
  data() {
    return {
      task: null,
    };
  },
  inject:['tasks'],
  mounted(){
    this.task = this.tasks.find(task => task.id == this.id);
  }
};
</script>


<style lang="scss" scoped>

</style>