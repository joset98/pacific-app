import Vue from 'vue';
import Loading from 'vue-loading-overlay';
import 'vue-loading-overlay/dist/vue-loading.css';
Vue.use(Loading);

var loader = null;

export default class {


  static full(){
    loader = Vue.$loading.show({
      zIndex: 999999999*999999,
      'lock-scroll': true,
      backgroundColor: 'rgba(0,0,0,.95)',
      color: 'rgb(243, 242, 242)',
    });
  }

  static containe(ref){
    loader = Vue.$loading.show({
      zIndex: 999999999*999999,
      backgroundColor: 'rgba(0,0,0,.95)',
      color: 'rgb(243, 242, 242)',
      container: ref
    });
  }

  static dinamic(){
    loader = Vue.$loading.show({
      zIndex: 999999999*999999,
      backgroundColor: 'transparent',
      color: '#000',
      container: document.getElementById('loaderDinamic'),
      width: 35,
      height: 35,
      opacity: 1,
      transition: 'fade'
    });
  }

  static hide(){
    loader.hide();
  }
}
