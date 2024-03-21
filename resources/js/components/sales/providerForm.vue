<template>
    <!-- Provider Form Data -->
    <div class="bg-white h-100 | py-2 px-2">
    <div class="d-flex justify-content-start align-items-start mY-10">
        <span class="icon-holder | c-grey-100 bg-primary squareBgUpdate | d-flex justify-content-center align-items-center">
            <i class="ti-truck"></i>
        </span>
        <h4 class="mL-10">
        Proveedor
        </h4>
    </div>
    <div>
        <at-select :label="'Proveedor'" v-model="currentSelectOption" :values="'id'" :labels="'name'"  
          :options="providerList" :classLabel="'blueFont'"
        />
    </div>
    </div>
    <!-- Provider Form Data -->
</template>

<script>
import { AtInput, AtSelect } from '../forms';

export default {
  name: 'provider-form',
  components:{ AtInput, AtSelect },

  props:{
    providers:{
      type: Array,
      default: []
    },
    selectOption:{
      type: Number,
      default: null,
    },
  },

  methods:{

    async openModal(sell = null){
      //Titulo por defecto del modal 
      this.titleModal =  (sell && sell.id) ? 'Editar usuario':'Creacion de nuevo usuario'
      //Estableciendo Venta seleccionado 
      this.currentSell = sell; 
      //Habilitando el modal 
      this.showModal = true;
    },

    async refreshData(sell = false){
      this.$loader.dinamic();
        let request = await this.$store.dispatch('sells/getSells', this.mpSells.resetParams('sells'));
      this.$loader.hide();

      if(request.ok && request.data.items && request.data.items.length > 0){
        if(sell) this.mpSells.remove('sells', sell, 'id');
        this.sells = request.data;
      }
    }
  },
  computed:{
    currentSelectOption:{
      //Getters 
      get(){ return this.selectOption; },
      //Setters 
      set(val){ 
        this.$emit('providerInput',val);
      },
    },

    providerList:{
      get(){ return this.providers; },
      set(val){  this.providers = val; },
    }

  },
}
</script>

<style media="screen">
  .blueFont{
    color: rgb(23, 150, 223);
  }
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
