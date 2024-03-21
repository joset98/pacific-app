import Connection from '../../helpers/Connection.js';
import BaseUrl from '../../helpers/BaseUrl.js';

// Get All Providers
export async function getProviders (context, params) {
  const url = BaseUrl.getUrl('api/providers'+ params);
  const request = await Connection.request('get', url);
  return request;
}

// Get a Provider List 
export async function getProviderList (context) {
  const url = BaseUrl.getUrl('api/provider/list');
  const request = await Connection.request('get', url);
  return request;
}

// Store Providers
export async function create (context, data) {
  const url = BaseUrl.getUrl('api/providers');
  const request = await Connection.request('post', url, data);
  // Si el logueo sale bien se guardan los datos en la Store
  return request;
}

export async function update (context, data) {
  const url = BaseUrl.getUrl(`api/providers/${data.get('id')}`);
  const request = await Connection.request('put', url, data);
  // Si el logueo sale bien se guardan los datos en la Store
  return request;
}

