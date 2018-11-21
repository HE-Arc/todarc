<template>
  <div>
    <button type="button" class="btn btn-primary btn-block" data-toggle="modal" data-target="#add-group">Add Group</button>
    <div class="modal fade" id="add-group" tabindex="-1" role="dialog">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h3 class="modal-title">Add a Group</h3>
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
            <button @click="add" type="button" class="btn btn-primary">Add Group</button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
export default {
  name:"add-group",
  props:{
    groups: Array
  },
  methods:{
    close(){
      $(`#add-group`).modal('hide');
    },
    add(){
      //TODO Check data
      let data = {
        group_id:2,
        name:"New Group Added :)",
        order:12,
        };
      this.$emit('add',data);
      this.close();
    }
  }
}
</script>
