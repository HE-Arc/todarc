<template>
  <div>
    <button @click="openCreation" type="button" class="btn btn-primary btn-block" data-toggle="modal" data-target="#add-task">Add Task</button>
    <div class="modal fade" id="add-task" tabindex="-1" role="dialog">
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
                  <input v-model="task.name" type="text" class="form-control" id="firstName" placeholder="Name" value required>
                  <div id="invalid-name" class="invalid-feedback">
                    Valid name is required.
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-md-12 mb-3">
                  <label for="country">Group</label>
                  <select v-model="task.group_id" class="custom-select d-block w-100" id="group" required>
                    <option :value="group_root">Choose...</option>
                    <option v-for="group in groups" :key="group.id" :value="group.id">{{ group.name }}</option>
                  </select>
                  <div id="invalid-group" class="invalid-feedback">
                    Please select a valid group.
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-md-12 mb-3">
                  <label for="country">Description</label>
                  <textarea v-model="task.description" class="form-control"></textarea>
                </div>
              </div>

              <div class="row">
                <div class="col-md-6 mb-3">
                  <label for="drom-date">From date</label>
                  <input v-model="task.from_date" type="date" class="form-control" id="from-date">
                </div>
                <div class="col-md-6 mb-3">
                  <label for="due-date">Until date</label>
                  <input v-model="task.until_date" type="date" class="form-control" id="until-date">
                </div>
                  <div id="invalid-period" class="invalid-feedback">
                    Please enter a valid period
                  </div>
              </div>
              <hr class="mb-3">
              <h4 class="mb-3">Status</h4>
              <div class="custom-control custom-checkbox">
                <input type="checkbox" class="custom-control-input" id="same-address" v-model="task.done">
                <label class="custom-control-label" for="same-address">Done</label>
              </div>
              <!-- <button class="btn btn-primary btn-lg btn-block" type="submit">Continue to checkout</button> -->
            </form>
            <!-- 
              TODO :
              - Labels
              - Edition inside this same modal
            -->
          </div>
          <div class="card-footer">
            <button v-if="!editionMode" @click="add" type="button" class="btn btn-primary">Add Task</button>
            <button v-if="editionMode" @click="edit" type="button" class="btn btn-primary">Edit Task</button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          </div>
        </div>
      </div>  
    </div>
  </div>
</template>

<script>
export default {
  name:"modal-task",
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
      default: "Add a Task",
    },
    titleEdition: {
      type: String,
      default: "Edit a Task",
    },
    emptyTask: {
      type: Object,
      default: ()=>Object.freeze({
        done : false,
        from_date : "",
        until_date : "",
        group_id : this.group_root,
        name : "",
        order : 2147483647,
        id : 0,
        description : "",
      })
    }
  },
  data(){
    return {
      task : Object,
      editionMode: false 
    }
  },
  methods:{
    openCreation(){
      $(`#add-task`).modal('show');
      this.editionMode = false;
      this.task = Object.assign({}, this.emptyTask);
    },
    openEdition(task){
      $(`#add-task`).modal('show');
      this.editionMode = true;
      this.task = Object.assign({}, task);
    },
    close(){
      $(`#add-task`).modal('hide');
    },
    check(){
      //Invalid name
      if(this.task.name == null || this.task.name.trim() == ""){
        $('#invalid-name').show();
        return false;
      }
      $('#invalid-name').hide();

      //Wrong group param
      if(!this.groups.map(group=>group.id).includes(parseInt(this.task.group_id))){
        $('#invalid-group').show();
        return false;
      }
      $('#invalid-group').hide();

      //Invalid period
      if(this.task.from_date != "" && this.task.until_date != ""){
        if(Date.parse(this.task.until_date)-Date.parse(this.task.from_date)<0){
          $('#invalid-period').show();
          return false;
        }
      }
      $('#invalid-period').hide();

      return true;
    },
    add(){
      if(this.check()){
        this.$emit('add',this.task);
        this.close();
      }
    },
    edit(){
      if(this.check()){
        this.$emit('edit',this.task);
        this.close();
      }
    }
  },
  mounted(){
    this.task = Object.assign({}, this.emptyTask);
  }
}
</script>
