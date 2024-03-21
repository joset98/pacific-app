import Connection from '../../helpers/Connection.js';
import BaseUrl from '../../helpers/BaseUrl.js';

// Get a comment List
export async function getComments (context, saleId) {
  const url = BaseUrl.getUrl(`api/sale/${saleId}/comments`);
  const request = await Connection.request('get', url);
  return request;
}

// Store comment
export async function sendComment (context, data) {
  const url = BaseUrl.getUrl(`api/sale/comments`);
  const request = await Connection.request('post', url, data);
  // Si el logueo sale bien se guardan los datos en la Store
  return request;
}
