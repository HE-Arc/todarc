<template>
  <li class="node node-group">
    <span v-if="group" class="label">{{ group.name }} <i class="fas fa-arrows-alt"></i></span>

    <draggable element="ul" class="min-height" :list="groupsNew" :options="{group:'group', draggable:'.node-task', animation:200}" @change="changeGroups">
    
      <node-group v-for="group in groupsNew" :key="group.id" v-bind:id="group.id"></node-group>
    
      <!-- <task-group v-for="task in tasks.filter(x=>x.group_id==id)" :key="task.id" v-bind:id="task.id" class="node node-task"></task-group> -->
    
    </draggable>
    <draggable element="ul" class="min-height" :list="tasksNew" :options="{group:'task', draggable:'.node-task', animation:200}" @change="changeTasks">
    
      <task-group v-for="task in tasksNew" :key="task.id" v-bind:id="task.id"></task-group>
    
    </draggable>
    <!-- <button>Add group</button> -->
  </li>
</template>

<script>
import taskGroup from "./NodeTask";
import { mapState, mapGetters } from "vuex";

import draggable from "vuedraggable";

export default {
  name: 'NodeGroup',
  props: {
    id: Number
  },
  inject: ['groups', 'tasks', 'updateGroups', 'updateTasks'],
  data() {
    return {
      group: null,
      groupsNew: [],
      tasksNew: [],
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
  }
};
</script>

<style>
.min-height{
  min-height: 20px;
}
</style>
