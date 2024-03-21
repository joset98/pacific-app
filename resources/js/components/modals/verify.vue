<template>
  <modal-verify :jsonData="jsonData" v-model="modal" @acepted="runVerify">
     Hello word
   </modal-verify>
</template>

<script>
export default {
  name: 'verify',
  props:{
    value:{
      type: Boolean,
      default: null
    },
    jsonData:{
      default: null
    }
  },
  methods:{
    runVerify(){
      console.log("Run function...");
    }
  },
  computed:{
    modal:{
      get(){ return this.value; },
      set(val){ this.$emit('input', val)}
    }
  }
}
</script>
