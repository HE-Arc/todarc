<template>
  <div>
    <button @click="openCreation" type="button" class="btn btn-primary btn-block" data-toggle="modal" data-target="#add-task">Add Task</button>
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
                    <option :value="group_root">Choose...</option>
                    <option v-for="group in groups" :key="group.id" :value="group.id">{{ group.name }}</option>
                  </select>
                  <div id="invalid-group" class="invalid-feedback">
                    Please select a valid group.
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-md-6 mb-3">
                  <label for="drom-date">From date</label>
                  <input v-model="from_date" type="date" class="form-control" id="from-date">
                </div>
                <div class="col-md-6 mb-3">
                  <label for="due-date">Until date</label>
                  <input v-model="until_date" type="date" class="form-control" id="until-date">
                </div>
                  <div id="invalid-period" class="invalid-feedback">
                    Please enter a valid period
                  </div>
              </div>
              <hr class="mb-3">
              <h4 class="mb-3">Status</h4>
              <div class="custom-control custom-checkbox">
                <input type="checkbox" class="custom-control-input" id="same-address" v-model="done">
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
  name:"modal-task",
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
      done : false,
      from_date : "",
      until_date : "",
      group_id : this.group_root,
      name : "",
      order : 2147483647, //Equivalent to MySQL max int value
    }
  },
  methods:{
    openCreation(){
      this.done=0;
      this.from_date="";
      this.group_id=this.group_root;
      this.name="";
      this.until_date="";
    },
    openEdition(){

    },
    close(){
      $(`#add-task`).modal('hide');
    },
    add(){
      //Invalid name
      if(this.name == null || this.name.trim() == ""){
        $('#invalid-name').show();
        return;
      }
      $('#invalid-name').hide();

      //Wrong group param
      if(!(parseInt(this.group_id) in this.groups.map(group=>{return group.id;}))){
        $('#invalid-group').show();
        return;
      }
      $('#invalid-group').hide();

      //Invalid period
      if(this.from_date != "" && this.until_date != ""){
        if(Date.parse(this.until_date)-Date.parse(this.from_date)<0){
          $('#invalid-period').show();
          return;
        }
      }
      $('#invalid-period').hide();

      this.$emit('add',this.$data);
      this.close();
    }
  }
}
</script>
