import Vue from 'vue';
import Vuex from 'vuex';
import tasks from './Task.js';
import groups from './Groups.js';

const tasksModule = tasks;
const groupsModule = groups;

// injecting modules instead of state, actions and mutations

Vue.use(Vuex);

const store = new Vuex.Store({
  modules: {
    tasksModule,
    groupsModule
  }
});

export default store;