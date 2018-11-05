<template>
  <div class="tree">
    <ul class="tree-list">
      <tree-task-node v-if="groups" :key="null" v-bind:id="null"></tree-task-node>
    </ul>
  </div>
</template>

<script>
import TreeTaskNode from "./TreeTaskNode";
import { mapState } from 'vuex';

export default {
    name:"tree",
    mounted() {
        this.$store.dispatch('groupsModule/fetch');
    },
    components: {
        TreeTaskNode
    },
    computed: {
        ...mapState({groups: state => state.groupsModule.groups})
    }
};
</script>

<style>
.tree-list ul {
    padding-left: 16px;
    margin: 6px 0;
}
</style>