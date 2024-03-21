<template>
  <!-- @App Content -->
  <!-- =================================================== -->
  <div :class="[(drawer && isCollapsed) ? 'is-collapsed' : '']">
    <!-- #Drawer ==================== -->
    <at-drawer />

    <!-- #Main ============================ -->
    <div class="page-container">
      <!-- ### $Topbar ### -->
      <at-navbar />

      <!-- ### $Content ### -->
      <at-main>
        <router-view></router-view>
      </at-main>

      <!-- ### $Footer ### -->
      <at-footer>
        Copyright © 2020 Designed by <a href="https://nextscale.net" target='_blank' title="Nextscale">Nextscale</a>. All rights reserved.
      </at-footer>
    </div>
  </div>
</template>

<script>
// Template adminator
import { AtNavbar, AtDrawer, AtMain, AtFooter } from '../components/layout';

export default {
  name: 'myApp',
  components:{ AtNavbar, AtDrawer, AtMain, AtFooter },
  computed:{
    isCollapsed:{get(){ return this.$store.getters['main/getIsCollapsed']; } },
    drawer:{
      get(){ return this.$store.getters['main/getDrawerState']; },
      set(val){ this.$store.commit('main/setProperty', {key:'drawer', data: val})}
    },
  }
}
</script>
