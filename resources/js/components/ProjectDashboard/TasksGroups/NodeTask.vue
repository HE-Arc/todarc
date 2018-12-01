<template>
  <div class="node node-task list-group-item bg-secondary">
    <div @contextmenu.prevent="contextMenuTask($event, task)" v-if="task" @dblclick="editMe" class="label">{{ task.name }}</div>
    <div class="labels">
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
    <div class="actions">
      <!-- TODO Change arrow location to end of line -->
      <i class="fas fa-arrows-alt"></i>
      <!-- TODO Add mennu option to display contextual menu -->
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
