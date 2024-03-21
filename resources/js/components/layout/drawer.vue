<template>
  <div id="main-drawer" class="sidebar" :stlye="(drawer) ? 'width: 280px !important': ''">
    <div class="sidebar-inner">
      <!-- ### $Sidebar Header ### -->
      <at-sidebar>Adminator</at-sidebar>

      <!-- ### $Sidebar Menu ### -->
      <ul @mouseleave="mouseleave" @mouseover="mouseover" class="sidebar-menu scrollable pos-r">
        <at-item-menu
                      v-for="(item, index) in myItems"
                      :key="index"
                      :icon="item.icon"
                      :iconColor="item.iconColor"
                      :path="item.path"
                      :multiple="item.multiple">
          {{item.label}}
        </at-item-menu>
      </ul>
    </div>
  </div>
</template>

<script>
import { AtItemMenu, AtSidebar } from './drawer/index.js';
export default {
  name: 'drawer-adminator',
  components:{ AtItemMenu, AtSidebar },
  data(){
    return{
      myItems:[
        {label:'Inicio', icon: 'ti-home', iconColor: 'c-red-500', path:'/inicio', multiple: null},
        {label:'Ventas', icon: 'ti-bookmark-alt', iconColor: 'c-blue-500', path:'/ventas', multiple: null},
        {label:'Usuarios', icon: 'ti-user', iconColor: 'c-purple-500', path:'/usuarios', multiple: null},
        {label:'Provedores', icon: 'ti-id-badge', iconColor: 'c-green-900', path:'/proveedores', multiple: null},
        {label:'Configuraciones', icon: 'ti-settings', iconColor: 'c-red-500', path: null, 
          multiple:[
            {path:'/tipos/maquina', name:'Tipos de Maquina'},
            {path:'/estados/venta', name:'Estados de Venta'},
          ]
        },
      ]
    }
  },
  methods:{
    mouseleave(){
      if(!this.isCollapsed) this.drawer = false;
    },
    mouseover(){
      if(!this.isCollapsed) this.drawer = true;
    }
  },
  computed:{
    isCollapsed:{get(){ return this.$store.getters['main/getIsCollapsed']; } },
    drawer:{
      get(){ return this.$store.getters['main/getDrawerState']; },
      set(val){ this.$store.commit('main/setProperty', {key:'drawer', data: val})}
    }
  }
}
</script>
