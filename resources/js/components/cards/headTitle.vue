<template>
  <div class="d-flex align-items-center">
    <div style="margin-bottom: 2px;" :class="['headTitle', (subTitle == null) ? 'text-dark' : 'text-primary']">{{title}}</div>

    <div v-if="subTitle != null" class="headSubTitle text-dark mb-0 ml-1 text-bold">
       {{separation}} {{subTitle}}
    </div>
  </div>
</template>

<script>
export default {
  name: 'headTitle',
  props:{
    title:{
      type: String,
      default: 'Titulo'
    },
    subTitle:{
      type: String,
      default: null
    },
    separation:{
      type: String,
      default: '>'
    },
  },
}
</script>

<style scoped>
.headTitle{
  font-size: 22px !important;
}
.headSubTitle{
  font-size: 17px !important;
}
  @media(max-width: 767px){
    .headTitle{
      font-size: 20px !important;
    }
    .headSubTitle{
      margin-top: 1px;
      font-size: 16px !important;
    }
  }
</style>
