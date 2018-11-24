<template>
  <div class="card">
    <div class="card-header modal-header">
      <h4 >
        Summary
      </h4>
    </div>
    <div class="card-body">
      <h5>Infos : </h5>
      <p>
        <span class="font-weight-bold">Owner : </span>
        {{ owner }}
      </p>
      <p>
        <span class="font-weight-bold">Running Tasks : </span>
        {{ nbTasksRunning }}
      </p>
      <p>
        <span class="font-weight-bold">Task done : </span>
        {{ nbTasksDone }}
      </p>
      <div v-if="labels.length > 0">
        <h5>Labels : </h5>
        <label-manager v-model="labels" v-bind:labelsInput.sync="labels" v-on:labels-changed="updateLabels"></label-manager>
      </div>
      <h5>Project updates : </h5>
      <delete-project v-bind:project-id="1"></delete-project>
    </div>
  </div>
</template>

<script>
  import LabelManager from "./Label/LabelManager";
  import DeleteProject from "./DeleteProject";

  export default
  {
    data () {
      return {
        labels: this.labelsInput,
      }
    },
    props: {
      owner : String,
      nbTasksDone : Number,
      nbTasksRunning : Number,
      labelsInput : Array
    },
    methods:{
      updateLabels(labels) {
        this.labels = labels;
      }
    },
    watch: {
      labelsInput() {
        console.log('ici');
      },
      labels: {
        handler: function(oldVal, newVal) {
          this.$emit("labels-changed", this.labels)
        },
        deep: true,
        immediate: true
      }
    },
    components: {
      LabelManager,
      DeleteProject
    }
  }
</script>

<style lang="scss" scoped>
  h5
  {
    margin-top: 20px;
  }
</style>
