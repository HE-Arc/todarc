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
        <span class="font-weight-bold">Project Name : </span>
        {{ project.name }}
      </p>
      <p v-if="project.owner">
        <span class="font-weight-bold">Owner : </span>
        {{ project.owner.name }}
      </p>
      <p>
        <span class="font-weight-bold">Running Tasks : </span>
        {{ nbTasksRunning }}
      </p>
      <p>
        <span class="font-weight-bold">Task done : </span>
        {{ nbTasksDone }}
      </p>
      <div>
        <h5>Labels : </h5>
        <label-manager
          :labels-input="labelsInput"
        ></label-manager>
      </div>
      <h5>Project updates : </h5>
      <delete-project :project-id="project.id"></delete-project>
    </div>
  </div>
</template>

<script>
import LabelManager from "./Label/LabelManager";
import DeleteProject from "./DeleteProject";

import BUS from "./BusEvent";

export default {
  props: {
    project : Object,
    tasks : {
      type : Array,
      required: true,
    },
    labelsInput : Array,
  },
  data(){
    return {
      nbTasksDone : 0,
      nbTasksRunning : 0,
    }
  },
  components: {
    LabelManager,
    DeleteProject
  },
  methods: {
    refreshTasks(tasks) {
      this.nbTasksDone = tasks.filter(task => task.done != false).length;
      this.nbTasksRunning = tasks.filter(task => task.done == false).length;
    }
  },
  mounted() {
    this.refreshTasks(this.tasks);

    BUS.$on('refreshTasks', this.refreshTasks);
  }
};
</script>

<style lang="scss" scoped>
  h5 {
    margin-top: 20px;
  }
</style>
