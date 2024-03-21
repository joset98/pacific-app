import Connection from '../../helpers/Connection.js';
import BaseUrl from '../../helpers/BaseUrl.js';

// Get All Machines
export async function getMachines (context, params) {
  const url = BaseUrl.getUrl('api/machines'+ params);
  const request = await Connection.request('get', url);
  return request;
}

// Get a Machine List
export async function getMachineList (context) {
  const url = BaseUrl.getUrl('api/machine/list');
  const request = await Connection.request('get', url);
  return request;
}

// Store Machines
export async function create (context, data) {
  const url = BaseUrl.getUrl('api/machines');
  const request = await Connection.request('post', url, data);
  // Si el logueo sale bien se guardan los datos en la Store
  return request;
}

export async function update (context, data) {
  const url = BaseUrl.getUrl(`api/machines/${data.get('id')}`);
  const request = await Connection.request('put', url, data);
  // Si el logueo sale bien se guardan los datos en la Store
  return request;
}
