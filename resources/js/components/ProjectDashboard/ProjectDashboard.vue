<template>
  <div class="row">
      <div class="col-md-8">
          <project
            :project="project"
            :groups="groups"
            :tasks="tasks"
            :labels="labelsInput"
          ></project>
      </div>
      <div class="col-md-4">
          <project-summary
            :project="project"
            :labels-input="labelsInput"
            :tasks="tasks"
          ></project-summary>
      </div>
  </div>
</template>

<script>
import Project from "./Project";
import ProjectSummary from "./ProjectSummary"

export default {
  props: {
    project: {
      type: Object,
      required: true
    },
    groups: {
      type: Array,
      required: true
    },
    tasks: {
      type: Array,
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
};
</script>

<style lang="scss" scoped>

</style>
