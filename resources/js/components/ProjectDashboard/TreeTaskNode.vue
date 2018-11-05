<template>
  <li class="node-tree">
    <span v-if="group(id)" font-color="green" class="label">{{ group(id).name }}</span>
    <ul v-if="groups.filter(x=>x.id==id)">
      <node v-for="group in groups.filter(x=>x.group_id==id)" :key="group.id" v-bind:id="group.id"></node>
    </ul>
  </li>
</template>

<script>
import { mapState, mapGetters } from 'vuex';

export default {
  name: "node",
  props: {
    id: Number
  },
  computed: {
    search(){
      return this.$store.getters["groupsModule/group"](this.id);
    },
    ...mapState({groups: state => state.groupsModule.groups}),
    ...mapGetters({
      group: 'groupsModule/group',
      subGroup: 'groupsModule/subGroups',
    }),
    tempTest() {
      //if (this.groups) {
        return this.$store.getters['groupsModule/group'](this.id);
      //}
    }
  }
};
</script>