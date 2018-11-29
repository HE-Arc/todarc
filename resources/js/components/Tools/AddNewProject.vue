<template>
  <div>
    <button class="btn btn-primary btn-lg" href="#" role="button" @click="newProject">{{ buttonText }}</button>
    <modal
      v-on:confirmed="sendProject"
      v-model="projectName"
      ref="modalNewProject"
      title="New Project"
      input-label="Project name"
      data-input=""
    ></modal>
  </div>
</template>

<script>
export default {
  data() {
    return {
      projectName: String,
    }
  },
  props: {
    ownerId: Number,
    buttonText: String,
    ownerType: String,
  },
  methods: {
    newProject() {
      this.$refs.modalNewProject.open();
    },
    sendProject() {
      return axios
        .post('/'+this.ownerType+'/'+this.ownerId+"/projects", { projectName : this.projectName })
        .then((response) => {
          window.location = response.data.redirectTo;
        })
        .catch();

      return false;
    }
  }
};
</script>

<style lang="scss" scoped>

</style>
