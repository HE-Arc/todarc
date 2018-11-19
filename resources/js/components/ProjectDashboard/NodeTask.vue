<template>
  <div class="node node-task">
    <span font-color="green" class="label">{{ task.name }}</span>
  </div>
</template>

<script>
import { mapGetters } from 'vuex';

export default {
  name: "nodeTask",
  props: {
    id: Number,
    task: Object
  },
  inject:["tasks"],
  mounted(){
    this.task = this.tasks.find(task => task.id == this.id);
  }
};
</script>