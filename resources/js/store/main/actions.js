import Connection from '../../helpers/Connection.js';
import BaseUrl from '../../helpers/BaseUrl.js';

// sessionStorage
// localStorage

// Register user
export async function register (context, data) {
  const url = BaseUrl.getUrl('api/register');
  const request = await Connection.request('post', url, data);
  return request;
}

// Login
export async function login (context, data) {
  const url = BaseUrl.getUrl('api/login');
  const request = await Connection.request('post', url, data);
  // Si el logueo sale bien se guardan los datos en la Store
  if (request.ok) setDataUser(context, request.data.token, request.data.user);
  return request;
}

// Desloguear
export async function logOut (context, reload) {
  const url = BaseUrl.getUrl('api/logout');
  const request = await Connection.request('post', url);
  // Borrando datos de las Store
  setDataUser(context, null, null);
  if(reload) window.location.reload();
  return request;
}

// Obtener mis datos
export async function getMe(context) {
  const url = BaseUrl.getUrl('api/me');
  const request = await Connection.request('get', url);
  if(request.ok) context.commit('setProperty', {key: 'user', data: request.data});
  return request;
}

// Verificando autenticacion
export async function isAutenticated (context) {
  // Se busca la existencia de un token en la storage del navegador
  let token = localStorage.getItem('token');
  if (!token || token == null || token == 'null'){
    token = sessionStorage.getItem('token');
    if(!token || token == null || token == 'null') return false;
  }
  // Si se encuentra el token se guarda en los headers
  Connection.setHeaders({Authorization: 'Bearer ' + token});

  // Se intenta hacer una peticion "getMe".
  let request = await context.dispatch('getMe');
  if (request.ok){
    setDataUser(context, token, request.data);
    return true;
  }

  // Si no existe un usuario en el state no se desloguea...
  if(!context.state.user) return false;
  logOut(context, false);
}

// Establecer datos de usuario
function setDataUser (context, token, user) {
  // Headers
  Connection.setHeaders({Authorization: 'Bearer ' + token});
  // Store
  context.commit('setProperty', {key: 'token', data: token});
  context.commit('setProperty', {key: 'user', data: user});
  // SessionStorage
  sessionStorage.setItem('token', token);
  // LocalStorage
  if(user && user.remenber_me) localStorage.setItem('token', token);
  else localStorage.setItem('token', null);
}
