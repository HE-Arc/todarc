<template>
    <div class="tree">
        <div>
            <ul class="tree-list">
                <node-group v-if="groups" :key="null" v-bind:id="null"></node-group>
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
import nodeGroup from "./NodeGroup";
import { mapState } from 'vuex';

//import draggable from 'vuedraggable';
import slVueTree from 'sl-vue-tree/dist/sl-vue-tree.js';
import 'sl-vue-tree/dist/sl-vue-tree-dark.css';

export default {
    name:"treeGroups",
    mounted() {
        this.$store.dispatch('groupsModule/fetch');
    },
       data: function () {
     return {
       nodes: nodes,
       test: test
     }
    },
    components: {
        slVueTree,
        nodeGroup
    },
    computed: {
        ...mapState({groups: state => state.groupsModule.groups,
                    groupsData: state => state.groupsModule.groupsData})
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