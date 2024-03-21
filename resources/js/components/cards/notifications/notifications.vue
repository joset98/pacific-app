<template>
  <ul :class="['dropdown-menu', classList]">
    <li class="pX-20 pY-15 bdB">
      <i :class="['pR-10', icon]"></i>
      <span v-if="title" class="fsz-sm fw-600 c-grey-900">{{title}}</span>
    </li>
    <li>
      <ul class="ovY-a pos-r scrollable lis-n p-0 m-0 fsz-sm">
        <li v-if="notifications.length > 0" v-for="(notification, index) in notifications" :key="index">
          <a v-if="notification" class='peers fxw-nw td-n p-20 bdB c-grey-800 cH-blue bgcH-grey-100'>
            <div v-if="notification.img" class="peer mR-15">
              <img class="w-3r bdrs-50p" :src="notification.img" alt="">
            </div>
            <div class="peer peer-greed">
              <div>
                <div class="peers jc-sb fxw-nw mB-5">
                  <div v-if="notification.title" class="peer">
                    <p class="fw-500 mB-0">{{notification.title}}</p>
                  </div>
                  <div v-if="notification.date" class="peer">
                    <small class="fsz-xs">{{notification.date}}</small>
                  </div>
                </div>
                <span v-if="notification.desc" class="c-grey-600 fsz-sm">
                  {{notification.desc}}
                </span>
              </div>
            </div>
          </a>
        </li>
        <li v-if="notifications.length == 0" class="py-5 d-flex justify-content-center aling-items-center">
          <h5 class="c-grey-600">
            {{noResults}}
          </h5>
        </li>
      </ul>
    </li>
    <li v-if="notifications.length > 0" class="pX-20 pY-15 ta-c bdT">
      <span>
        <a @click="notifications = []" class="c-grey-600 cH-blue fsz-sm td-n">{{footerTitle}} <i :class="['fsz-xs mL-10', footerIcon]"></i></a>
      </span>
    </li>
  </ul>
</template>

<script>
export default {
  name: 'notifications',
  props:{
    value:{
      type: [Array, Object],
      default: null
    },
    title:{
      type: String,
      default: null
    },
    icon:{
      type: String,
      default: 'ti-bell'
    },
    footerTitle:{
      type: String,
      default: 'Borrar todas'
    },
    footerIcon:{
      type: String,
      default: 'ti-angle-right'
    },
    noResults:{
      type: String,
      default: 'Sin resultados'
    },
    classList:{
      type: String,
      default: ''
    }
  },
  computed:{
    notifications:{
      get(){ return this.value; },
      set(val){ this.$emit('input', val)}
    }
  }
}
</script>
