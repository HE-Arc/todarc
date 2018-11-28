<template>
  <div class="modal" tabindex="-1" role="dialog" :id="id">
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
            <div class="form-group text-left">
              <label for="dataInput">
                {{inputLabel}}
              </label>
              <input
                type="text"
                class="form-control"
                id="dataInput"
                name="dataInput"
                v-bind:placeholder="inputLabel"
                v-model="dataInputValue"
                v-bind:input="dataInput" v-on:input="$emit('input', dataInputValue)"
              />
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal" @click="$emit('cancelled')">Close</button>
            <button type="submit" class="btn btn-primary" @click="buttonConfirmedClicked">Confirm</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</template>

<script>
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
    buttonConfirmedClicked() {
      this.$emit('confirmed');
      this.close();
    }
  },
  mounted() {
      this.id = 'modal'+this._uid;
  },
};
</script>

<style lang="scss" scoped>
</style>
