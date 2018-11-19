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
    updateGroups(data, parent_id){
      data.map((obj,index)=>{
        obj.order = index;
        obj.group_id = parent_id;
      });

      return axios
        .post('/projects/'+this.project.id+'/groups',{
          groups: data
        })
        .then(() => {
          console.log("Groups updated successfully");
        })
        .catch();
    }
  },
  provide(){
    return {
      groups : this.groups,
      tasks : this.tasks,
      addGroup : this.addGroup,
      updateGroups : this.updateGroups,
    }
  },
};
</script>

<style lang="scss" scoped>
</style>
