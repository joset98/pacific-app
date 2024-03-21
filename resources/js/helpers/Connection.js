import store from '../store';

var headersGenerals = {};

export default class Connection {
  // Asignar o desasignar los headers de mi ruta
  static setHeaders(headers){ for (var header in headers) headersGenerals[header] = headers[header]; }
  static removeHeaders(){ for (var header in headersGenerals) headersGenerals[header] = ''; }
  // Get Errors
  static getErrors(response){
    let error = 'Error';
    if (response.data) error = (Connection.isJsonString(response.data)) ? JSON.parse(response.data) : response.data;
    return error;
  }
  static isJsonString(item) {
    try {
      JSON.parse(item);
      return true;
    } catch (e) {
      return false;
    }
    return true;
  }

  // Request function
  static async request(method, url, formData = null, headers = null, isFormData = null ) {

    if (isFormData === null) isFormData = (formData instanceof FormData) ? true : false;

    if (!headers)
        headers = {
            //'Content-Type': (isFormData) ? 'multipart/form-data' : 'application/x-www-form-urlencoded',
            'X-Requested-With': 'XMLHttpRequest',
            //'x-requested-with': 'XMLHttpRequest',
            //'Access-Control-Allow-Origin': 'origin-list',
            //'Access-Control-Allow-Headers': 'X-Requested-With, x-requested-with, access-control-allow-headers, Access-Control-Allow-Headers',
            ...headersGenerals
        }

    try {
      const response = await Connection.fetch( url , method , formData, headers, isFormData );
      console.log("===========================");
      console.log(response);
      if (response.ok) return { ok: true, data: response.data };

      const errorResponse = Connection.getErrors(response);

      if (errorResponse && ( errorResponse == 'Tonken invalid' || errorResponse == 'Token expired' || errorResponse == 'Token no found' )) {
        store.dispatch('main/logOut', true);
      }


      return { ok: false, data: errorResponse, status: response.status };

    } catch (e) {
      return { ok: false, data: Connection.getErrors({ data: e, status: 600 }) };
    }

    return false;
  }
  // Peticion Type fetch
  static fetch(url, method = 'GET', data = null, headers = null, isFormData = false){


    if (isFormData && (method != 'POST' || method != 'post' || method != 'GET' || method != 'get' )) {
      data.append('_method',method);
      method = 'post';
    }

    if (!headers)
      headers = {
        //'Content-Type': (isFormData) ? 'multipart/form-data' : 'application/json',
        ...headersGenerals
      };

    let myInit = { method, headers, mode: 'cors', cache: 'default' };

    if (data) myInit.body = (isFormData) ? data : qs.stringify(data);

    const myRequest = new Request(url, myInit);

    return fetch(myRequest).then(async res => {

        try {
          return { ok: res.ok, data: await res.clone().json(), status:res.status };
        } catch (e) {
          return { ok: false, data: await res.clone().text(), status:res.status };
        }

    })
    .catch(function(error) {
      throw error.message;
    });

  }

}
