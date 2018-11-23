<template>
  <div class="card">
    <div class="card-header modal-header">
      <h4 >
        Summary
      </h4>
    </div>
    <div class="card-body">
      <p>
        <span class="font-weight-bold">Owner : </span>
        {{ owner }}
      </p>
      <p>
        <span class="font-weight-bold">Running Tasks : </span>
      </p>
      <p>
        <span class="font-weight-bold">Task done : </span>
      </p>
      <label-manager></label-manager>
    </div>
  </div>
</template>

<script>
  // import Label from "./Label";
  import LabelManager from "./Label/LabelManager";
  import DeleteProject from "./DeleteProject";

  export default
  {
    props: {
      owner : String,
      nbTasksDone : Number,
      nbTasksRunning : Number
    },
    methods:{

    },
    components: {
      LabelManager
    }
  }
</script>

<style lang="scss" scoped>

</style>
