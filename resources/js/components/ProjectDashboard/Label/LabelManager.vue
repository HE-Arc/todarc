<template>
  <div>
    <div v-for="label in labels" class="label-to-edit" v-bind:style="getStyle(label)">
      <div class="label-name">
        {{ label.name }}
      </div>
      <div class="label-action">
        <button class="btn btn-link"><i class="fas fa-pen"></i></button>
        <button class="btn btn-link"><i class="fas fa-trash-alt"></i></button>
      </div>
    </div>
  </div>
</template>

<script>
  import Label from "./Label";

  export default
  {
    data () {
      return {
        labels: this.labelsInput,
      }
    },
    props: {
      labelsInput : Array
    },
    methods:{
      getStyle(label) {
        return {
          backgroundColor: label.color
        };
      }
    }
  }
</script>

<style lang="scss" scoped>
  .label-to-edit
  {
    margin: 5px 0;
    padding: 3px 7px;
    border-radius: 3px;
    display: grid;
    grid-template-columns:auto 55px;

    button
    {
      color: white;
      padding: 0 4px;
    }
  }

</style>
