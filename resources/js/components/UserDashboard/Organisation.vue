<template>
  <div class="card text-center bg-light">
    <h4 class="card-header">{{ name }}</h4>
    <div class="card-body">
      <h5>Projects :</h5>
      <ul class="pl-0">
        <li v-for="project in projects" :key="project.id">{{project.name}}</li>
      </ul>
      <a :href="uriOrganisation"><button class="btn btn-primary btn-block">{{buttonText}}</button></a>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    name: String,
    buttonText: String,
    uriOrganisation: String,
    projects: Array
  }
};
</script>

<style lang="scss" scoped>

</style>
