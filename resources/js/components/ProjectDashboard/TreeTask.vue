<template>
  <div class="tree">
    <ul class="tree-list">
      <tree-task-node :key="null" v-bind:id="null"></tree-task-node>
    </ul>
  </div>
</template>

<script>
import TreeTaskNode from "./TreeTaskNode";

export default {
    name:"tree",
    props: {

    },
    loaded:{
        //root = groups.filter(x=>x.group_id==null)
    },
    computed: {
        
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