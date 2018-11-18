<template>
  <div class="node node-group">
    <draggable :options="{draggable:'.group'}" :list="groupsNew">
        <span v-if="group(id)" class="label">{{ group(id).name }}</span>
        <node-group v-for="group in groups.filter(x=>x.group_id==id)" :key="group.id" v-bind:id="group.id" class="group"></node-group>
        <hr>
        <button>Add group</button>
    </draggable>
    <!-- <task-group v-for="task in tasks.filter(x=>x.group_id==id)" :key="task.id" v-bind:id="task.id"></task-group> -->
  </div>
</template>

<script>
import taskGroup from "./NodeTask";
import { mapState, mapGetters } from 'vuex';

import draggable from 'vuedraggable';

export default {
  name: "NodeGroup",
  props: {
    id: Number
  },
  data() {
    return {
      groupsNew: this.id
    }
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
    draggable,
  },
};
</script>