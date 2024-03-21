import Vue from 'vue';
import Router from 'vue-router';
import pacificRoutes from './routes.js';
Vue.use(Router);

// Guards
import auth from './guards/auth.js';

let router = new Router({
  mode: 'history',
  routes: [
    //# Routers pacific
      ...pacificRoutes,
  ]
});
// Auth
router.beforeEach(auth);

// Export router
export default router;
