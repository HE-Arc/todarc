<template>
    <div class="tree">
        <div>
            <h2>List 1</h2>
            <ul class="tree-list">
                <draggable :list="groupsNew1" :options="{group:'group'}">
                    <!-- <div v-for="group in groupsNew1" :key="group.id" v-bind:id="group.id" class="node node-group">
                        <span class="label">{{ group.name }}</span>
                    </div> -->
                    <node-group v-for="group in groupsNew1" :key="group.id" v-bind:id="group.id" class="node node-group"></node-group>
                </draggable>
            </ul>
            <h2>List 2</h2>
            <ul class="tree-list">
                <draggable :list="groupsNew2" :options="{group:'group'}">
                    <node-group v-for="group in groupsNew2" :key="group.id" v-bind:id="group.id"></node-group>
                    <!-- <div v-for="group in groupsNew2" :key="group.id" v-bind:id="group.id" class="node node-group">
                        <span class="label">{{ group.name }}</span>
                    </div> -->
                </draggable>
            </ul>
            <p>TESTS</p>
            {{groupsData}}
        </div>
    </div>
</template>

<script>
import NodeGroup from "./NodeGroup";
import { mapState, mapGetters } from 'vuex';

import draggable from 'vuedraggable';

export default {
    name:"treeGroups",
    inject:["groups"],
    mounted() {
        this.$store.dispatch('groupsModule/fetch');
    },
    data: function () {
     return {
       groupsNew1: [],
       groupsNew2: []
     }
    },
    components: {
        NodeGroup,
        draggable
    },
    computed: {
        ...mapState({groupsD: state => state.groupsModule.groups,
                    groupsData: state => state.groupsModule.groupsData}),
    },
    mounted(){
        this.groupsNew1 = this.groups.filter(g=>g.group_id === null);
        this.groupsNew2 = this.groups.filter(g=>g.group_id === null);
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
</style>