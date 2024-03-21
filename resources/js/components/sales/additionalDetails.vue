<template>
    <!-- Additional details -->
    <div class="d-flex flex-column bg-white">
        <div class="d-flex justify-content-start align-items-start mY-10 mX-10 ">
          <span class="icon-holder | c-grey-100 bgAddField squareBgUpdate | d-flex justify-content-center align-items-center">
              <i class="ti-align-left"></i>
              </span>
          <h4 class="mL-10">
              Detalles adicionales
          </h4>
        </div>

        <div class="d-flex flex-column">
          <div class="d-flex flex-wrap">
              <at-textarea label="Elementos Adicionales" v-model="elements" class="col-6" :alert="false"/>
              <at-textarea label="Detalles de Máquina" v-model="machine" class="col-6" :alert="false"/>
              <at-textarea label="Observaciones" v-model="observationDetails" class="col-12" :alert="false"/>
          </div>
        </div>

    </div>
    <!-- Additional details -->
</template>

<script>
import { AtTextarea } from '../forms';

export default {
  name: 'sales-form',
  components:{ AtTextarea },

  props:{
    addElements:{
      type: String,
      default: null,
    },
    machineDetails:{
      type: String,
      default: null,
    },
    observations:{
      type: String,
      default: null,
    },
  },
  data(){
    return{
      currentSale: {
          name: '',
          email: 'test@email.com',
          business_name: '',
          address: '',
      },
    }
  },
  computed:{

    elements:{
      get(){ return this.addElements; },
      set(val){ 
        this.$emit('elementInput', val)
        // this.detailData.add_elements = val ;
      },

    },
    machine:{
      get(){ return this.machineDetails; },
      set(val){ 
        this.$emit('machineInput', val)
        // this.detailData.add_elements = val ;
      },
    },

    observationDetails:{
      get(){ return this.observations; },
       set(val){ 
        this.$emit('obsInput', val)
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
  .bgAddField{
    background-color: rgb(53, 187, 142);
  }
 
  .bgBtnColor{
    background-color: orange; 
  }
  .caseTrue{
    color: green;
  }
  .caseFalse{
    color: red;
  }
</style>
