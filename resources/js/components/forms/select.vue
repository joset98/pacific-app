<template>
  <div :class="['form-group', classList]">
    <!-- Label -->
    <label v-if="label" :class="['text-normal', classLabel]">{{label}}</label>

    <!-- select -->
    <select id="inputState" v-model="data" :class="['form-control', required]">
      <option v-for="(option, index) in options" :key="index" :value="option[values]">{{option[labels]}}</option>
    </select>

    <!-- Validation -->
    <div v-if="required && (data == null || data == '')" class="invalid-feedback">{{(alert != true) ? alert : '¡Campo requerido!'}}</div>
    <!-- Text muted -->
    <small v-else-if="small_text" class="form-text text-muted">{{small_text}}</small>
  </div>
</template>

<script>
export default {
  name: 'adminator-select',
  props:{
    value:{
      default: null
    },
    label:{
      type: String,
      default: null
    },
    labels:{
      type: String,
      default: 'label'
    },
    values:{
      type: String,
      default: 'value'
    },
    small_text:{
      type: String,
      default: null
    },
    alert:{
      type: [String, Boolean],
      default: null
    },
    options:{
      type: Array,
      default: []
    },
    classList:{
      type: String,
      default: null
    },
    classLabel:{
      type: String,
      default: null
    },
  },
  computed:{
    data:{
      get(){ return this.value; },
      set(value){ this.$emit('input', value); }
    },
    required(){
      if(this.alert && (this.data == null || this.data == '')) return 'is-invalid';
      return false;
    }
  },
}
</script>
