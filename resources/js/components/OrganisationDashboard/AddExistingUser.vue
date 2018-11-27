<template>
  <div>
    <button class="btn btn-primary btn-lg" href="#" role="button" data-toggle="modal" data-target="#add-existing-user-model" @click="addExistingUser">+ Existing user</button>
    <div class="modal fade" id="add-existing-user-model" tabindex="-1" role="dialog" >
      <div class="modal-dialog" role="document">
        <div class="modal-content bg-light">
          <form action="#" v-on:submit.prevent="submit">
            <div class="modal-header">
              <h5 class="modal-title">Add existing user</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <div class="form-group text-left">
                <select v-model="userId" class="form-control">
                  <option :value="user.id" v-for="user in usersFiltered" :key="user.id">{{ user.name }}</option>
                </select>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal" v-on:click="$emit('cancelled')">Close</button>
              <button type="button" class="btn btn-primary" @click="addUser">Confirm</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      userId: Number,
      usersAll: Array,
      usersFiltered: Array,
    };
  },
  props: {
    users: Array,
    organisation: Object,
    user_root:{
      type: Number,
      default: -1,
    },
  },
  methods: {
    addExistingUser() {
      $(`#add-existing-user-modal`).modal();
    },
    close() {
      $(`#add-existing-user-modal`).modal('hide');
    },
    addUser() {
      return axios
        .post('/organisations/'+this.organisation.id+'/users', {id:this.userId})
        .then((response) => {
          console.log("user add");
          window.location = response.data.redirectTo;
        })
        .catch();
    },
  },
  mounted() {
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
