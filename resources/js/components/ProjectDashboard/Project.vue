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

import TreeGroups from "./TreeGroups";

export default {
  props: ["project", "groups"],
  components: {
    TreeGroups
  }
};
</script>

<style lang="scss" scoped>
</style>
