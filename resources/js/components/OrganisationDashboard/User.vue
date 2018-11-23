<template>
  <div class="card text-center">
    <h4 class="card-header">{{ userName }}</h4>
    <div class="card-body">
    </div>
    <div class="card-footer">
      <button class="btn btn-primary btn-lg" href="#" role="button" @click="kick">{{buttonText}}</button>
    </div>
  </div>
</template>

<script>
  module.exports =
  {
    props: {
      userName: String,
      buttonText: String,
      buttonUri: String,
    },
    methods:{
      kick:function()
      {
        console.log("Kick");
      }
    }
  }
</script>

<style lang="scss" scoped>

</style>
