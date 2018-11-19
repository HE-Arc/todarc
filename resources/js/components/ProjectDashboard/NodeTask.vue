<template>
  <div class="node node-task">
    <span v-if="task" font-color="green" class="label">{{ task.name }}</span>
  </div>
</template>

<script>
import { mapGetters } from 'vuex';

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