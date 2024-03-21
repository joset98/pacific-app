<template>
  <div class="peers ai-s fxw-nw h-100vh">
    <div class=" peer-greed h-100 pos-r bgr-n bgpX-c bgpY-c bgsz-cv d-flex justify-content-center align-items-center" :style="bgLogin">

      <div class="adminatorLoginMovilBgRgba bgc-white scrollable pos-r">
        <div class="text-center">
          <img class="login_logo" :src="imgLogo">
        </div>

        <h4 class="c-grey-900 text-center">{{title}}</h4>
        <!-- Inputs -->
        <slot name="inputs" />
        <!-- Inputs -->

        <!-- Actions -->
        <div class="form-group">
          <div class="peers ai-c jc-sb fxw-nw flex-wrap">
            <slot name="actions" />
          </div>
        </div>
        <!-- Actions -->

        <div class="AuthbdT text-center mt-3">
          <slot name="footer" />
        </div>
      </div>


    </div>
  </div>
</template>

<script>
export default {
  name: 'auth-adminator',
  props:{
    src:{
      type: String,
      default: 'adminator/images/bg.jpg'
    },
    logo:{
      type: String,
      default: 'adminator/images/pacific_logo.jpg'
    },
    title:{
      type: String,
      default: 'Titulo de pagina'
    },
  },
  computed:{
    bgLogin(){
      return{
        backgroundImage: 'url("' + this.src + '")',
      }
    },
    imgLogo(){
      console.log(this.logo)
      return this.logo;
    },
    bgRightLogin(){
      return{
        backgroundImage: 'url("' + this.src + '")',
        minWidth: '320px'
      }
    },
  },
}
</script>

<style media="screen">
.loginlogo{
  width: 100%;
  max-width: 500px;
  padding: 20px 25px;

}
.adminatorLoginMovilBgRgba{
  width: 100%;
  max-width: 400px;
  padding: 20px 25px;
}
.login_logo{
  width: 100%;
  max-width: 300px;
}
</style>
