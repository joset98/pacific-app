<template>
  <footer class="bdT ta-c p-20 fsz-sm c-grey-600">
    <slot/>
  </footer>
</template>

<script>
export default {
  name: 'footer-adminator',
}
</script>

<style media="screen">
  footer{
    z-index: 3;
    position: fixed;
    width: 100%;
    background: #fff;
  }
</style>
