<template>
  <div>
    <button @click="open" type="button" class="btn btn-primary btn-block" data-toggle="modal" data-target="#add-group">Add Group</button>
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
                  <input v-model="name" type="text" class="form-control" id="firstName" placeholder="Name" value required>
                  <div id="invalid-name" class="invalid-feedback">
                    Valid name is required.
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-md-12 mb-3">
                  <label for="country">Group</label>
                  <select v-model="group_id" class="custom-select d-block w-100" id="group" required>
                    <option :value="group_default">Root location</option>
                    <option v-for="group in groups" :key="group.id" :value="group.id">{{ group.name }}</option>
                  </select>
                  <div id="invalid-group" class="invalid-feedback">
                    Please select a valid group.
                  </div>
                </div>
              </div>
            </form>
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
    groups: {
      type: Array,
      required: true,
    },
    group_root:{
      type: Number,
      default: -1
    }
  },
  data(){
    return {
      group_id: -1,
      name: "",
      order: Number.MAX_SAFE_INTEGER
    }
  },
  methods:{
    open(){
      this.group_id = -1;
      this.data = "";
    },
    close(){
      $(`#add-group`).modal('hide');
    },
    add(){
      //Wrong group param
      if(!(parseInt(this.group_id) == this.group_root || parseInt(this.group_id) in this.groups.map(group=>{return group.id;}))){
        $('#invalid-group').show(true);
        return;
      }
      $('#invalid-group').hide(false);


      //Invalid name
      if(this.name == null || this.name.trim() == ""){
        $('#invalid-name').show(true);
        return;
      }
      $('#invalid-name').hide(false);

      if(this.group_id == -1) {
        this.group_id = null;
      }
      this.$emit('add',this.$data);
      this.close();
    }
  }
}
</script>
