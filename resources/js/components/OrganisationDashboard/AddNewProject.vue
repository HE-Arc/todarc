<template>
  <div>
    <button class="btn btn-primary btn-lg" href="#" role="button" data-toggle="modal" data-target="#add-new-project-modal" @click="addExistingUser">+ New project</button>
    <div class="modal fade" id="add-new-project-modal" tabindex="-1" role="dialog" >
      <div class="modal-dialog" role="document">
        <div class="modal-content bg-light">
          <form action="#" v-on:submit.prevent="submit">
            <div class="modal-header">
              <h5 class="modal-title">Add new project</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <div class="form-group text-left">
                <input v-model="newProjectName" type="text" class="form-control" id="newProjectName" placeholder="ProjectName" value required>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal" v-on:click="$emit('cancelled')">Close</button>
              <button type="button" class="btn btn-primary" @click="addNewProject">Confirm</button>
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
    props:
    {
      newProjectName: String,
    },
    methods:
    {
      addExistingUser()
      {
      $(`#add-new-project-modal`).modal();
      },
      close()
      {
        $(`#add-new-project-modal`).modal('hide');
      },
      addNewProject()
      {
        return axios
          .post('/organisations/'+this.organisation.id+'/users', {id:this.userId})
          .then((response) => {
            console.log("user add");
            window.location = response.data.redirectTo;
          })
          .catch();
      },
    },
    mounted()
    {
      axios
        .get('/users')
        .then((users) => {
          console.log("list user received");
          this.usersAll = users.data;
          this.usersFiltered = this.usersAll.filter(function(user) { return this.indexOf(user.id) < 0 }, this.users.map((userA) => userA.id));
        })
        .catch();
    }
  }
</script>

<style lang="scss" scoped>

</style>
