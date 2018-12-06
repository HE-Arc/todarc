<template>
  <li class="node node-group">
    <span @contextmenu.prevent="contextMenuGroup($event, group)" @dblclick="editMe" v-if="group" class="list-group-item align-items-center d-flex">
      <span class="flex-grow-1">{{ group.name }}</span>
      <button class="btn btn-link">
        <i class="fas fa-plus"></i>
      </button>
      <button class="btn btn-link">
        <i class="fas fa-pen"></i>
      </button>
      <button class="btn btn-link">
        <i class="fas fa-trash"></i>
      </button>
      <i class="fas fa-arrows-alt ml-1 handle"></i>
    </span>

    <draggable element="ol" class="min-height list-group" :list="groupsNew" :options="{handle:'.handle', group:'group', draggable:'.node-group', animation:200}" @change="changeGroups">
      <node-group v-for="group in groupsNew" :key="group.id" :id="group.id"></node-group>
    </draggable>

    <draggable element="ol" class="min-height list-task" :list="tasksNew" :options="{handle:'.handle', group:'task', draggable:'.node-task', animation:200}" @change="changeTasks">
      <task-group v-for="task in tasksNew" :key="task.id" :id="task.id" v-if="!runningOnly || task.done == false"></task-group>
    </draggable>
  </li>
</template>

<script>
import taskGroup from "./NodeTask";
import draggable from "vuedraggable";

import { BUS } from "../BusEvent";

export default {
  name: 'NodeGroup',
  props: {
    id: Number
  },
  inject: ['tasks', 'groups', 'updateGroups', 'updateTasks', 'editGroup', 'contextMenuGroup'],
  data() {
    return {
      group: null,
      groupsNew: [],
      tasksNew: [],
      runningOnly: true
    };
  },
  methods: {
    changeGroups(evt){
      if(this.groupsNew.length>0)
        this.updateGroups(this.groupsNew, this.id);
    },
    changeTasks(evt){
      if(this.tasksNew.length>0)
        this.updateTasks(this.tasksNew, this.id);
    },
    addGroup(group){
      if(group.group_id == this.id){
        this.groupsNew.push(group);
      }
    },
    addTask(task){
      if(task.group_id == this.id){
        this.tasksNew.push(task);
      }
    },
    editMe(){
      this.editGroup(this.group);
    },
    editedGroup(group){
      if(group.id == this.id){
        this.group = group;
      }
    },
    editedTask(taskEdited){
      let index = this.tasksNew.findIndex(task => task.id == taskEdited.id);
      if(index < 0){
        //Task changed to this group ?
        if(taskEdited.group_id == this.id){
          this.tasksNew.push(taskEdited);
        }
      }else{
        //Task updated
        this.tasksNew.splice(index, 1, taskEdited);
      }
      this.tasksNew = this.tasksNew.filter(task=>task.group_id == this.id).sort((t1, t2) => t1.sort < t2.sort);
    },
    removedTask(taskId){
      this.tasksNew = this.tasksNew.filter(task=>task.id!=taskId);
    },
    taskFiltered(runningOnly){
      this.runningOnly = runningOnly;
    }
  },
  components: {
    taskGroup,
    draggable
  },
  mounted() {
    this.groupsNew = this.groups.filter(group => group.group_id === this.id);
    this.tasksNew = this.tasks.filter(task => task.group_id === this.id);
    this.group = this.groups.find(group => group.id === this.id);

    BUS.$on('addTask', this.addTask);
    BUS.$on('addGroup', this.addGroup);
    BUS.$on('editedGroup', this.editedGroup);
    BUS.$on('editedTask', this.editedTask);
    BUS.$on('removedTask', this.removedTask);
    BUS.$on('taskFiltered', this.taskFiltered);
  }
};
</script>

<style lang="scss" scoped>
.min-height
{
  min-height: 20px;
}
button
{
  color: white;
  padding-left: 6px;
  padding-right: 6px;
  margin-top: 2px;
}
button:hover
{
  color: lightgreen;


}
</style>
