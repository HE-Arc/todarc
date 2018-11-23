<template>
  <div class="card text-center">
    <h4 class="card-header">{{ user.name }}</h4>
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
      user: Object,
      buttonText: String,
      organisation: Object,
    },
    methods:{
      kick()
      {
        return axios
          .delete('/organisations/'+ this.organisation.id +'/users/' + this.user.id)
          .then((response) => {
            console.log("Kicked user");
            window.location = response.data.redirectTo;
          })
          .catch();
      }
    }
  }
</script>

<style lang="scss" scoped>

</style>
