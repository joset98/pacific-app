import Connection from '../../helpers/Connection.js';
import BaseUrl from '../../helpers/BaseUrl.js';

// Get All sales
export async function getSales (context, params) {
  const url = BaseUrl.getUrl('api/sales'+ params);
  const request = await Connection.request('get', url);
  return request;
}

// Store Sales
export async function create (context, data) {
  const url = BaseUrl.getUrl('api/sales');
  const request = await Connection.request('post', url, data);
  // if the store is ok, send the response to front
  return request;
}

export async function update (context, data) {
  const url = BaseUrl.getUrl(`api/sales/${data.get('id')}`);
  const request = await Connection.request('put', url, data);
  return request;
}

export async function showSale (context, params) {
  const url = BaseUrl.getUrl('api/sales/'+ params);
  const request = await Connection.request('get', url);
  return request;
}

export async function showEditSale (context, params) {
  const url = BaseUrl.getUrl('api/sale/edit/'+ params);
  const request = await Connection.request('get', url);
  return request;
}

