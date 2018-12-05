<template>
  <div @contextmenu.prevent="contextMenuTask($event, task)" class="node node-task list-group-item bg-secondary align-items-center d-flex">
    <div v-if="task" @dblclick="editMe" class="label">{{ task.name }}</div>
    <div class="labels flex-grow-1">
      <task-label
        v-if="task !== null"
        v-for="label in task.labels"
        :key="label.id"
        :id="label.id"
        :task-id="id"
        :name="label.name"
        :color="label.color"
      ></task-label>
    </div>
    <i @click="contextMenuTask($event, task)" class="fas fa-bars mr-1"></i>
    <i class="fas fa-arrows-alt ml-1 handle"></i>
    <div class="actions mr-0">
      <!-- TODO: Add mennu option to display contextual menu -->
    </div>
  </div>
</template>

<script>
import { BUS } from "../BusEvent";
import TaskLabel from "../Label/Label";

export default {
  name: "nodeTask",
  inject:['tasks','editTask', 'contextMenuTask'],
  props: {
    id: Number
  },
  data() {
    return {
      task: this.tasks.find(task => task.id == this.id),
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
  components: {
    TaskLabel,
  },
  mounted(){
    BUS.$on('editedTask', this.editedTask);
  }
};
</script>

<style lang="scss" scoped>
  div {
    display: flex;
    grid-template-columns: auto auto;

    div {
      margin-right: 15px;
    }
  }
</style>
