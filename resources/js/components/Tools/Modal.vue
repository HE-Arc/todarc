<template>
  <div class="modal" tabindex="-1" role="dialog" :id="id">
    <div class="modal-dialog" role="document">
      <div class="modal-content bg-light">
        <form action="#" @submit.prevent="submit">
          <div class="modal-header">
            <h5 class="modal-title">{{title}}</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="form-group text-left">
              <label for="dataInput">
                {{inputLabel}}
              </label>
              <input
                type="text"
                class="form-control"
                id="dataInput"
                name="dataInput"
                :placeholder="inputLabel"
                v-model="dataInputValue"
                :input="dataInput" @input="$emit('input', dataInputValue)"
                required
              />
            </div>
            <div id="invalid-input" class="invalid-feedback">
              Invalid entry, can't be empty
            </div>
          </div>
          <div class="modal-footer">
<<<<<<< HEAD:resources/js/components/Modal.vue
            <button type="button" class="btn btn-secondary" data-dismiss="modal" v-on:click="$emit('cancelled')">Close</button>
=======
            <button type="button" class="btn btn-secondary" data-dismiss="modal" @click="$emit('cancelled')">Close</button>
>>>>>>> de7985ab7a6d2c2d29f88b0ec7f73c97e348356d:resources/js/components/Tools/Modal.vue
            <button type="submit" class="btn btn-primary">Confirm</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</template>

<script>
<<<<<<< HEAD:resources/js/components/Modal.vue
    module.exports =
    {
      data () {
        return {
          id: null,
          dataInputValue: this.dataInput
        }
      },
      props:
      {
        title: String,
        dataInput: String,
        inputLabel: String
      },
      methods:
      {
        open: function()
        {
          $(`#${this.id}`).modal('show');
        },
        close: function()
        {
          $(`#${this.id}`).modal('hide');
        },
        submit: function()
        {
          this.$emit('confirmed');
          this.close();
        }
      },
      mounted()
      {
          this.id = 'modal'+this._uid;
      },
=======
export default {
  data() {
    return {
      id: null,
      dataInputValue: this.dataInput
    }
  },
  props: {
    title: String,
    dataInput: String,
    inputLabel: String
  },
  methods: {
    open(){
      $(`#${this.id}`).modal('show');
    },
    close() {
      $(`#${this.id}`).modal('hide');
    },
    submit() {
      if(this.dataInputValue == null || this.dataInputValue.trim() == ""){
        $('#invalid-input').show();
        return false;
      }
      $('#invalid-input').hide();

      this.$emit('confirmed');
      this.close();
>>>>>>> de7985ab7a6d2c2d29f88b0ec7f73c97e348356d:resources/js/components/Tools/Modal.vue
    }
  },
  mounted() {
      this.id = 'modal'+this._uid;
  },
};
</script>

<style lang="scss" scoped>
</style>
