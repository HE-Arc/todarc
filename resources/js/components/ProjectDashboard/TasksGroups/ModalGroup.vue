<template>
  <div>
    <button @click="openCreation" type="button" class="btn btn-primary btn-block open-modal-btn">Add Group</button>
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
                    <option :value="groupRoot">Root location</option>
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
import BUS from "../BusEvent";

export default {
  name: "modal-group",
  props: {
    groups: {
      type: Array,
      required: true,
    },
    groupRoot: {
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
        id: 0,
        group_id: this.groupRoot,
        name: "",
        order: 2147483647, // Equivalent to MySQL max int value
        editionMode: false
      })
    }
  },
  data() {
    return {
      group : Object,
      editionMode: false
    }
  },
  methods: {
    openCreation(parentId){
      $(`#add-group`).modal('show');
      this.editionMode = false;
      this.group = Object.assign({}, this.emptyGroup);

      if(parentId != undefined){
        this.group.group_id = parentId;
      }
    },
    openEdition(group){
      $(`#add-group`).modal('show');
      this.editionMode = true;
      this.group = Object.assign({}, group);

      if(this.group.group_id == null){
        this.group.group_id = this.groupRoot;
      }
    },
    close(){
      $(`#add-group`).modal('hide');
    },
    check(){
      //Invalid name
      if(this.group.name == null || this.group.name.trim() == ""){
        $('#invalid-name').show();
        return false;
      }
      $('#invalid-name').hide();

      //Wrong group param
      if(!(parseInt(this.group.group_id) == this.groupRoot || this.groups.map(group=>group.id).includes(parseInt(this.group.group_id)))){
        $('#invalid-group').show();
        return false;
      }
      $('#invalid-group').hide();

      if(this.group.group_id == this.groupRoot) {
        this.group.group_id = null;
      }

      return true;
    },
    add(){
      if(this.check()){
        this.$emit('add',this.group);
        this.close();
      }
    },
    edit(){
      if(this.check()){
        this.$emit('edit',this.group);
        this.close();
      }
    }
  },
  mounted() {
    this.group = Object.assign({}, this.emptyGroup);
  }
};
</script>
