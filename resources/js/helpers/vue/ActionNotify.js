import Vue  from 'vue'
import Notifications from 'vue-notification'
Vue.use(Notifications);

export default{
    showNotification(type, title, text){
        Vue.notify({
            group: 'foo',
            title: title,
            type: type,
            text: text,
        })
    }
}
