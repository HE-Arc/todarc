<template>
  <div class="card text-center">
    <h4 class="card-header">{{ name }}</h4>
    <div class="card-body">
      <h6>Members : </h6>
      <ul>
        <li v-for="member in members">{{member}}</li>
      </ul>
    </div>
    <div class="card-footer">
      <a v-bind:href="uriOrganization"><button class="btn btn-light btn-block">{{buttonText}}</button></a>
    </div>
  </div>
</template>

<script>
  module.exports =
  {
    props: {
      name: Number,
      buttonText: String,
      uriOrganization: String,
      members: Array
    }
  }
</script>

<style lang="scss" scoped>

</style>
