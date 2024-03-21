import Connection from '../../helpers/Connection.js';
import BaseUrl from '../../helpers/BaseUrl.js';

// Get All Sell States
export async function getSellStates (context, params) {
  const url = BaseUrl.getUrl('api/sell/states'+ params);
  const request = await Connection.request('get', url);
  return request;
}

// Store Sell States
export async function create (context, data) {
  const url = BaseUrl.getUrl('api/sell/states');
  const request = await Connection.request('post', url, data);
  // if the store is ok, send the response to front
  return request;
}

export async function update (context, data) {
  const url = BaseUrl.getUrl(`api/sell/states/${data.get('id')}`);
  const request = await Connection.request('put', url, data);
  // Si el logueo sale bien se guardan los datos en la Store
  return request;
}

export async function getSellStateList (context, params) {
  const url = BaseUrl.getUrl('api/sell/state/list');
  const request = await Connection.request('get', url);
  return request;
}
