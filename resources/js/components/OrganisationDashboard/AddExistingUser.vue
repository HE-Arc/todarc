<template>
  <div>
    <button class="btn btn-primary btn-lg" href="#" role="button" v-on:click="addExistingUser">{{ buttonText }}</button>
    <modal
      v-on:confirmed=""
      v-model="newUser"
      ref="modalNewExistingUser"
      title="Add existing user"
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
      addExistingUser: function()
      {
        this.$refs.modalNewExistingUser.open();
      },
    }
  }
</script>

<style lang="scss" scoped>

</style>
