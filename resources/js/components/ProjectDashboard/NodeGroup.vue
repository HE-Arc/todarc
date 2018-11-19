<template>
  <li class="node node-group">
    <span v-if="group" class="label">{{ group.name }} <i class="fas fa-arrows-alt"></i></span>
    <draggable element="ul" class="min-height" :list="groupsNew" :options="{group:'group', draggable:'.group', animation:200}">
      <node-group v-for="group in groupsNew" :key="group.id" v-bind:id="group.id" class="group"></node-group>
      <!-- <task-group v-for="task in tasks.filter(x=>x.group_id==id)" :key="task.id" v-bind:id="task.id"></task-group> -->
    </draggable>
    <!-- <button>Add group</button> -->
  </li>
</template>

<script>
import taskGroup from "./NodeTask";
import { mapState, mapGetters } from "vuex";

import draggable from "vuedraggable";

export default {
  name: "NodeGroup",
  props: {
    id: Number
  },
  inject: ["groups"],
  data() {
    return {
      groupsData: [],
      groupsNew: [],
      group: null
    };
  },
  computed: {
    ...mapState({
      //groups: state => state.groupsModule.groups,
      tasks: state => state.tasksModule.tasks
    }),
    ...mapGetters({
      //group: "groupsModule/group",
      //subGroup: "groupsModule/subGroups"
    })
  },
  components: {
    taskGroup,
    draggable
  },
  mounted(){
    this.groupsNew = this.groups.filter(g => g.group_id === this.id);
    this.group = this.groups.find(g => g.id === this.id);
  }
};
</script>

<style>
.min-height{
  min-height: 20px;
}
</style>
