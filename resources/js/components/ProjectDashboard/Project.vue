<template>
  <div class="card mb-3">
    <div class="card-header modal-header">
      <h4 @contextmenu.prevent="$refs.menuGroup.open">
        Tasks
      </h4>
      <div class="custom-control custom-checkbox">
        <input type="checkbox" class="custom-control-input" id="customCheck1" v-model="activeOnly" checked="">
        <label class="custom-control-label" for="customCheck1">Running tasks</label>
      </div>
    </div>
    <div class="card-body">
      <tree-groups :groups="groups"></tree-groups>
    </div>
    <div class="card-footer">
      <div class="row">
        <modal-task ref="modalTask" @add="addTask" @edit="editedTask" :labels="labels" :groups="groups" :users="project.users" class="col-6"></modal-task>
        <modal-group ref="modalGroup" @add="addGroup" @edit="editedGroup" :groups="groups" class="col-6"></modal-group>
      </div>
    </div>
    <vue-context ref="menuGroup" id="menuGroup">
      <div class="dropdown-menu dropdown-menu-sm show" slot-scope="group">
        <a @click="createGroup()" class="dropdown-item" href="#"><i class="fas fa-plus"></i> Add new Group</a>
        <a @click="editGroup(group.data)" class="dropdown-item" href="#"><i class="fas fa-pencil-alt"></i> Edit</a>
        <div class="dropdown-divider"></div>
        <a @click="removeGroup(group.data)" class="dropdown-item" href="#"><i class="far fa-trash-alt"></i> Remove</a>
      </div>
    </vue-context>
    <vue-context ref="menuTask" id="menuTask">
      <div class="dropdown-menu dropdown-menu-sm show" slot-scope="task">
        <a @click="createTask()" class="dropdown-item" href="#"><i class="fas fa-plus"></i> Add new Task</a>
        <a @click="editTask(task.data)" class="dropdown-item" href="#"><i class="fas fa-pencil-alt"></i> Edit</a>
        <div class="dropdown-divider"></div>
        <a @click="removeTask(task.data)" class="dropdown-item" href="#"><i class="far fa-trash-alt"></i> Remove</a>
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
      labelsData: [],
      options: [
        {name:"add"},
        {name:"edit"}
      ],
      activeOnly: true
    };
  },
  components: {
    VueContext,
    TreeGroups,
    ModalTask,
    ModalGroup,
  },
  methods: {
    createTask(parentId){
      this.$refs.modalTask.openCreation(parentId);
    },
    createGroup(parentId){
      this.$refs.modalGroup.openCreation(parentId);
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
        .patch(`/projects/${this.project.id}/tasks/${task.id}`,task)
        .then((taskUpdated) => {
          let i = this.tasksData.indexOf(this.tasksData.find(task=>task.id==taskUpdated.data.id));
          this.tasksData[i] = taskUpdated.data;

          BUS.$emit('editedTask', taskUpdated.data);
          BUS.$emit('refreshTasks', this.tasksData);
        })
        .catch();
    },
    editedGroup(group){
      return axios
        .patch(`/projects/${this.project.id}/groups/${group.id}`,group)
        .then((groupUpdated) => {
          let i = this.groupsData.indexOf(this.groupsData.find(group=>group.id==groupUpdated.data.id));
          this.groupsData[i] = groupUpdated.data;
          
          BUS.$emit('refreshGroups', this.groupsData);
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
          this.tasksData = this.tasksData.sort((t1, t2) => t1.order > t2.order);

          BUS.$emit('refreshTasks', this.tasksData);
        })
        .catch();
    },
    addGroup(group){
      group.project_id = this.project.id;
      return axios
        .post(`/projects/${this.project.id}/groups`,group)
        .then((groupAdded) => {
          this.groupsData.push(groupAdded.data);
          this.groupsData = this.groupsData.sort((t1, t2) => t1.order > t2.order);

          BUS.$emit('refreshGroups', this.groupsData);
        })
        .catch();
    },
    addLabel(label){
      return axios
      .post( `/projects/${this.project.id}/labels`, label)
      .then(response => {
        this.labelsData.push(response.data);

        BUS.$emit('refreshLabels', this.labelsData);
      })
      .catch();
    },
    updateTask(task){
      return axios
        .patch(`/projects/${this.project.id}/tasks/${task.id}`,task)
        .then((taskUpdated) => {
          let index = this.tasksData.findIndex(task => task.id == taskUpdated.data.id);
          this.tasksData[index] = taskUpdated.data;
          this.tasksData = this.tasksData.sort((t1, t2) => t1.order > t2.order);

          BUS.$emit('editedTask', taskUpdated.data);
          BUS.$emit('refreshTasks', this.tasksData);
        })
        .catch();
    },
    updateGroup(group){
      return axios
        .patch(`/projects/${this.project.id}/groups/${group.id}`,group)
        .then((response) => {
          let index = this.groupsData.findIndex(group => group.id == response.data.id);
          this.groupsData[index] = response.data;
          this.groupsData = this.groupsData.sort((t1, t2) => t1.order > t2.order);

          BUS.$emit('editedGroup', response.data);
          BUS.$emit('refreshGroups', this.groupsData);
        })
        .catch();
    },
    updateLabel(labelEdited){
      axios.put(`/projects/${this.project.id}/labels/${labelEdited.id}`, labelEdited)
      .then(response => {
        this.labelsData = this.labelsData.filter(label => label.id != response.data.id);
        this.labelsData.push(response.data)

        this.tasksData.forEach(task => {
          let label = task.labels.find(labelClone => labelClone.id == response.data.id);

          if(label != undefined){
            task.labels = task.labels.filter(labelClone => labelClone.id != labelEdited.id)
            task.labels.push(response.data);
          }
        });

        BUS.$emit('refreshTasks', this.tasksData);
        BUS.$emit('refreshLabels', this.labelsData);
      })
      .catch();
    },
    updateGroups(data, group_id){
      data.map((group,index)=>{
        group.order = index;
        group.group_id = group_id;
      });

      return axios
        .post(`/projects/${this.project.id}/groups-hierarchy`,{ groups: data })
        .then((response) => {
          this.groupsData.forEach(group => {
            let clone = data.find(groupSearch => groupSearch.id == group.id);
            if(clone != null){
              group.group_id = clone.group_id;
              group.order = clone.order;
            }
          });

          this.groupsData = this.groupsData.sort((t1, t2) => t1.order > t2.order);
          BUS.$emit('refreshGroups', this.groupsData);
        })
        .catch();
    },
    updateTasks(data, group_id){ //Order
      data.map((task,index)=>{
        task.order = index;
        task.group_id = group_id;
      });

      return axios
        .post(`/projects/${this.project.id}/tasks-hierarchy`,{ tasks: data })
        .then(() => {
          this.tasksData.forEach(task => {
            let clone = data.find(taskSearch => taskSearch.id == task.id);
            if(clone != null){
              task.group_id = clone.group_id;
              task.order = clone.order;
            }
          });

          this.tasksData = this.tasksData.sort((t1, t2) => t1.order > t2.order);
          BUS.$emit('refreshTasks', this.tasksData);
        })
        .catch();
    },
    removeTask(task){
      if(!confirm("Are you sure you want to remove this task?\nThis action can't be reversed!")){
        return;
      }

      return axios
        .delete(`/projects/${this.project.id}/tasks/${task.id}`)
        .then((taskToRemove) => {
          this.tasksData = this.tasksData.filter(taskClone => taskClone.id != task.id);

          BUS.$emit('refreshTasks', this.tasksData);
        })
        .catch();
    },
    removeGroup(group){
      if(!confirm("Are you sure you want to remove this group?\nThis action can't be reversed!")){
        return;
      }
      return axios
        .delete(`/projects/${this.project.id}/groups/${group.id}`)
        .then((message) => {
          this.groupsData = this.groupsData.filter(groupClone => groupClone.id != group.id);

          BUS.$emit('refreshGroups', this.groupsData);
        })
        .catch();
    },
    removeLabel(labelId){
      axios.delete(`/projects/${this.project.id}/labels/${labelId}`)
      .then(response => {
        this.labelsData = this.labelsData.filter(label => label.id != labelId);

        this.tasksData.forEach(task => {
          task.labels = task.labels.filter(label => label.id != labelId);
        })

        BUS.$emit('refreshTasks', this.tasksData);
        BUS.$emit('refreshLabels', this.labelsData);
      })
      .catch();
    },
    removeTaskLabel(taskId, labelId){
      axios.delete(`${window.location}/tasks/${taskId}/labels/${labelId}`)
      .then(response => {
        let task = this.tasksData.find(task => task.id == taskId);
        task.labels = task.labels.filter(label => label.id != labelId);

        BUS.$emit('editedTask', task);
        BUS.$emit('refreshTasks', this.tasksData);
        BUS.$emit('refreshLabels', this.labelsData);
      }).catch();
    },
  },
  watch: {
    nbTasksDone() {
      this.$emit('tasksChanged', this.nbTasksDone, this.nbTasksRunning);
    },
    nbTasksRunning() {
      this.$emit('tasksChanged', this.nbTasksDone, this.nbTasksRunning);
    },
    activeOnly() {
      BUS.$emit('filteredTasks', this.activeOnly);
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
      labels : this.labels,
      groups : this.groups,
      editTask : this.editTask,
      editGroup : this.editGroup,

      createTask : this.createTask,
      updateTask : this.updateTask,
      removeTask : this.removeTask,
      createGroup : this.createGroup,
      updateGroup : this.updateGroup,
      removeGroup : this.removeGroup,

      updateTasks : this.updateTasks,
      updateGroups : this.updateGroups,
      contextMenuTask : this.contextMenuTask,
      removeTaskLabel : this.removeTaskLabel,
      contextMenuGroup : this.contextMenuGroup,
    }
  },
  mounted() {
    this.tasksData = this.tasks;
    this.groupsData = this.groups;
    this.labelsData = this.labels;

    BUS.$on('addLabel', this.addLabel);
    BUS.$on('updateLabel', this.updateLabel);
    BUS.$on('removeLabel', this.removeLabel);
  },
};
</script>

<style lang="scss" scoped>
#menuGroup, #menuTask {
  border: none;
}
</style>
