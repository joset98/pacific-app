<template>
  <li class="dropdown">
    <a class="dropdown-toggle no-after peers fxw-nw ai-c lh-1" data-toggle="dropdown">
      <div class="peer mR-10">
        <img class="w-2r bdrs-50p" :src="avatar" alt="">
      </div>
      <div class="peer">
        <span v-if="user" class="fsz-sm c-grey-900">{{user.name}}</span>
      </div>
    </a>
    <ul class="dropdown-menu fsz-sm">
      <li v-for="(link, index) in menu" :key="index">
        <a @click="goToRouter(link.path)" class="d-b td-n pY-5 bgcH-grey-100 c-grey-700">
          <i :class="['mR-10', link.icon]"></i>
          <span>{{link.name}}</span>
        </a>
      </li>
      <li role="separator" class="divider"></li>
      <li>
        <a @click="logOut" class="d-b td-n pY-5 bgcH-grey-100 c-grey-700">
          <i class="ti-power-off mR-10"></i>
          <span>Cerrar sesion</span>
        </a>
      </li>
    </ul>
  </li>
</template>

<script>
export default {
  name: 'profile',
  props:{
    avatar:{
      type: String,
      default: 'adminator/images/user.png'
    },
    menu:{
      type: [Object, Array],
      default: null
    },
  },
  methods:{
    //# Ir a
    goToRouter(path){
      return this.$router.push(path);
    },
    //# Close sesion
    async logOut(){
      // this.$loader.full();
      let request = await this.$store.dispatch('main/logOut', true);
      // this.$loader.hide();
      let {type, title, text} = this.$requestToNotification.transformRequest(request);
      console.log(type, title, text)
      this.$actionNotify.showNotification(type, title, text);
    }
  },
  computed:{
    user:{ get(){ return this.$store.getters['main/getMe'] } },
  }
}
</script>
