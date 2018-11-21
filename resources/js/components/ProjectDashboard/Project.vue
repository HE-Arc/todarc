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
        <ModalTask ref="modalTask" @add="addTask" @edit="editedTask" v-bind:groups="groups" class="col-md-6"></ModalTask>
        <ModalGroup ref="modalGroup" @add="addGroup" @edit="editedGroup" v-bind:groups="groups" class="col-md-6"></ModalGroup>
      </div>
    </div>
  </div>
</template>

<script>
import TreeGroups from "./TreeGroups";
import ModalTask from "./ModalTask";
import ModalGroup from "./ModalGroup";
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
    ModalTask,
    ModalGroup,
  },
  methods:{
    editTask(task){
      this.$refs.modalTask.openEdition(task);
    },
    editGroup(group){
      this.$refs.modalGroup.openEdition(group);
    },
    editedTask(task){
      return axios
        .patch('/tasks/'+task.id,task)
        .then((taskUpdated) => {
          let i = this.tasksData.indexOf(this.tasksData.find(task=>task.id==taskUpdated.data.id));
          this.tasksData[i] = taskUpdated.data;
          bus.$emit('editedTask', taskUpdated.data);
        })
        .catch();
    },
    editedGroup(group){
      return axios
        .patch('/groups/'+group.id,group)
        .then((groupUpdated) => {
          let i = this.groupsData.indexOf(this.groupsData.find(group=>group.id==groupUpdated.data.id));
          this.groupsData[i] = groupUpdated.data;
          bus.$emit('editedGroup', groupUpdated.data);
        })
        .catch();
    },
    addTask(task){
      task.group_id = task.group_id?task.group_id:"";
      return axios
        .post('/projects/'+this.project.id+'/tasks',task)
        .then((taskAdded) => {
          this.tasksData.push(taskAdded.data);
          bus.$emit('addTask', taskAdded.data);
        })
        .catch();
    },
    addGroup(group){
      group.project_id = this.project.id;
      return axios
        .post('/projects/'+this.project.id+'/groups',group)
        .then((groupAdded) => {
          this.groupsData.push(groupAdded.data);
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
      editTask : this.editTask,
      editGroup : this.editGroup,
      updateTasks : this.updateTasks,
      updateGroups : this.updateGroups,
    }
  },
};
</script>

<style lang="scss" scoped>
</style>
