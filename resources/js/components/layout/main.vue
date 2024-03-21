<template>
  <main class='main-content'>
    <div id='mainContent'>
      <div class="full-container bgc-grey-200">
        <div class="full-container-x">
          <slot />
        </div>
      </div>
    </div>
  </main>
</template>

<script>
export default {
  name: 'main-adminator',
}
</script>

<style media="screen">
  .full-container{
    padding-bottom: 61px;
  }
  .full-container-x{
    padding-left: 25px;
    padding-right: 25px;
  }
  @media (max-width: 991px){
    .full-container-x{
      padding-left: 0px;
      padding-right: 0px;
    }
  }
</style>
