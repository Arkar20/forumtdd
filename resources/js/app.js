/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue').default;

Vue.prototype.authorize = function (handler) {
    return handler(window.App.authUser) ;
}
// Vue.component('example', require('./components/ExampleComponent.vue').default);
// Vue.component('flash-component', require('./components/FlashComponent.vue').default);
// Vue.component('button-component', require('./components/ButtonComponent.vue').default);
Vue.component('thread-view', require('./pages/ThreadComponent.vue').default);


const app = new Vue({
    el: '#app',
});
