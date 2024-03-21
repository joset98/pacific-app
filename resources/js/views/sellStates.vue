<template>
  <div class="px-4 pt-2 mb-2">
    <!-- <template v-slot:head> -->
    <h4 class="c-grey-900 mT-10 mb-3">Configuraciones > Estados de Venta</h4>
    <!-- </template> -->

    <mc-sell-state :title="titleModal" :currentSellState="currentSellState" v-model="showModal" @refresh="refreshData" />

    <div class="row">
      <div ref="sellStates" class="col-md-12">
        <at-general
          title="Listado de Estados de Venta"
          classHead="bg-dark"
          rounded="4px"
          striped
          :titles="sellStatesTitles"
          :rows="sellStatesRows"
          v-model="sellStates.items"
        >
        <!-- Head -->
          <template v-slot:head>
            <div class="d-flex justify-content-between mB-20">
              <h4 class="c-grey-900 mT-10">Listado de Estados de Venta</h4>
              <div class="peer mT-10">
                <a @click="openModal({})" class="btn btn-primary">
                  <span class="icon-holder">
                    <i class="ti-pencil"></i>
                  </span>
                  Nuevo Estado
                </a>
              </div>
            </div>
          </template>
        <!-- Head -->

          <template v-slot:actions="props">
            <div class="p-0 text-center">
              <button @click="openModal(props.item)" class="btn btn-outline-primary">
                <span class="icon-holder">
                  <i class="ti-pencil"></i>
                </span>
                Editar
              </button>
            </div>
          </template>

          <template v-slot:footer>
            <paginator v-model="page" :paginator="sellStates"/>
          </template>
        </at-general>

        <a @click="page = 3" href="#">3</a>
      </div>
    </div>
  </div>
</template>

<script>
import { AtGeneral } from '../components/tables';
import paginator from '../components/paginator/paginator.vue';
import { mcSellState } from '../components/modals';

export default {
  name: 'sellStates',
  components:{ AtGeneral, paginator, mcSellState },
  data(){
    return{
      // sellStates: null,
      titleModal: 'Titulo Default',
      currentSellState: {},
      showModal: false,
      mpSellStates: this.$mpage.index(10),
      page: 1,
      filter: null,
    }
  },
  methods:{

    async getSellStates(){
      this.$loader.containe(this.$refs.sellStates);
      let request = await this.$store.dispatch('sellStates/getSellStates',
                    this.mpSellStates.params('SellStates', this.page));
      this.$loader.hide();

      if(request.ok && request.data.items && request.data.items.length > 0) this.sellStates = request.data;
      
    },

    async openModal(sellState = null){
      //Titulo por defecto del modal 
      this.titleModal = 'Creacion de estado de Venta'; 
      if (sellState && sellState.id) this.titleModal = 'Editar estado de venta'; 
      //Estableciendo proveedor seleccionado 
      this.currentSellState = sellState; 
      //Habilitando el modal 
      this.showModal = true;
    },

    async refreshData(sellState = false){
      this.$loader.dinamic();
        let request = await this.$store.dispatch('sellStates/getSellStates', 
                      this.mpSellStates.resetParams('sell_states'));
      this.$loader.hide();

      if(request.ok && request.data.items && request.data.items.length > 0){
        if(sellState) this.mpSellStates.remove('sell_states', sellState, 'id');
        
        this.sellStates = request.data;
      }
    }
  },
  computed:{
    sellStatesTitles(){ return ['ID', 'Nombre', 'Descripcion',''] },
    sellStatesRows(){
      return [
        {value: 'id',   classList: '', style: ''},
        {value: 'name',   classList: '', style: ''},
        {value: 'desc',      classList: '', style: ''},
        {value: 'actions',      classList: '', slot:true}

        /*, typeBoolean:[{classList:'caseTrue', label: 'Activo'}, {classList:'caseFalse', label: 'Desactivo'}]*/ 
      ]
    },
    sellStates:{
      get(){
        let paginator = this.mpSellStates.get('SellStates', this.page, null);
        if(paginator.items.length == 0) this.getSellStates();

        return paginator;
      },
      set(value){ this.mpSellStates.save('sellStates', value, 'id') }
    }
  },
}
</script>

<style media="screen">
  .caseTrue{
    color: green;
  }
  .caseFalse{
    color: red;
  }
</style>
