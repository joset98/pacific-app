import Vue from 'vue';
import Vuex from 'vuex';
import main from './main';
import users from './users';
import sellStates from './sellStates';
import machines from './machines';
import providers from './providers';
import sales from './sales';
import comments from './comments';

Vue.use(Vuex);

const debug = process.env.NODE_ENV !== 'production'

export default new Vuex.Store({
  modules: {
    main,
    users,
    sellStates,
    machines,
    providers,
    sales,
    comments
  },
  strict: debug
});
