import store from '../store/main';

export default class {

  static getUrl(route){
    return store.state.apiUrl + '/' + route;
  }

}
