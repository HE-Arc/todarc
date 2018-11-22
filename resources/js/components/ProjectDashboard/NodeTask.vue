<template>
  <div class="node node-task list-group-item bg-secondary">
    <span @contextmenu.prevent="contextMenuTask($event, task)" v-if="task" v-on:dblclick="editMe" class="label">{{ task.name }}</span>
  </div>
</template>

<script>
import { bus } from "./BusEvent";

export default {
  name: "nodeTask",
  inject:['tasks','editTask', 'contextMenuTask'],
  props: {
    id: Number
  },
  data() {
    return {
      task: null,
    };
  },
  methods:{
    editMe(){
      this.editTask(this.task);
    },
    editedTask(task){
      if(task.id == this.id){
        this.task = task;
      }
    }
  },
  mounted(){
    this.task = this.tasks.find(task => task.id == this.id);
    bus.$on('editedTask', this.editedTask);
  }
};
</script>


<style lang="scss" scoped>

</style>