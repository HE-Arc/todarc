<template>
    <div class="tree">
        <div>
            <ul class="tree-list">
                <draggable :options="{draggable:'.group'}">
                    <node-group v-for="group in groups" :key="group.id" v-bind:id="group.id"></node-group>
                </draggable>
            </ul>
            <p>TESTS</p>
            
            <sl-vue-tree v-model="groupsData">
                <template slot="title" slot-scope="{ node }">
                    {{ node.title }}
                </template>
            </sl-vue-tree>
            {{groupsData}}
        </div>
    </div>
</template>

<script>
import NodeGroup from "./NodeGroup";
import { mapState, mapGetters } from 'vuex';

import draggable from 'vuedraggable';

import slVueTree from 'sl-vue-tree/dist/sl-vue-tree.js';
import 'sl-vue-tree/dist/sl-vue-tree-dark.css';

export default {
    name:"treeGroups",
    mounted() {
        this.$store.dispatch('groupsModule/fetch');
    },
    data: function () {
     return {
       
     }
    },
    components: {
        slVueTree,
        NodeGroup,
        draggable
    },
    computed: {
        ...mapState({groups: state => state.groupsModule.groups,
                    groupsData: state => state.groupsModule.groupsData}),
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