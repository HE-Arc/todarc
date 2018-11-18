<template>
  <div class="card">
    <h4 class="card-header">Tasks</h4>
    <div class="card-body">
      <h6>Tasks running : </h6>
      <tree-groups :groups="groups"></tree-groups>
    </div>
    <div class="card-footer">
      <a><button class="btn btn-light btn-block">Clic for no reason, feels free</button></a>
    </div>
  </div>
</template>

<script>

import treeGroups from "./TreeGroups";

export default {
  props: {
    project: {
      required: true
    },
    groups: {
      required: true
    }
  },
  components: {
    treeGroups
  },
  provide(){
    return {
      groups : this.groups
    }
  },
};
</script>

<style lang="scss" scoped>
</style>
