import Connection from '../../helpers/Connection.js';
import BaseUrl from '../../helpers/BaseUrl.js';

// Get All Users
export async function getUsers (context, params) {
  const url = BaseUrl.getUrl('api/users'+ params);
  console.log(params)
  console.log(url)
  const request = await Connection.request('get', url);
  return request;
}

// Store users
export async function create (context, data) {
  const url = BaseUrl.getUrl('api/users');
  const request = await Connection.request('post', url, data);
  // if the store is ok, send the response to front
  return request;
}

export async function update (context, data) {
  const url = BaseUrl.getUrl(`api/users/${data.get('id')}`);
  const request = await Connection.request('put', url, data);
  // Si el logueo sale bien se guardan los datos en la Store
  return request;
}

export async function deleteItem (context, data) {
  const url = BaseUrl.getUrl(`api/users/${data.get('id')}`);
  const request = await Connection.request('delete', url, data);
  // Si el logueo sale bien se guardan los datos en la Store
  return request;
}