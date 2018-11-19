<template>
  <div class="tree">
    <h2>List 1</h2>
    
    <draggable element="ul" :list="groupsNew1" :options="{group:'group', draggable:'.group', animation:200}" class="tree-list min-height">
    
      <node-group v-for="group in groupsNew1" :key="group.id" v-bind:id="group.id" class="group node-group"></node-group>
    
    </draggable>

    <!-- TODO Remove the second list -->
    <h2>List 2</h2>
    <draggable element="ul" :list="groupsNew2" :options="{group:'group', draggable:'.group', animation:200}" class="tree-list min-height">
    
      <node-group v-for="group in groupsNew2" :key="group.id" v-bind:id="group.id" class="group node-group"></node-group>
    
    </draggable>
  </div>
</template>

<script>
import NodeGroup from "./NodeGroup";
import {
  mapState,
  mapGetters
} from 'vuex';
import draggable from 'vuedraggable';
export default {
  name: "treeGroups",
  inject: ["groups"],
  mounted() {
    this.$store.dispatch('groupsModule/fetch');
  },
  data: function() {
    return {
      groupsNew1: [],
      groupsNew2: []
    }
  },
  components: {
    NodeGroup,
    draggable
  },
  computed: { ...mapState({
      groupsD: state => state.groupsModule.groups,
      groupsData: state => state.groupsModule.groupsData
    }),
  },
  mounted() {
    this.groupsNew1 = this.groups.filter(g => g.group_id === null);
    this.groupsNew2 = this.groups.filter(g => g.group_id === null);
  }
}; 
</script>

<style>
.node {
  padding-left: 16px;
  margin: 6px 0;
}
.node-task {
  background-color: red;
}
.min-height{
  min-height: 20px;
}
</style>