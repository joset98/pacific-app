import Vue from 'vue';
import Router from 'vue-router';
import RouterAdminator from '../adminator/router';
Vue.use(Router);

// Guards
import auth from './guards/auth.js';

let router = new Router({
  mode: 'history',
  routes: [
    //# Routers adminator
      ...RouterAdminator,

    //# Routers customizable
      // {
      //   path: '/',
      //   component: require('../layout/main.vue').default,
      //   children: [
      //     {
      //       path: '/inicio',
      //       name: 'home',
      //       component: require('../views/home.vue').default
      //     },
      //   ]
      // }
      // {
      //   path: '*',
      //   redirect: '/'
      // }

  ]
});

// Auth
router.beforeEach(auth);

// Export router
export default router;
