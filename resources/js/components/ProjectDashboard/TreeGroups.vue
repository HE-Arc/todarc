<template>
  <div class="tree">
    <h2>List 1</h2>
    
    <draggable element="ul" :list="groupsNew1" :options="{group:'group', draggable:'.node-group', animation:200}" @change="change" class="tree-list min-height">
    
      <node-group v-for="group in groupsNew1" :key="group.id" v-bind:id="group.id"></node-group>
    
    </draggable>

    <!-- TODO Remove the second list -->
    <h2>List 2</h2>
    <draggable element="ul" :list="groupsNew2" :options="{group:'group', draggable:'.node-group', animation:200}" class="tree-list min-height">
    
      <node-group v-for="group in groupsNew2" :key="group.id" v-bind:id="group.id"></node-group>
    
    </draggable>
  </div>
</template>

<script>
import NodeGroup from "./NodeGroup";
import { mapState, mapGetters } from 'vuex';

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
  methods:{
    change(evt){
      console.log(evt);

      // added: contains information of an element added to the array
      //     newIndex: the index of the added element
      //     element: the added element
      // removed: contains information of an element removed from to the array
      //     oldIndex: the index of the element before remove
      //     element: the removed element
      // moved: contains information of an element moved within the array
      //     newIndex: the current index of the moved element
      //     oldIndex: the old index of the moved element
      //     element: the moved element
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