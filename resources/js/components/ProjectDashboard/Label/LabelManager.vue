<template>
  <div>
    <div v-for="label in labels" :key="label.id" class="label-to-edit" v-bind:style="getStyle(label)">
      <div class="label-name">
        {{ label.name }}
      </div>
      <div class="label-action">
        <button class="btn btn-link" v-on:click="update(label)"><i class="fas fa-pen"></i></button>
        <button class="btn btn-link" v-on:click="deleteLabel(label.id)"><i class="fas fa-trash-alt"></i></button>
      </div>
    </div>
    <button class="btn btn-primary btn-block" v-on:click="newLabel"><i class="fas fa-plus"></i> Add a label</button>
    <modal-label
      v-on:confirmed="sendLabel"
      ref="modalLabel"
    ></modal-label>
  </div>
</template>

<script>
import ModalLabel from "./ModalLabel"

export default {
  data() {
    return {
      labels: this.labelsInput,
    }
  },
  props: {
    labelsInput : Array,
    projectId : Number
  },
  methods: {
    getStyle(label) {
      return {
        backgroundColor: label.color
      };
    },
    update(label) {
      this.$refs.modalLabel.open("Add a new label", label);
    },
    // new label clicked
    newLabel() {
      this.$refs.modalLabel.open("Add a new label", {
        name : '',
        color : '#0000FF'
      });
    },
    // define if this is a new or updated label
    sendLabel(label) {
      if('id' in label) {
        this.sendUpdatedLabel(label);
      } else {
        this.sendNewLabel(label)
      }
    },
    // send the new label to server
    sendNewLabel(label) {
      axios.post( `/projects/${this.projectId}/labels`, label, {
          headers : {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
          }
        }
      ).then(response => {
        this.labels = response.data.labels;
      })
      .catch(response => {
        console.log("error while add label");
      });
    },
    // send the updated label to server
    sendUpdatedLabel(label) {
      axios.put(`/projects/${this.projectId}/labels/${label.id}`, label, {
          headers : {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
          }
        }
      ).then(response => {
        this.labels = response.data.labels;
      }).catch(response => {
        console.log("error while editing labels");
      });
    },
    // send which label to delete to server
    deleteLabel(labelId) {
      axios.delete(`/projects/${this.projectId}/labels/${labelId}`, {
          headers : {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
          }
        }
      ).then(response => {
        this.labels = response.data.labels;
      }).catch(response => {
        console.log("error while deleting labels");
      });
    }
  },
  watch: {
    labelsInput() {
      this.labels = this.labelsInput
    },
    labels: {
      handler: function(oldVal, newVal) {
        this.$emit("labels-changed", this.labels)
      },
      deep: true,
      immediate: true
    }
  },
  components: {
    ModalLabel,
  }
};
</script>

<style lang="scss" scoped>
.label-to-edit {
  margin: 5px 0;
  padding: 3px 7px;
  border-radius: 3px;
  display: grid;
  grid-template-columns:auto 55px;

  button {
    color: white;
    padding: 0 4px;
  }
}
</style>
