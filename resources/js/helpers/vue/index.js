// Vue
import Vue from 'vue';
// Imports
import AllErrors from './AllErrors.js';
import Loader from './Loader.js';
import ToFormData from './ToFormData.js';
import MPage from '@darens/mpage/dist/index.js';
import ActionNotify from './ActionNotify.js';
import RequestToNotification from './RequestToNotification.js';
import FormatNumber from './FormatNumber.js';

const myClass = {
  allErrors: AllErrors,
  loader: Loader,
  toFormData: ToFormData,
  mpage: MPage,
  actionNotify: ActionNotify,
  requestToNotification: RequestToNotification,
  formatNumber: FormatNumber
}
// Install
for (var key in myClass) Vue.prototype['$'+key] = myClass[key];
