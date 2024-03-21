<template>
  <li :class="['nav-item', {'dropdown': multiple, 'open': actionable}]">
    <a @click="goToItem(path)" :class="[(multiple) ? 'dropdown-toggle' : 'sidebar-link']">
      <span v-if="icon" class="icon-holder">
        <i :class="[(iconColor) ? iconColor : 'c-light-blue-500', icon]"></i>
      </span>
      <span class="title"><slot/></span>

      <span v-if="multiple" class="arrow">
        <i class="ti-angle-right"></i>
      </span>
    </a>
    <ul v-if="multiple && actionable && drawer" class="dropdown-menu" style="display: block;">
      <li v-for="(item, index) in multiple" :key="index">
        <a class='sidebar-link' @click="goToItem(item.path)">{{item.name}}</a>
      </li>
    </ul>
  </li>
</template>

<script>
export default {
  name: 'ItemMenu',
  data(){
    return{
      actionable: false
    }
  },
  props:{
    icon:{
      type: String,
      default: null
    },
    iconColor:{
      type: String,
      default: null
    },
    multiple:{
      type: [Object, Array],
      default: null
    },
    path:{
      type: String,
      default: null
    }
  },
  methods:{
    goToItem(path){
      let sidebar = document.getElementById('main-drawer');
      if(path){
        if(this.$route.fullPath != path){
          if(sidebar.clientWidth <= 250){
            this.drawer = false;
            this.isCollapsed = false;
          }
          return this.$router.push(path);
        }
      }else{
        this.actionable = !this.actionable;
      }
    }
  },
  computed:{
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
