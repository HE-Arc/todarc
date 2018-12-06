<template>
  <div>
    <div v-for="label in labels" :key="label.id" class="label-to-edit" :style="getStyle(label)">
      <div class="label-name">
        {{ label.name }}
      </div>
      <div class="label-action">
        <button class="btn btn-link" @click="updateLabel(label)"><i class="fas fa-pen"></i></button>
        <button class="btn btn-link" @click="deleteLabel(label.id)"><i class="fas fa-trash-alt"></i></button>
      </div>
    </div>
    <div v-if="labels.length === 0">
      <p>
        No label in this project.
      </p>
    </div>
    <button class="btn btn-primary btn-block" @click="newLabel"><i class="fas fa-plus"></i> Add a label</button>
    <modal-label
      @confirmed="sendLabel"
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
    updateLabel(label) {
      this.$refs.modalLabel.open("Add a newLabel label", label);
    },
    // newLabel label clicked
    newLabel() {
      this.$refs.modalLabel.open("Add a newLabel label", {
        name : '',
        color : '#0000FF'
      });
    },
    // define if this is a newLabel or updateLabeld label
    sendLabel(label) {
      if('id' in label) {
        this.sendUpdated(label);
      } else {
        this.sendNew(label)
      }
    },
    // send the newLabel label to server
    sendNew(label) {
      axios.post( `/projects/${this.projectId}/labels`, label)
      .then(response => {
        this.labels = response.data.labels;
        // TODO: Emit newLabel labels
      })
      .catch(response => {
        console.log("error while add label");
      });
    },
    // send the updateLabeld label to server
    sendUpdated(label) {
      axios.put(`/projects/${this.projectId}/labels/${label.id}`, label)
      .then(response => {
        this.labels = response.data.labels;
        // TODO: Emit updateLabel labels
      }).catch(response => {
        console.log("error while editing labels");
      });
    },
    // send which label to deleteLabel to server
    deleteLabel(labelId) {
      axios.deleteLabel(`/projects/${this.projectId}/labels/${labelId}`)
      .then(response => {
        this.labels = response.data.labels;
        // TODO: Emit deleteLabel labels
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
      handler: function(oldVal, newLabelVal) {
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
