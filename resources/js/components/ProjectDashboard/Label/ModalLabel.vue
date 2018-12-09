<template>
  <div class="modal" tabindex="-1" role="dialog" :id="id">
    <div class="modal-dialog" role="document">
      <div class="modal-content bg-light">
          <div class="modal-header">
            <h5 class="modal-title">{{title}}</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="form-group text-left">
              <label for="nameInput">
                Name :
              </label>
              <input
                type="text"
                class="form-control"
                id="nameInput"
                name="nameInput"
                placeholder="Name"
                v-model="label.name"
                required
              />
            </div>
            <div class="form-group text-left">
              <label for="colorInput">
                Color :
              </label>
              <input
              type="color"
              class="form-control"
              id="colorInput"
              name="colorInput"
              placeholder="Color"
              v-model="label.color"
              />
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal" @click="$emit('cancelled')">Close</button>
            <button type="button" class="btn btn-primary" @click="submit">Confirm</button>
          </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      label: {},
      id: '',
      title: ''
    }
  },
  methods: {
    open(title, label) {
      this.label = Object.assign({}, label);
      this.title = title;
      $(`#${this.id}`).modal('show');
    },
    close() {
      $(`#${this.id}`).modal('hide');
    },
    confirmed() {
      this.$emit('confirmed', this.label);
      this.close();
    },
    submit() {
      if(this.title == null || this.title.trim() == ""){
        $('#invalid-title').show();
        return false;
      }
      $('#invalid-title').hide();
      this.confirmed();
    }
  },
  mounted() {
      this.id = 'modal'+this._uid;
  }
};
</script>

<style lang="scss" scoped>
</style>
