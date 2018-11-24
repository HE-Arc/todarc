<template>
  <div class="row">
      <div class="col-md-8">
          <project
            v-bind:project="project"
            v-bind:groups="groups"
            v-bind:tasks='tasks'
            v-bind:labels.sync="labels"
            v-on:tasks-changed="updateNbTasks"
          ></project>
      </div>
      <div class="col-md-4">
          <project-summary
            v-bind:owner="project.owner.name"
            v-bind:labels-input.sync="labels"
            v-bind:nb-tasks-done.sync="nbTasksDone"
            v-bind:nb-tasks-running.sync="nbTasksRunning"
            v-bind:project-id.sync="project.id"
            v-on:labels-changed="updateLabels"
          ></project-summary>
      </div>
  </div>
</template>

<script>
  import Project from "./Project";
  import ProjectSummary from "./ProjectSummary"

  export default
  {
    data() {
      return {
        nbTasksDone: 0,
        nbTasksRunning: 0,
        labels : this.labelsInput
      }
    },
    props: {
      project: {
        required: true
      },
      groups: {
        required: true
      },
      tasks: {
        required: true
      },
      labelsInput: {
        required: true
      }
    },
    components: {
      Project,
      ProjectSummary
    },
    methods: {
      updateNbTasks(nbTasksDone, nbTasksRunning)
      {
        this.nbTasksDone = nbTasksDone;
        this.nbTasksRunning = nbTasksRunning;
      },
      updateLabels(labels) {
        this.labels = labels;
      }
    }
  }
</script>

<style lang="scss" scoped>

</style>
