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
        <div class="col-md-6">
          <button type="button" class="btn btn-primary btn-block" data-toggle="modal" data-target="#add-task">Add Task</button>
        </div>
        <div class="col-md-6">
          <button type="button" class="btn btn-primary btn-block" data-toggle="modal" data-target="#add-group">Add Group</button>
        </div>
      </div>
    </div>
  
    <div class="modal fade" id="add-task" tabindex="-1" role="dialog">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h3 class="modal-title">Add a task</h3>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form>
              <div class="row">
                <div class="col-md-12 mb-3">
                  <label for="firstName">Name</label>
                  <input type="text" class="form-control" id="firstName" placeholder="Name" value required>
                  <div class="invalid-feedback">
                    Valid first name is required.
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-md-12 mb-3">
                  <label for="country">Group</label>
                  <select class="custom-select d-block w-100" id="group" required>
                    <option value="">Choose...</option>
                    <option>United States</option>
                    <!-- TODO add existing groups -->
                  </select>
                  <div class="invalid-feedback">
                    Please select a valid group.
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-md-6 mb-3">
                  <label for="drom-date">From date</label>
                  <input type="date" class="form-control" id="from-date">
                </div>
                <div class="col-md-6 mb-3">
                  <label for="due-date">Due date</label>
                  <input type="date" class="form-control" id="due-date">
                </div>
              </div>
              <hr class="mb-3">
              <h4 class="mb-3">Status</h4>
              <div class="custom-control custom-checkbox">
                <input type="checkbox" class="custom-control-input" id="same-address">
                <label class="custom-control-label" for="same-address">Done</label>
              </div>
              <!-- <button class="btn btn-primary btn-lg btn-block" type="submit">Continue to checkout</button> -->
            </form>
            <!-- name -> OK -->
            <!-- order -> OK -->
            <!-- group_id -> TODO fill list -->
            <!-- from Date -> OK -->
            <!-- until date -> OK -->
            <!-- done -> TODO -->
            <!-- 
              TODO :
              -> check date order
              -> valid group_id
              -> Add task
              -->
          </div>
          <div class="card-footer">
            <button type="button" class="btn btn-primary">Add task</button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
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
