<template>
  <div class="card text-center">
    <h4 class="card-header">Tasks</h4>
    <div class="card-body">
      <h6>Tasks running : </h6>
      <tree :tree-data="tree"></tree>
    </div>
    <div class="card-footer">
      <a><button class="btn btn-light btn-block">Clic for no reason, feels free</button></a>
    </div>
  </div>
</template>

<script>

import Tree from "./TreeTask";

const tree = {
  label: "A cool folder",
  children: [
    {
      label: "A cool sub-folder 1",
      children: [
        { label: "A cool sub-sub-folder 1" },
        { label: "A cool sub-sub-folder 2" }
      ]
    },
    { label: "This one is not that cool" }
  ]
}
export default {
  props: [
    'project', 'groups'
  ],
  data: () => ({
    tree: {
      label: "A cool folder",
      children: [
        {
          label: "A cool sub-folder 1",
          children: [
            { label: "A cool sub-sub-folder 1" },
            { label: "A cool sub-sub-folder 2" }
          ]
        },
        { label: "This one is not that cool" }
      ]
    }
  }),
  components: {
    Tree
  }
};
</script>

<style lang="scss" scoped>
</style>
