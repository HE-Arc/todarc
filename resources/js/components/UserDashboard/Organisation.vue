<template>
  <div class="card text-center bg-light">
    <h4 class="card-header">{{ name }}</h4>
    <div class="card-body">
      <h5>Members : </h5>
      <ul>
        <li v-for="member in members" :key="member.id">{{member}}</li>
      </ul>
      <a v-bind:href="uriOrganisation"><button class="btn btn-primary btn-block">{{buttonText}}</button></a>
    </div>
  </div>
</template>

<script>
  module.exports =
  {
    props:
    {
      name: String,
      buttonText: String,
      uriOrganisation: String,
      members: Array
    }
  }
</script>

<style lang="scss" scoped>

</style>
