<template>
  <div>
    <button @click="openCreation" type="button" class="btn btn-primary btn-block">Add Group</button>
    <div class="modal fade" id="add-group" tabindex="-1" role="dialog">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h3 class="modal-title">{{ editionMode?titleEdition:titleCreation }}</h3>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form>
              <div class="row">
                <div class="col-md-12 mb-3">
                  <label for="firstName">Name</label>
                  <input v-model="group.name" type="text" class="form-control" id="firstName" placeholder="Name" value required>
                  <div id="invalid-name" class="invalid-feedback">
                    Valid name is required.
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-md-12 mb-3">
                  <label for="country">Group</label>
                  <select v-model="group.group_id" class="custom-select d-block w-100" id="group" required>
                    <option :value="group_root">Root location</option>
                    <option v-for="groupD in groups" :key="groupD.id" :value="groupD.id">{{ groupD.name }}</option>
                  </select>
                  <div id="invalid-group" class="invalid-feedback">
                    Please select a valid group.
                  </div>
                </div>
              </div>
            </form>
          </div>
          <div class="card-footer">
            <button v-if="!editionMode" @click="add" type="button" class="btn btn-primary">Add Group</button>
            <button v-if="editionMode" @click="edit" type="button" class="btn btn-primary">Edit Group</button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
export default {
  name:"modal-group",
  props:{
    groups: {
      type: Array,
      required: true,
    },
    group_root:{
      type: Number,
      default: -1
    },
    titleCreation: {
      type: String,
      default: "Add a Group",
    },
    titleEdition: {
      type: String,
      default: "Edit a Group",
    },
    emptyGroup: {
      type: Object,
      default: ()=>Object.freeze({
        group_id: this.group_root,
        name: "",
        id: 0,
        order: 2147483647, // Equivalent to MySQL max int value
        editionMode: false 
      })
    }
  },
  data(){
    return {
      group : Object,
      editionMode: false 
    }
  },
  methods:{
    openCreation(){
      $(`#add-group`).modal('show');
      this.editionMode = false;
      this.group = Object.assign({}, this.emptyGroup);
    },
    openEdition(group){
      $(`#add-group`).modal('show');
      this.editionMode = true;
      this.group = Object.assign({}, group);
    },
    close(){
      $(`#add-group`).modal('hide');
    },
    check(){
      //Invalid name
      if(this.group.name == null || this.group.name.trim() == ""){
        $('#invalid-name').show();
        return;
      }
      $('#invalid-name').hide();

      //Wrong group param
      if(!(parseInt(this.group.group_id) == this.group_root || parseInt(this.group.group_id) in this.groups.map(group=>{return group.id;}))){
        $('#invalid-group').show();
        return;
      }
      $('#invalid-group').hide();

      if(this.group.group_id == this.group_root) {
        this.group.group_id = null;
      }
    },
    add(){
      this.check();
      this.$emit('add',this.group);
      this.close();
    },
    edit(){
      this.check();
      this.$emit('edit',this.group);
      this.close();
    }
  },
  mounted(){
    this.group = Object.assign({}, this.emptyGroup);
  }
}
</script>
