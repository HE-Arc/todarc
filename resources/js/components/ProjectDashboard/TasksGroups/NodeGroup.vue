<template>
  <li class="node node-group">
    <span @contextmenu.prevent="contextMenuGroup($event, group)" @dblclick="editMe" v-if="group" class="list-group-item align-items-center d-flex">
      <button v-if="open" @click="switchDetails" class="btn btn-link">
        <i class="fas fa-angle-down"></i>
      </button>
      <button v-if="!open" @click="switchDetails" class="btn btn-link">
        <i class="fas fa-angle-right"></i>
      </button>
      <span class="flex-grow-1">{{ group.name }}</span>
      <button  @click="addChild" class="btn btn-link">
        <i class="fas fa-plus"></i>
      </button>
      <button  @click="editMe" class="btn btn-link">
        <i class="fas fa-pen"></i>
      </button>
      <button @click="removeMe" class="btn btn-link">
        <i class="fas fa-trash"></i>
      </button>
      <i class="fas fa-arrows-alt ml-1 handle"></i>
    </span>

    <draggable v-if="open" element="ol" class="min-height list-group" :list="groupsNew" :options="{handle:'.handle', group:'group', draggable:'.node-group', animation:200}" @change="changeGroups">
      <node-group v-for="group in groupsNew" :key="group.id" :id="group.id"></node-group>
    </draggable>

    <draggable v-if="open" element="ol" class="min-height list-task" :list="tasksNew" :options="{handle:'.handle', group:'task', draggable:'.node-task', animation:200}" @change="changeTasks">
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
  inject: [
    'tasks',
    'groups',
    'editGroup',
    'createGroup',
    'removeGroup',
    'updateTasks',
    'updateGroups',
    'contextMenuGroup'
  ],
  data() {
    return {
      open: true,
      group: null,
      groupsNew: [],
      tasksNew: [],
      runningOnly: true
    };
  },
  methods: {
    switchDetails(){
      this.open = !this.open;
    },
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
    removeMe(){
      this.removeGroup(this.group);
    },
    addChild(){
      this.createGroup(this.id);
    },
    filteredTasks(runningOnly){
      this.runningOnly = runningOnly;
    },
    editedGroup(group){
      if(group.id == this.id){
        this.group = group;
      }
    },
    refreshTasks(taskData){
      this.tasksNew = taskData.filter(task=>task.group_id==this.id);
    },
    refreshGroups(groupsData){
      this.groupsNew = groupsData.filter(group=>group.group_id==this.id);
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

    BUS.$on('editedGroup', this.editedGroup);
    BUS.$on('filteredTasks', this.filteredTasks)

    BUS.$on('refreshTasks', this.refreshTasks);
    BUS.$on('refreshGroups', this.refreshGroups);
  }
};
</script>

<style lang="scss" scoped>
.min-height {
  min-height: 20px;
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
