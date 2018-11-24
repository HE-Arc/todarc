<template>
  <div class="label-task" v-bind:style="getStyle()">
    {{name}}
    <button class="btn btn-link" v-on:click="deleteLabelFromTask">
      <i class="fas fa-times"></i>
    </button>
  </div>
</template>

<script>
  export default
  {
    props: {
      id: Number,
      taskId: Number,
      name: String,
      color: String,
    },
    methods: {
      getStyle() {
        return {
          backgroundColor: this.color
        };
      },
      deleteLabelFromTask() {
        axios.delete(
          `${window.location}/tasks/${this.taskId}/labels/${this.id}`,
          {
            headers : {
              'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
          }
        ).then(response =>
        {
          console.log("success")
        }, response =>
        {
          console.log("error while deleting label from the task");
        });
      }
    }
  }
</script>

<style lang="scss" scoped>
.label-task {
  display: inline;
  margin-top: -2px;
  padding: 0px 6px;
  border-radius: 3px;
  margin-right: 5px;
  button {
    padding: 0;
    color: white;

    i {
      padding-top: 4px;
    }
  }
}
</style>
