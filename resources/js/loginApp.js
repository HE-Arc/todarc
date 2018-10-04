
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */


window.Vue = require('vue');
window.BootstrapVue = require('bootstrap-vue');
window.axios = require('axios');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('example-component', require('./components/ExampleComponent.vue'));

var appLogin = new Vue({
  el: '#login-form',
  data: {
    email: '',
    password: '',
    remember: false,
    valid: true
  },
  methods: {
    submit: function(event) {
      //send data in json
      axios.post(
        '/login',
        this.$data,
        {
          headers : {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
          }
        }
      ).then(response =>
      {
        window.location.pathname = response.data.redirectTo;
      }, response =>
      {
        this.$data.valid = false;
      });

      return false;
    }
  }
});
