<template>
  <div>
    <button class="btn btn-primary btn-lg" href="#" role="button" v-on:click="newUser">{{ buttonText }}</button>
    <modal
      v-on:confirmed=""
      v-model="newUser"
      ref="modalNewUser"
      title="New user"
      input-label="Username"
      data-input=""
    ></modal>
  </div>
</template>

<script>
  module.exports =
  {
    data: function ()
    {
      return {
        orgName: String,
        orgUsers: Array(),
        userName: String,
      }
    },
    props:
    {
      buttonText: String
    },
    methods:
    {
      newUser: function()
      {
        this.$refs.modalNewUser.open();
      },
    }
  }
</script>

<style lang="scss" scoped>

</style>
