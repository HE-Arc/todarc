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
            <div class="alert alert-danger text-left" v-if="errorMessage != ''" role="alert">
              {{ errorMessage }}
            </div>
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
            <button type="button" class="btn btn-secondary" data-dismiss="modal" @click="$emit('cancelled')">Close</button>
            <button type="submit" class="btn btn-primary">Confirm</button>
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
      dataInputValue: this.dataInput,
      errorMessage : '',
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
    },
    setError(message)
    {
      this.errorMessage = message;
    }
  },
  mounted() {
      this.id = 'modal'+this._uid;
  },
};
</script>

<style lang="scss" scoped>
</style>
