<template>
  <div class="card">
    <div class="card-header modal-header">
      <h4>
        Tasks
      </h4>
      <div class="custom-control custom-checkbox">
        <input type="checkbox" class="custom-control-input" id="customCheck1" checked="">
        <label class="custom-control-label" for="customCheck1">Running tasks</label>
      </div>
    </div>
    <div class="card-body">
      <tree-groups :groups="groups"></tree-groups>
    </div>
    <div class="card-footer">
      <div class="row">
        <AddTask @add="addTask" v-bind:groups="groups" class="col-md-6"></AddTask>
        <AddGroup @add="addGroup" v-bind:groups="groups" class="col-md-6"></AddGroup>
      </div>
    </div>
  </div>
</template>

<script>
import TreeGroups from "./TreeGroups";
import AddTask from "./AddTask";
import AddGroup from "./AddGroup";
import { bus } from "./BusEvent";

export default {
  props: {
    project: {
      required: true
    },
    groups: {
      required: true
    },
    tasks: {
      required: true
    }
  },
  data(){
    return {
      tasksData: [],
      groupsData: [],
    };
  },
  mounted(){
    this.tasksData = this.tasks;
    this.groupsData = this.groups;
  },
  components: {
    TreeGroups,
    AddTask,
    AddGroup,
  },
  methods:{
    addTask(task){
      return axios
        .post('/projects/'+this.project.id+'/tasks',task)
        .then((taskAdded) => {
          console.log(taskAdded.data)
          this.tasksData.push(taskAdded.data);
          console.log(taskAdded.data)
          bus.$emit('addTask', taskAdded.data);
        })
        .catch();
    },
    addGroup(group){
      group.project_id = this.project.id;

      return axios
        .post('/projects/'+this.project.id+'/groups',group)
        .then((groupAdded) => {
          console.log(groupAdded.data)
          this.groupsData.push(groupAdded.data);
          console.log(groupAdded.data)
          bus.$emit('addGroup', groupAdded.data);
        })
        .catch();
    },
    updateGroups(data, group_id){
      data.map((group,index)=>{
        group.order = index;
        group.group_id = group_id;
      });

      return axios
        .post('/projects/'+this.project.id+'/groups-hierarchy',{
          groups: data
        })
        .then(() => {
          console.log("Groups updated successfully");
        })
        .catch();
    },
    updateTasks(data, group_id){
      data.map((task,index)=>{
        task.order = index;
        task.group_id = group_id;
      });

      return axios
        .post('/projects/'+this.project.id+'/tasks-hierarchy',{
          tasks: data
        })
        .then(() => {
          console.log("Tasks updated successfully");
        })
        .catch();
    }
  },
  provide(){
    return {
      tasks : this.tasks,
      groups : this.groups,
      addGroup : this.addGroup,
      updateTasks : this.updateTasks,
      updateGroups : this.updateGroups,
    }
  },
};
</script>

<style lang="scss" scoped>
</style>
