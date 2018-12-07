<template>
  <div>
    <button @click="openCreation" type="button" class="btn btn-primary btn-block open-modal-btn" data-toggle="modal" data-target="#add-task">Add Task</button>
    <div class="modal fade" id="add-task" tabindex="-1" role="dialog">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <form action="#" @submit.prevent="submit">
            <div class="modal-header">
              <h3 class="modal-title">{{ editionMode?"Edit":"Create" }} a Task</h3>
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
                      <option :value="groupRoot">Choose...</option>
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
                  <div class="col-md-12 mb-3">
                    <vue-tags-input
                    class="form-control"
                    v-model="tag"
                    :tags="task.labels"
                    :autocomplete-items="filteredLabels"
                    :add-only-from-autocomplete="true"
                    @tags-changed="updateLabels">
                      <template slot="tagCenter" slot-scope="props" >
                        <span :background='props.tag.color' :id='"color-id-"+props.tag.id' @click="props.performOpenEdit(props.index)" :class="{ hidden: props.edit }">{{ props.tag.text }}</span>
                      </template>
                      <template
                        slot="autocompleteItem"
                        slot-scope="props">
                        <h6 @click="props.performAdd(props.item)" class="badge" :style='"background-color:"+props.item.color+";"'>
                          {{ props.item.text }}
                        </h6>
                      </template>
                    </vue-tags-input>
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
              </form>
            </div>
            <div class="card-footer">
              <button v-if="!editionMode" type="submit" class="btn btn-primary">Add Task</button>
              <button v-if="editionMode" type="submit" class="btn btn-primary">Edit Task</button>
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { VueTagsInput, TagInput } from '@johmun/vue-tags-input';
import BUS from "../BusEvent";

export default {
  name:"modal-task",
  props: {
    groupRoot:{
      type: Number,
      default: -1
    },
    emptyTask: {
      type: Object,
      default: ()=>Object.freeze({
        done : false,
        from_date : "",
        until_date : "",
        group_id : this.groupRoot,
        name : "",
        order : 2147483647,
        id : 0,
        labels : [],
        description : "",
      })
    }
  },
  components: { VueTagsInput, TagInput },
  inject: ['labels', 'groups'],
  data() {
    return {
      task: Object,
      tag: '',
      editionMode: false,
      selectedLabels: [],
      labelsNew: [],
      groupsnew: []
    }
  },
  methods: {
    openCreation(parentId){
      $(`#add-task`).modal('show');
      this.editionMode = false;
      this.tags = []
      this.task = Object.assign({}, this.emptyTask);

      if(parentId != undefined){
        this.task.group_id = parentId;
      }
    },
    openEdition(task){
      $(`#add-task`).modal('show');
      this.editionMode = true;
      this.task = Object.assign({}, task);
      this.task.labels.forEach(label=>label.text = label.name);

      if(this.task.group_id == null){
        this.task.group_id = this.groupRoot;
      }

      setTimeout(function(){
        this.task.labels.forEach(task => {console.log($('#color-id-'+task.id)); console.log('#color-id-'+task.id) ;$('#color-id-'+task.id).parent().parent().parent().css("background-color",$('#color-id-'+task.id).attr("background"));});
      }.bind(this), 50);
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
    submit(){
      if(this.editionMode){
        this.edit();
      }else{
        this.add();
      }
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
    },
    updateLabels(labels){
      this.task.labels = labels;

      //Update labels color
      setTimeout(function(){
        this.task.labels.forEach(task => {console.log($('#color-id-'+task.id)); console.log('#color-id-'+task.id) ;$('#color-id-'+task.id).parent().parent().parent().css("background-color",$('#color-id-'+task.id).attr("background"));});
      }.bind(this), 50);
    },
    refreshLabels(labelsData){
      labelsData.forEach(label => label.text = label.name);
      this.labelsNew = labelsData;
    },
    refreshGroups(groups){
      this.groupsNew = groups;
    },
  },
  // watch:{
  //   labels: {
  //     handler: function (val, oldVal) {
  //       this.labelsNew = [];
  //       this.labels.forEach(label=>this.labelsNew.push({...label,text:label.name}));
  //     },
  //     deep: true
  //   }
  // },
  computed: {
    filteredLabels() {
      return this.labelsNew.filter(i => new RegExp(this.tag, 'i').test(i.text));
    },
  },
  mounted(){
    this.groupsNew = this.groups;
    this.task = Object.assign({}, this.emptyTask);
    this.labelsNew = [];
    this.labels.forEach(label=>this.labelsNew.push({...label,text:label.name}));

    BUS.$on('refreshLabels', this.refreshLabels);
    BUS.$on('refreshGroups', this.refreshGroups);
  },
};
</script>

<style lang="scss">
.open-modal-btn {
  margin-top: 3px;
}
.autocomplete{
  margin: 0.525em -0.75rem;
  border-radius: 3px;
}

.tag {
  margin: 0px !important;
  margin-right: 4px !important;
}

.vue-tags-input.form-control{
  max-width: none !important;
}

.new-tag-input-wrapper{
  padding: 0px !important;
  margin: 0px !important;
  font-size: inherit !important;
}

.vue-tags-input .input {
  padding: 0px !important;
  border: none !important;
}

.tag {
  position: relative;
}

.tag.valid {
  background-color: #04B404;
}

.tag.custom-class {
  background-color: #fff;
  color: rgba(100 ,100, 100, 1);
  font-weight: bold;
  text-transform: uppercase;
  box-shadow: 2px 2px 0px 0px rgba(100, 100, 100, 1);
  margin-right: 0px;
  border: none;
  font-size: 0px;
}

.duplicate {
  text-decoration: line-through;
}

.tag:after {
  transition: transform .2s;
  position: absolute;
  content: '';
  height: 2px;
  width: 108%;
  left: -4%;
  top: calc(50% - 1px);
  background-color: #000;
  transform: scaleX(0);
}

.deletion-mark :after {
  transform: scaleX(1);
}
</style>
