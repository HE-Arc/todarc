<template>
  <li class="node node-group">
    <span v-on:dblclick="editMe" v-if="group" class="list-group-item">{{ group.name }}<i class="fas fa-arrows-alt"></i></span>

    <draggable element="ol" class="min-height list-group" :list="groupsNew" :options="{group:'group', draggable:'.node-group', animation:200}" @change="changeGroups">
    
      <node-group v-for="group in groupsNew" :key="group.id" v-bind:id="group.id"></node-group>
    
    </draggable>
    
    <draggable element="ol" class="min-height list-group" :list="tasksNew" :options="{group:'task', draggable:'.node-task', animation:200}" @change="changeTasks">
    
      <task-group v-for="task in tasksNew" :key="task.id" v-bind:id="task.id"></task-group>
    
    </draggable>
    <!-- <button>Add group</button> -->
  </li>
</template>

<script>
import taskGroup from "./NodeTask";
import draggable from "vuedraggable";

import { bus } from "./BusEvent";

export default {
  name: 'NodeGroup',
  props: {
    id: Number
  },
  inject: ['tasks', 'groups', 'updateGroups', 'updateTasks', 'editGroup'],
  data() {
    return {
      group: null,
      groupsNew: [],
      tasksNew: [],
      tasksData: []
    };
  },
  methods:{
    changeGroups(evt){
      if(this.groupsNew.length>0)
        this.updateGroups(this.groupsNew, this.id);
    },
    changeTasks(evt){
      if(this.tasksNew.length>0)
        this.updateTasks(this.tasksNew, this.id);
    },
    addGroup(group){
      console.log(group.group_id)
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
    }
  },
  components: {
    taskGroup,
    draggable
  },
  mounted(){
    this.groupsNew = this.groups.filter(group => group.group_id === this.id);
    this.tasksNew = this.tasks.filter(task => task.group_id === this.id);
    this.group = this.groups.find(group => group.id === this.id);
    
    bus.$on('addTask', this.addTask);
    bus.$on('addGroup', this.addGroup);
    bus.$on('editedGroup', this.editedGroup);
  }
};
</script>

<style lang="scss" scoped>
.min-height{
  min-height: 20px;
}
</style>
