<template>
  <div>
    <button class="btn btn-primary btn-lg" href="#" role="button" data-toggle="modal" data-target="#add-existing-user-model" @click="addExistingUser">{{ buttonText }}</button>
    <div class="modal fade" id="add-existing-user-model" tabindex="-1" role="dialog" >
      <div class="modal-dialog" role="document">
        <div class="modal-content bg-light">
          <form action="#" v-on:submit.prevent="submit">
            <div class="modal-header">
              <h5 class="modal-title">{{title}}</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <div class="form-user text-left">
                <select class="custom-select d-block w-100" id="user" required>
                  <option :value="user_root">Choose...</option>
                  <option v-for="user in users" :key="user.name" :value="user.name">{{ user.name }}</option>
                </select>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal" v-on:click="$emit('cancelled')">Close</button>
              <button type="submit" class="btn btn-primary" v-on:click="buttonConfirmedClicked">Confirm</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
  module.exports =
  {
    // data: function ()
    // {
    //   return null;
    // },
    props:
    {
      title: String,
      buttonText: String,
      users: Array,
      user_root:{
        type: Number,
        default: -1,
      },
    },
    methods:
    {
      addExistingUser: function()
      {
      $(`#add-existing-user-modal`).modal();
      },
      close()
      {
        $(`#add-existing-user-modal`).modal('hide');
      },
      buttonConfirmedClicked: function()
      {
        // rien
      }
    }
  }
</script>

<style lang="scss" scoped>

</style>
