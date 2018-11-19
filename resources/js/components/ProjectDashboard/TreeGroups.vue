<template>
  <div class="tree">
    <h2>List 1</h2>
    
    <draggable element="ul" :list="groupsNew" :options="{group:'group', draggable:'.node-group', animation:200}" @change="change" class="tree-list min-height">
    
      <node-group v-for="group in groupsNew" :key="group.id" v-bind:id="group.id"></node-group>
    
    </draggable>
  </div>
</template>

<script>
import NodeGroup from "./NodeGroup";
import draggable from 'vuedraggable';

export default {
  name: "treeGroups",
  inject: ['groups', 'updateGroups'],
  mounted(){
    this.$store.dispatch('groupsModule/fetch');
  },
  data: function() {
    return {
      groupsNew: []
    }
  },
  methods:{
    change(evt){
      this.updateGroups(this.groupsNew, null);
    }
  },
  components: {
    NodeGroup,
    draggable
  },
  mounted() {
    this.groupsNew = this.groups.filter(g => g.group_id === null);
  }
};
</script>

<style lang="scss" scoped>
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