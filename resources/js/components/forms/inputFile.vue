<template>
  <div :class="['form-group w-100', classList]">
    <!-- Label -->
    <label v-if="label" class="text-normal text-dark">{{label}}</label>
    <!-- Input -->
    <input :id="inputId" @change="uploadData($event)" type="file" :class="['form-control', required, inputClass]">
    <!-- Validation -->
    <div v-if="required" class="invalid-feedback">{{(alert != true) ? alert : '¡Campo requerido!'}}</div>
    <!-- Text muted -->
    <small v-else-if="small_text" class="form-text text-muted">{{small_text}}</small>
  </div>
</template>

<script>
export default {
  name: 'adminator-input',
  methods:{
    uploadData(event) {
       let doc = event.target.files[0];
       if(doc){
         this.data = doc;
         // const reader = new FileReader();
         // reader.readAsDataURL(doc);
         // reader.onload = (e) => {
         //   this.previewPhoto = e.target.result;
         // };
       }
    },
  },
  computed:{
    data:{
      get(){ return this.value; },
      set(value){ this.$emit('input', value); }
    },
    required(){
      if(this.alert && (this.data == null || this.data == '')) return 'is-invalid';
      else return false;
    },
  },
  props:{
    value:{
      default: null
    },
    label:{
      type: String,
      default: null
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
    inputId:{
      type: String,
      default: null
    },
    inputClass:{
      type: String,
      default: ''
    },
  }
}
</script>
