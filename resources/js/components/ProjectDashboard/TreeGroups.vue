<template>
  <div class="tree">
    <ul class="tree-list">
      <node-group v-if="groups" :key="null" v-bind:id="null"></node-group>
    </ul>
  </div>
</template>

<script>
import NodeGroup from "./NodeGroup";
import { mapState } from 'vuex';

export default {
    name:"treeGroups",
    mounted() {
        this.$store.dispatch('groupsModule/fetchGroups');
        this.$store.dispatch('tasksModule/fetchTasks');
    },
    components: {
        NodeGroup
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