
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */
require('./bootstrap');
window.Vue = require('vue');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('user-dashboard-project', require('./components/UserDashboard/Project.vue'));
Vue.component('user-dashboard-organisation', require('./components/UserDashboard/Organisation.vue'));
Vue.component('add-new-org', require('./components/UserDashboard/AddNewOrg.vue'));
Vue.component('add-new-project', require('./components/UserDashboard/AddNewProject.vue'));
Vue.component('modal', require('./components/Modal.vue'));

const app = new Vue({
    el: '#user-dashboard'
});
