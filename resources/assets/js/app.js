
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */


window.Vue = require('vue');
window.axios = require('axios');
window._ = require('lodash');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('leaderboard', require('./components/Leaderboard.vue'));
Vue.component('leaderboard_revamped', require('./components/leaderboard_revamped.vue'));
Vue.component('team-standings', require('./components/TeamStandings.vue'));
Vue.component('timer', require('./components/Clock.vue'));
Vue.component('lift', require('./components/Lift.vue'));

let app = new Vue({
    el: '#app'
});
