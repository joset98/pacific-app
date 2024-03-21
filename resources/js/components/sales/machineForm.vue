<template>
    <!-- Machine Form Data -->
    <div class="bg-white h-100 | py-2 px-2">
        <div class="d-flex justify-content-start align-items-start mY-10">
            <span class="icon-holder | c-grey-100 bg-primary squareBgUpdate | d-flex justify-content-center align-items-center">
                <i class="ti-settings"></i>
            </span>
            <h4 class="mL-10">
            Máquina
            </h4>
        </div>      
        
        <div>
            <at-select :label="'Tipo de máquina'" v-model="selectOption" :values="'id'" 
            :labels="'name'" :options="machineList" :classLabel="'blueFont'"/>
            <at-input type="text" v-model="currentModel" label="Modelo de maquina" :alert="false" 
              :classLabel="'blueFont'"
            />

        </div>
    </div>
    <!-- Machine Form Data -->
</template>

<script>
import { AtInput, AtSelect } from '../forms';

export default {
  name: 'machine-form',
  components:{ AtInput, AtSelect,  },

  props:{
    machines:{
      type: Array,
      default:[],
    },
    model:{
      type: String,
      default: null,
    },
    machine:{
      type: Number,
      default: null,
    },
  },
  data(){
    return{
    }
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

    selectOption:{
      get(){ return this.machine; },
      set(val){ 
        this.$emit('machineInput',val);
      },
    },

    currentModel:{
      get(){ return this.model; },
      set(val){ 
        this.$emit('modelInput',val);
      },
    },

    machineList:{
      get(){ return this.machines; },
      set(val){  this.machines = val; },

    },

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
