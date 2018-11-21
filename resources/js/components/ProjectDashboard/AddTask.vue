<template>
  <div class="col-md-6">
    <button type="button" class="btn btn-primary btn-block" data-toggle="modal" data-target="#add-task">Add Task</button>
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
                    <option v-for="group in groups" :key="group.id" :value="group.id">{{ group.name }}</option>
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
            <button @click="add" type="button" class="btn btn-primary">Add task</button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          </div>
        </div>
      </div>  
    </div>
  </div>
</template>

<script>
export default {
  name:"add-task",
  props:{
    groups: Array
  },
  methods:{
    close(){
      $(`#add-task`).modal('hide');
    },
    add(){
      //TODO Check data
      let data = {
        created_at:null,
        done:0,
        from_date:null,
        group_id:1,
        id:33,
        name:"New task added",
        order:12,
        project_id:1,
        until_date:null,
        updated_at:null,
        };
      this.$emit('add',data);
      this.close();
    }
  }
}
</script>
