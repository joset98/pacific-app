<template>
  <div class="sidebar-logo">
    <div class="peers ai-c fxw-nw">
      <div class="peer peer-greed">
        <a class="sidebar-link td-n">
          <div class="peers ai-c fxw-nw">
            <div class="peer">
              <div class="logo">
                <img :src="logo" alt="">
              </div>
            </div>
            <div class="peer peer-greed">
              <h5 class="lh-1 mB-0 logo-text">Adminator</h5>
            </div>
          </div>
        </a>
      </div>
      <div class="peer">
        <div class="mobile-toggle sidebar-toggle">
          <a @click="closeDrawer" class="td-n">
            <i class="ti-arrow-circle-left"></i>
          </a>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: 'Sidebar',
  props:{
    logo:{
      type: String,
      default: 'adminator/images/logo.png' //pacific_logo
    },
  },
  methods:{
    closeDrawer(){
      this.isCollapsed = false;
      this.drawer = false;
    }
  },
  computed:{
    isCollapsed:{
      get(){ return this.$store.getters['main/getIsCollapsed']; },
      set(val){ this.$store.commit('main/setProperty', {key:'isCollapsed', data: val})}
    },
    drawer:{
      get(){ return this.$store.getters['main/getDrawerState']; },
      set(val){ this.$store.commit('main/setProperty', {key:'drawer', data: val})}
    }
  }
}
</script>
