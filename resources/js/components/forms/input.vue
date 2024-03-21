<template>
  <div :class="['form-group', classList]">
    <!-- Label -->
    <label v-if="label" :class="['text-normal', classLabel]">{{label}}</label>
    <!-- Input -->
    <input :disabled="disabled" v-if="mask != false" v-mask="mask" :id="inputId" @keypress.enter="$emit('enter')" :type="type" v-model="data" :class="['form-control', required, validateEmail, inputClass]" :placeholder="placeholder">
    <input :disabled="disabled" v-else :id="inputId" @keypress.enter="$emit('enter')" :type="type" v-model="data" :class="['form-control', required, validateEmail, inputClass]" :placeholder="placeholder">
    <!-- Validation -->
    <div v-if="(type == 'email' && validateEmail) || required" class="invalid-feedback">{{(regexEmail) ? regexEmail : (alert != true) ? alert : '¡Campo requerido!'}}</div>
    <!-- Text muted -->
    <small v-else-if="small_text" class="form-text text-muted">{{small_text}}</small>
  </div>
</template>

<script>
export default {
  name: 'adminator-input',
  data(){
    return{
      regexEmail: false
    }
  },
  props:{
    value:{
      default: null
    },
    type:{
      type: String,
      default: "text"
    },
    label:{
      type: String,
      default: null
    },
    placeholder:{
      type: String,
      default: ""
    },
    small_text:{
      type: String,
      default: null
    },
    alert:{
      type: [String, Boolean],
      default: null
    },
    classList:{
      type: String,
      default: null
    },
    classLabel:{
      type: String,
      default: null
    },
    inputId:{
      type: String,
      default: null
    },
    mask:{
      type: [String, Boolean],
      default: false
    },
    inputClass:{
      type: String,
      default: ''
    },
    disabled:{
      type: Boolean,
      default: false
    }
  },
  computed:{
    fieldEmail: {
      get(){ return this.$store.getters['main/getFieldEmail']; },
      set(value){ return this.$store.commit('main/setProperty', {key: 'fieldEmail', data: value}); }
    },
    data:{
      get(){ return this.value; },
      set(value){ this.$emit('input', value); }
    },
    required(){
      if(this.alert && (this.data == null || this.data == '')) return 'is-invalid';
      else return false;
    },
    validateEmail() {
      if(this.type == 'email' && this.alert){
        const regex = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        if(!regex.test(String(this.data).toLowerCase())){
          this.regexEmail = 'Correo invalido';
          this.fieldEmail = false;
          return 'is-invalid';
        }else{
          this.regexEmail = false;
          this.fieldEmail = true;
          return false;
        }
      }
    }
  },
}
</script>
