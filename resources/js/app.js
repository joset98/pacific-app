// In case of not using a template (optional)
// require('./bootstrap');

window.Vue = require('vue');
import Vue from 'vue';
import VueRouter from 'vue-router'
Vue.use(VueRouter);

// Store of vue
import Store from './store/store';
Vue.use(Store);

// Component app
Vue.component('app', require('./app.vue').default);

// Inports
import router from './router';

// Other Imports
import './helpers/vue';

// Librery ModalSlot
import '@darens/modal-slot/dist/modal-slot.css';
import ModalSlot from '@darens/modal-slot';
Vue.use(ModalSlot);

const app = new Vue({
  el: '#app',
  router,
  linkActiveClass: 'active'
});
