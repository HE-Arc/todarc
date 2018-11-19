<template>
  <div class="tree">
    <h2>List 1</h2>
    
    <draggable element="ul" :list="groupsNew" :options="{group:'group', draggable:'.node-group', animation:200}" @change="change" class="tree-list min-height">
    
      <node-group v-for="group in groupsNew" :key="group.id" v-bind:id="group.id"></node-group>
      <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#add-task">
        Add Task
      </button>
      <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#add-group">
        Add Group
      </button>
    </draggable>

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
          <div class="modal-footer">
            <button type="button" class="btn btn-primary">Add task</button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import NodeGroup from "./NodeGroup";
import draggable from 'vuedraggable';

export default {
  name: "treeGroups",
  inject: ['groups', 'updateGroups'],
  mounted(){
    this.$store.dispatch('groupsModule/fetch');
  },
  data: function() {
    return {
      groupsNew: []
    }
  },
  methods:{
    change(evt){
      this.updateGroups(this.groupsNew, null);
    }
  },
  components: {
    NodeGroup,
    draggable
  },
  mounted() {
    this.groupsNew = this.groups.filter(g => g.group_id === null);
  }
};
</script>

<style lang="scss" scoped>
.node {
  padding-left: 16px;
  margin: 6px 0;
}
.node-task {
  background-color: red;
}
.min-height{
  min-height: 20px;
}
</style>