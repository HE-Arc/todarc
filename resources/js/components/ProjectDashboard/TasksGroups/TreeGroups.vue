<template>
  <draggable element="ol" :list="groupsNew" :options="{handle:'.handle', group:'group', draggable:'.node-group', animation:200}" @change="change" class="min-height list-group list-group-root">
    <node-group v-for="group in groupsNew" :key="group.id" :id="group.id"></node-group>
  </draggable>
</template>

<script>
import NodeGroup from "./NodeGroup";
import draggable from 'vuedraggable';

import { BUS } from "../BusEvent";

export default {
  name: "treeGroups",
  inject: ['groups', "updateGroups"],
  data() {
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
    },
    refreshGroups(groupsData){
      this.groupsNew = groupsData.filter(group=>group.group_id==null);
    }
  },
  components: {
    NodeGroup,
    draggable
  },
  mounted() {
    this.groupsNew = this.groups.filter(g => g.group_id === null);
    BUS.$on('refreshGroups', this.refreshGroups);
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
