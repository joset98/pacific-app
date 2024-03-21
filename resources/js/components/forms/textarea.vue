<template>
  <div :class="['form-group', classList]">
    <!-- Label -->
    <label v-if="label" :class="['text-normal', classLabel]">{{label}}</label>
    <!-- Input -->
    <textarea :id="inputId" @keypress.enter="$emit('enter')" v-model="data" :class="['form-control', required, inputClass]" :placeholder="placeholder">
    </textarea>

    <!-- Validation -->
    <div v-if="required" class="invalid-feedback">{{(alert != true) ? alert : '¡Campo requerido!'}}</div>
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
  },
}
</script>
