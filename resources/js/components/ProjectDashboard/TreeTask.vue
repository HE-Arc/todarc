<template>
  <div class="tree">
    <ul class="tree-list">
      <tree-task-node :node="treeData"></tree-task-node>
    </ul>
  </div>
</template>

<script>
import TreeTaskNode from "./TreeTaskNode";

export default {
    name:"tree",
    props: {
        treeData: Object
    },
    components: {
        TreeTaskNode
    }
};
</script>

<style>
.tree-list ul {
    padding-left: 16px;
    margin: 6px 0;
}
</style>