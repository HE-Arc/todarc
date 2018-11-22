<template>
  <draggable element="ol" :list="groupsNew" :options="{group:'group', draggable:'.node-group', animation:200}" @change="change" class="min-height list-group list-group-root">
    <node-group v-for="group in groupsNew" :key="group.id" v-bind:id="group.id"></node-group>
  </draggable>
</template>

<script>
import NodeGroup from "./NodeGroup";
import draggable from 'vuedraggable';

import { bus } from "./BusEvent";

export default {
  name: "treeGroups",
  inject: ['groups', "updateGroups"],
  data: function() {
    return {
      groupsNew: []
    }
  },
  methods:{
    change(evt){
      this.updateGroups(this.groupsNew, null);
    },
    addGroup(group){
      if(group.group_id == null){
        this.groupsNew.push(group);
      }
    }
  },
  components: {
    NodeGroup,
    draggable
  },
  mounted() {
    this.groupsNew = this.groups.filter(g => g.group_id === null);
    bus.$on('addGroup', this.addGroup);
  }
};
</script>

<style lang="scss" scoped>
.node {
  padding-left: 16px;
  margin: 6px 0;
}

.min-height{
  min-height: 20px;
}
</style>