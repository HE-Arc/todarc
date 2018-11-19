<template>
  <div class="card">
    <h4 class="card-header">Tasks</h4>
    <div class="card-body">
      <h6>Tasks running : </h6>
      <tree-groups :groups="groups"></tree-groups>
    </div>
    <div class="card-footer">
      <a><button class="btn btn-light btn-block">Clic for no reason, feels free</button></a>
    </div>
  </div>
</template>

<script>
import treeGroups from "./TreeGroups";

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
  components: {
    treeGroups
  },
  methods:{
    addGroup(){

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
