<template>
  <div class="card">
    <div class="card-header modal-header">
      <h4 @contextmenu.prevent="$refs.menuGroup.open">
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
        <ModalTask ref="modalTask" @add="addTask" @edit="editedTask" :labels="labels" :groups="groups" class="col-md-6"></ModalTask>
        <ModalGroup ref="modalGroup" @add="addGroup" @edit="editedGroup" :groups="groups" class="col-md-6"></ModalGroup>
      </div>
    </div>
    <vue-context ref="menuGroup" id="menuGroup">
      <div class="dropdown-menu dropdown-menu-sm show" slot-scope="group">
        <a @click="createGroup()" class="dropdown-item" href="#"><i class="fas fa-plus"></i> Add new Group</a>
        <a @click="editGroup(group.data)" class="dropdown-item" href="#"><i class="fas fa-pencil-alt"></i> Edit</a>
        <!-- <a @click="" class="dropdown-item" href="#"><i class="far fa-trash-alt"></i> Remove</a> -->
        <div class="dropdown-divider"></div>
        <a class="dropdown-item" href="#">Have some fun</a>
      </div>
    </vue-context>
    <vue-context ref="menuTask" id="menuTask">
      <div class="dropdown-menu dropdown-menu-sm show" slot-scope="task">
        <a @click="createTask()" class="dropdown-item" href="#"><i class="fas fa-plus"></i> Add new Task</a>
        <a @click="editTask(task.data)" class="dropdown-item" href="#"><i class="fas fa-pencil-alt"></i> Edit</a>
        <!-- <a @click="" class="dropdown-item" href="#"><i class="far fa-trash-alt"></i> Remove</a> -->
        <div class="dropdown-divider"></div>
        <a class="dropdown-item" href="#">Have some fun</a>
      </div>
    </vue-context>
  </div>
</template>

<script>
import { VueContext } from 'vue-context';
import TreeGroups from "./TasksGroups/TreeGroups";
import ModalTask from "./TasksGroups/ModalTask";
import ModalGroup from "./TasksGroups/ModalGroup";
import BUS from "./BusEvent";

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
    },
    labels: {
      required: true
    }
  },
  data() {
    return {
      tasksData: [],
      groupsData: [],
      options: [
        {name:"add"},
        {name:"edit"}
      ]
    };
  },
  mounted() {
    this.tasksData = this.tasks;
    this.groupsData = this.groups;
  },
  components: {
    VueContext,
    TreeGroups,
    ModalTask,
    ModalGroup,
  },
  methods: {
    createTask(){
      this.$refs.modalTask.openCreation();
    },
    createGroup(){
      this.$refs.modalGroup.openCreation();
    },
    editTask(task){
      this.$refs.modalTask.openEdition(task);
    },
    editGroup(group){
      this.$refs.modalGroup.openEdition(group);
    },
    contextMenuGroup(event, group){
      this.$refs.menuGroup.open(event, group);
    },
    contextMenuTask(event, task){
      this.$refs.menuTask.open(event, task);
    },
    editedTask(task){
      return axios
        .patch(`/tasks/${task.id}`,task)
        .then((taskUpdated) => {
          let i = this.tasksData.indexOf(this.tasksData.find(task=>task.id==taskUpdated.data.id));
          this.tasksData[i] = taskUpdated.data;
          console.log("Edited");
          console.log(taskUpdated.data);
          BUS.$emit('editedTask', taskUpdated.data);
        })
        .catch();
    },
    editedGroup(group){
      return axios
        .patch(`/groups/${group.id}`,group)
        .then((groupUpdated) => {
          let i = this.groupsData.indexOf(this.groupsData.find(group=>group.id==groupUpdated.data.id));
          this.groupsData[i] = groupUpdated.data;
          BUS.$emit('editedGroup', groupUpdated.data);
        })
        .catch();
    },
    addTask(task){
      task.group_id = task.group_id?task.group_id:"";
      return axios
        .post(`/projects/${this.project.id}/tasks`,task)
        .then((taskAdded) => {
          this.tasksData.push(taskAdded.data);
          BUS.$emit('addTask', taskAdded.data);
        })
        .catch();
    },
    addGroup(group){
      group.project_id = this.project.id;
      return axios
        .post(`/projects/${this.project.id}/groups`,group)
        .then((groupAdded) => {
          this.groupsData.push(groupAdded.data);
          BUS.$emit('addGroup', groupAdded.data);
        })
        .catch();
    },
    updateGroups(data, group_id){
      data.map((group,index)=>{
        group.order = index;
        group.group_id = group_id;
      });

      return axios
        .post(`/projects/${this.project.id}/groups-hierarchy`,{
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
        .post(`/projects/${this.project.id}/tasks-hierarchy`,{
          tasks: data
        })
        .then(() => {
          console.log("Tasks updated successfully");
        })
        .catch();
    },
  },
  watch: {
    nbTasksDone() {
      this.$emit('tasks-changed', this.nbTasksDone, this.nbTasksRunning);
    },
    nbTasksRunning() {
      this.$emit('tasks-changed', this.nbTasksDone, this.nbTasksRunning);
    }
  },
  computed: {
    nbTasksDone() {
      let nbTasksDone = 1;

      this.tasksData.forEach(function(task) {
        if(task.done) {
          nbTasksDone++;
        }
      });

      return nbTasksDone;
    },
    nbTasksRunning() {
      return this.tasksData.length - this.nbTasksDone
    }
  },
  provide() {
    return {
      tasks : this.tasks,
      groups : this.groups,
      editTask : this.editTask,
      editGroup : this.editGroup,
      updateTasks : this.updateTasks,
      updateGroups : this.updateGroups,
      contextMenuTask : this.contextMenuTask,
      contextMenuGroup : this.contextMenuGroup,
    }
  },
};
</script>

<style lang="scss" scoped>
#menuGroup, #menuTask {
  border: none;
}
</style>
