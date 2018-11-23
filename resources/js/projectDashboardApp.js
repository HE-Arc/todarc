
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
import Vue from 'vue';
window.Vue = Vue;

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('project-dashboard', require('./components/ProjectDashboard/Project.vue'));
Vue.component('project-summary', require('./components/ProjectDashboard/ProjectSummary.vue'));

const app = new Vue({
    el: '#project-dashboard',
    data () {
      return {
        nbTasksDone: 0,
        nbTasksRunning: 0
      }
    },
    methods: {
      updateNbTasks(nbTasksDone, nbTasksRunning)
      {
        console.log('enfin')
        this.nbTasksDone = nbTasksDone;
        this.nbTasksRunning = nbTasksRunning;
      }
    }

});
