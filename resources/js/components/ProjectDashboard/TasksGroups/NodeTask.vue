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
    <button  @click="addTask" class="btn btn-link">
      <i class="fas fa-plus"></i>
    </button>
    <button  @click="editMe" class="btn btn-link">
      <i class="fas fa-pen"></i>
    </button>
    <button @click="removeMe" class="btn btn-link">
      <i class="fas fa-trash"></i>
    </button>
    <i class="fas fa-arrows-alt ml-1 handle"></i>
  </div>
</template>

<script>
import { BUS } from "../BusEvent";
import TaskLabel from "../Label/Label";

export default {
  name: "nodeTask",
  inject:['tasks', 'createTask', 'editTask', 'removeTask', 'contextMenuTask'],
  props: {
    id: Number
  },
  data() {
    return {
      task: this.tasks.find(task => task.id == this.id),
    };
  },
  methods:{
    addTask(){
      this.createTask(this.task.group_id);
    },
    editMe(){
      this.editTask(this.task);
    },
    removeMe(){
      this.removeTask(this.task);
    },
    refreshTasks(tasks){
      let taskClone = tasks.find(taskData => taskData.id == this.id)
      if(taskClone != null){
        this.task = taskClone;
      }
    },
  },
  components: {
    TaskLabel,
  },
  mounted(){
    // BUS.$on('editedLabel', this.editedLabel);
    BUS.$on('refreshTasks', this.refreshTasks);
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

button {
  color: white;
  padding-left: 6px;
  padding-right: 6px;
  margin-top: 2px;
}

button:hover {
  color: lightgreen;
}
</style>
