import store from '../../store/index.js';

export default async (to, from, next) => {
  // Is autentication
  if(store.getters["main/getMe"] == null) await store.dispatch("main/isAutenticated");

  // Verify autentication
  if (store.getters["main/getMe"] != null){
    if(to.name == 'login' || to.name == 'register') next({name: "home"});
    else next();
  }else{
    if(to.name != 'login' && to.name != 'register' && to.name != 'construction') next({name: "login"});
    else next();
  }
}
