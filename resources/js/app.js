/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

// Item
Vue.component('item-card', require('./components/item/Card').default);

Vue.component('search', require('./components/Search').default);

// Navigation
Vue.component('navigation', require('./components/navigation/Navigation').default);
Vue.component('navigation-list-item', require('./components/navigation/NavigationListItem').default);

// Notification
Vue.component('notification-container', require('./components/notification/NotificationContainer').default);
Vue.component('notification-item', require('./components/notification/NotificationItem').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
});
