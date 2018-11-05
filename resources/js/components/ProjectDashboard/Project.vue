<template>
  <div class="card text-center">
    <h4 class="card-header">Tasks</h4>
    <div class="card-body">
      <h6>Tasks running : </h6>
      <tree :groups="groups"></tree>
    </div>
    <div class="card-footer">
      <a><button class="btn btn-light btn-block">Clic for no reason, feels free</button></a>
    </div>
  </div>
</template>

<script>

import Tree from "./TreeTask";

export default {
  props: ["project", "groups"],
  components: {
    Tree
  }
};
</script>

<style lang="scss" scoped>
</style>
