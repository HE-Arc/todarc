<template>
  <div class="node-task">
    <span v-if="task(id)" font-color="green" class="label">{{ task(id).name }}</span>
  </div>
</template>

<script>
import { mapGetters } from 'vuex';

export default {
  name: "nodeTask",
  props: {
    id: Number
  },
  computed: {
    task2(){
      return this.$store.getters["tasksModule/task"](this.id);
    },
    ...mapGetters({
      task: 'tasksModule/task',
    })
  }
};
</script>