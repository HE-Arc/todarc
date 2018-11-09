<template>
  <li class="node-tree">
    <span v-if="group(id)" font-color="green" class="label">{{ group(id).name }}</span>
    <ul v-if="groups.filter(x=>x.id==id)">
      <node-group v-for="group in groups.filter(x=>x.group_id==id)" :key="group.id" v-bind:id="group.id"></node-group>
    </ul>
    <task-group v-for="task in tasks.filter(x=>x.group_id==id)" :key="task.id" v-bind:id="task.id"></task-group>
  </li>
</template>

<script>
import TaskGroup from "./NodeTask";
import { mapState, mapGetters } from 'vuex';

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
    TaskGroup
  },
};
</script>