<template>
  <div class="node node-group">
    <draggable element="node-group" :options="{draggable:'.group'}">
      <span v-if="group(id)" font-color="green" class="label">{{ group(id).name }}</span>
      <node-group v-for="group in groups.filter(x=>x.group_id==id)" :key="group.id" v-bind:id="group.id" class="group"></node-group>
      <button>Add group</button>
    </draggable>
    
  </div>
</template>

<script>
import taskGroup from "./NodeTask";
import { mapState, mapGetters } from 'vuex';

import draggable from 'vuedraggable'

export default {
  name: "nodeGroup",
  props: {
    id: Number
  },
  computed: {
    ...mapState({ groups: state => state.groupsModule.groups,
                  tasks: state => state.tasksModule.tasks}),
    ...mapGetters({
      group: 'groupsModule/group',
      subGroup: 'groupsModule/subGroups',
    })
  },
  components: {
    taskGroup,
    draggable
  },
};
</script>