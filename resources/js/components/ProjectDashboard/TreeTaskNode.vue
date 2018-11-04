<template>
  <li class="node-tree">
    <span class="label">{{ groups.name }}</span>
    <ul v-if="groupsLength>0">
      <node v-for="group in groups" :key="group.id" v-bind:id="group.id"></node>
    </ul>
  </li>
</template>

<script>
import { mapState } from 'vuex';

export default {
  name: "node",
  props: {
    id: Number
  },
  data:function(){
    return {
      //children = groups.filter(x=>x.group_id==key)
    }
  },
  computed: {
    group(){
      this.$store.state.groups.filter(x=>x.id==key);
    },
    groups(){
      this.$store.state.groups.filter(x=>x.group_id==key);
    },
    groupsLength() {
        return this.groups.length;
    }
  }
};
</script>