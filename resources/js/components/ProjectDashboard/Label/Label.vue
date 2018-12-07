<template>
  <div class="label-task" :style="getStyle()">
    {{name}}
    <button class="btn btn-link" @click="deleteLabelFromTask">
      <i class="fas fa-times"></i>
    </button>
  </div>
</template>

<script>
export default {
  props: {
    id: Number,
    taskId: Number,
    name: String,
    color: String,
  },
  inject: ["removeTaskLabel"],
  methods: {
    getStyle() {
      return {
        backgroundColor: this.color
      };
    },
    deleteLabelFromTask() {
      this.removeTaskLabel(this.taskId, this.id);
    }
  }
};
</script>

<style lang="scss" scoped>
.label-task {
  display: inline;
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
