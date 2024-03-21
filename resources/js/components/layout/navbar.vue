<template>
  <div class="header navbar">
    <div class="header-container">
      <ul class="nav-left">
        <li>
          <a @click="openDrawer" id='sidebar-toggle' class="sidebar-toggle" href="javascript:void(0);">
            <i class="ti-menu"></i>
          </a>
        </li>
        <li v-if="false" :class="['search-box', {'active': showInput}]">
          <a @click="showInput = !showInput" class="search-toggle no-pdd-right" href="javascript:void(0);">
            <i class="search-icon ti-search pdd-right-10"></i>
            <i class="search-icon-close ti-close pdd-right-10"></i>
          </a>
        </li>
        <li v-if="false" :class="['search-input', {'active': showInput}]">
          <input v-model="search" class="form-control mySearchInput" type="text" placeholder="Buscar...">
        </li>
      </ul>

      <ul class="nav-right">
        <at-btn-notifications :counter="generals.length">
          <at-notifications classList="menuDropdownCuztom" v-model="generals" title="Notificaciones" />
        </at-btn-notifications>

        <at-btn-notifications :counter="generals.length" icon="ti-email">
          <at-notifications classList="menuDropdownCuztom1" v-model="generals" title="Correos" icon="ti-email" />
        </at-btn-notifications>

        <at-profile :menu="menu"></at-profile>
      </ul>
    </div>
  </div>
</template>

<script>
import {AtNotifications, AtBtnNotifications} from '../cards/notifications';
import {AtProfile} from '../cards';

export default {
  name: 'navbar-adminator',
  components:{ AtNotifications, AtBtnNotifications, AtProfile },
  data(){
    return{
      showInput: false,
      search: null,
      generals: [
        {img: 'https://randomuser.me/api/portraits/men/1.jpg', title: 'John Doe', date: '5 mins ago', desc: 'Want to create your own customized data generator for your app...'},
        {img: 'https://randomuser.me/api/portraits/men/1.jpg', title: 'John Doe', date: '5 mins ago', desc: 'Want to create your own customized data generator for your app...'},
        {img: 'https://randomuser.me/api/portraits/men/1.jpg', title: 'John Doe', date: '5 mins ago', desc: 'Want to create your own customized data generator for your app...'},
      ],
      menu:[
        {name:'Mi perfil', path:'/inicio', icon:'ti-user'},
        {name:'Inicio', path:'/inicio', icon:'ti-home'},
      ]
    }
  },
  methods:{
    //# Drawer
    openDrawer(){
      this.drawer = !this.drawer;
      this.isCollapsed = !this.isCollapsed;
    },
  },
  computed:{
    user:{ get(){ return this.$store.getters['main/getMe'] } },
    drawer:{
      get(){ return this.$store.getters['main/getDrawerState']; },
      set(val){ this.$store.commit('main/setProperty', {key:'drawer', data: val})}
    },
    isCollapsed:{
      get(){ return this.$store.getters['main/getIsCollapsed']; },
      set(val){ this.$store.commit('main/setProperty', {key:'isCollapsed', data: val})}
    }
  }
}
</script>

<style media="screen">
.mySearchInput{
  min-width: 180px !important;
  max-width: 400px !important;
}
@media (max-width:500px){
  .menuDropdownCuztom1{
    min-width: 310px !important;
    right: -111px !important;
  }
  .menuDropdownCuztom{
    min-width: 310px !important;
    right: -158px !important;
  }
}
</style>
