<template>
  <div class="px-4 pt-2 mb-2">

    <h4 class="c-grey-900 mT-10 mb-3">Gestión de Proveedores</h4>

    <mc-providers :title="titleModal" :currentProvider="currentProvider" 
      v-model="showModal" @refresh="refreshData"
    />

    <div class="row">
      <div ref="providers" class="col-md-12">
        <at-general
          title="Lista de Proveedores"
          classHead="bg-dark"
          rounded="4px"
          striped
          :titles="providersTitles"
          :rows="providersRows"
          v-model="providers.items"
        >
          <template v-slot:head>
            <div class="d-flex justify-content-between mB-20">
                <h4 class="c-grey-900 mT-10">Lista de Proveedores</h4>
              <div class="peer mT-10">
                <a @click="openModal({})" class="btn btn-primary">
                  <span class="icon-holder">
                    <i class="ti-pencil"></i>
                  </span>
                  Nuevo Proveedor
                </a>
              </div>
            </div>
          </template>

           <template v-slot:actions="props">
            <!-- <div class="d-flex align-items-center justify-content-start"> -->
              <div class="p-0 btn-table">
                <button @click="openModal(props.item)" class="btn btn-outline-primary">
                  <span class="icon-holder">
                  <i class="ti-pencil"></i>
                  </span>
                  Editar
                </button>
              </div>

              <div class="p-0">
                <button class="btn btn-outline-danger mX-1 mY-1">
                  <span class="icon-holder">
                  <i class="ti-trash"></i>
                  </span>
                    Eliminar
                </button>
              </div>
            <!-- </div> -->

          </template>

          <template v-slot:footer>
            <paginator v-model="page" :paginator="providers"/>
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
import { mcProviders } from '../components/modals';

export default {
  name: 'providers',
  components:{ AtGeneral, paginator, mcProviders },
  data(){
    return{
      // providers: null,
      titleModal: 'Titulo Default',
      currentProvider: {},
      showModal: false,
      mpProviders: this.$mpage.index(10),
      page: 1,
      filter: null,
    }
  },
  methods:{

    async getProviders(){
      this.$loader.containe(this.$refs.providers);
      let request = await this.$store.dispatch('providers/getProviders',
                    this.mpProviders.params('providers', this.page));
      this.$loader.hide();

      if(request.ok && request.data.items && request.data.items.length > 0) this.providers = request.data;
    },

    async openModal(provider = null){
      //Titulo por defecto del modal 
      this.titleModal = 'Creacion de nuevo proveedor'; 
      if (provider && provider.id) this.titleModal = 'Editar proveedor'; 
      //Estableciendo proveedor seleccionado 
      this.currentProvider = provider; 
      //Habilitando el modal 
      this.showModal = true;
    },

    async refreshData(provider = false){
      this.$loader.dinamic();
        let request = await this.$store.dispatch('providers/getProviders', 
                                        this.mpProviders.resetParams('providers'));
      this.$loader.hide();

      if(request.ok && request.data.items && request.data.items.length > 0){
        if(provider) this.mpProviders.remove('providers', provider, 'id');
        this.providers = request.data;
      }
    }
  },
  computed:{
    providersTitles(){ return ['ID', 'Nombre', 'Descripción', ''] },
    providersRows(){
      return [
        {value: 'id',   classList: '', style: ''},
        {value: 'name',   classList: '', style: ''},
        {value: 'desc',      classList: '', style: ''},
        {value: 'actions',      classList: '', slot:true}
      ]
    },
    providers:{
      get(){
        let paginator = this.mpProviders.get('providers', this.page, null);
        if(paginator.items.length == 0) this.getProviders();

        return paginator;
      },
      set(value){ this.mpProviders.save('providers', value, 'id') }
    }
  },
}
</script>

<style media="screen">

  .btn-table{
    /* display: -webkit-box !important; */
      /* float:right; */
      height: auto;
    display:inline-block;
  }
  .caseTrue{
    color: green;
  }
  .caseFalse{
    color: red;
  }
</style>
