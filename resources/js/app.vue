<template>
  <div>
    <router-view></router-view>
    
    <notifications group="foo" position="bottom right"/>
    <!-- Dynamic load -->
    <div class="loaderDinamic">
      <div id="loaderDinamic" class="loaderDinamic_children"></div>
    </div>
    <!-- Dynamic load -->
  </div>
</template>

<script>
export default {
  name: 'app',
}
</script>
