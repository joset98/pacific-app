<template>
    <!-- Document Form Data -->
    <div class="bg-white h-100 | py-2 px-2">
    <div class="d-flex justify-content-start align-items-start mY-10">
        <span class="icon-holder | c-grey-100 bg-primary | squareBgUpdate | d-flex justify-content-center align-items-center">
            <i class="ti-file"></i>
        </span>
        <h4 class="mL-10">
        Documento
        </h4>
    </div>
    <div class="d-flex flex-column align-items-center mY-20">
        <at-input-file v-model="fileElem" :small_text="'Seleccione un archivo'"/>
        <button class="btn btn-primary mX-10">
          Subir un Documento
        </button>
    </div>

    </div>
    <!-- Document Form Data -->
</template>

<script>
import { AtInputFile } from '../forms';

export default {
  name: 'sales-form',
  components:{ AtInputFile },
  props:{
    file: {
      type: [Object, String, File],
      default: null,
    },
  },

  methods:{

  },
  computed:{
      fileElem:{
        get(){ return this.file; },
        set(val){ 
          this.$emit('fileInput', val)
          // this.detailData.add_elements = val ;
        },
    },


  },
}
</script>

<style media="screen">
  .squareBgUpdate{
    width: 2.5em;
    height: 2.5em;
  }
  .caseTrue{
    color: green;
  }
  .caseFalse{
    color: red;
  }
</style>
