<template>
  <div class="px-4 pt-2 mb-2">
    <h4 class="c-grey-900 mT-10 mb-3">Configuraciones > Tipos de Máquinas</h4>

    <mc-machines :title="titleModal" :currentMachine="currentMachine" 
      v-model="showModal" @refresh="refreshData"
    />

    <div class="row">
      <div ref="machines" class="col-md-12">
        <at-general
          title="Lista de Máquinas"
          classHead="bg-dark"
          rounded="4px"
          striped
          :titles="machinesTitles"
          :rows="machinesRows"
          v-model="machines.items"
        >
        <!-- Head -->
          <template v-slot:head>
            <div class="d-flex justify-content-between mB-20">
              <h4 class="c-grey-900 mT-10">Lista de Máquinas</h4>
              <div class="peer mT-10">
                <a @click="openModal({})" class="btn btn-primary">
                  <span class="icon-holder">
                    <i class="ti-pencil"></i>
                  </span>
                  Nueva Máquinas
                </a>
              </div>
            </div>
          </template>
        <!-- Head -->
        <!-- actions -->
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
        <!-- actions -->
          <template v-slot:footer>
            <paginator v-model="page" :paginator="machines"/>
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
import { mcMachines } from '../components/modals';
export default {
  name: 'machines',
  components:{ AtGeneral, paginator, mcMachines },
  data(){
    return{
      // machines: null,
      titleModal: 'Titulo Default',
      showModal: false,
      currentMachine: {},
      mpMachines: this.$mpage.index(5),
      page: 1,
      filter: null,
    }
  },
  methods:{
    async getMachines(){
      this.$loader.containe(this.$refs.machines);
      let request = await this.$store.dispatch('machines/getMachines',
                    this.mpMachines.params('machines', this.page));
      this.$loader.hide();

      if(request.ok && request.data.items && request.data.items.length > 0) this.machines = request.data;
    },

    async openModal(machine = null){
      //Titulo por defecto del modal 
      this.titleModal = 'Creacion de nuevo tipo de máquina'; 
      if (machine && machine.id) this.titleModal = 'Editar tipo de máquina'; 
      //Estableciendo maquina seleccionado 
      this.currentMachine = machine; 
      //Habilitando el modal 
      this.showModal = true;
    },

    async refreshData(machine = false){
      this.$loader.dinamic();
        let request = await this.$store.dispatch('machines/getMachines', 
                                        this.mpMachines.resetParams('machines'));
      this.$loader.hide();

      if(request.ok && request.data.items && request.data.items.length > 0){
        if(machine) this.mpMachines.remove('machines', machine, 'id');
        this.machines = request.data;
      }
    }
  },
  computed:{
    machinesTitles(){ return ['ID', 'Nombre', 'Descripción',''] },
    machinesRows(){
      return [
        {value: 'id',   classList: '', style: ''},
        {value: 'name',   classList: '', style: ''},
        {value: 'desc',      classList: '', style: ''},
        {value: 'actions',      classList: '', slot: true}
      ]
    },
    machines:{
      get(){
        let paginator = this.mpMachines.get('machines', this.page, null);
        if(paginator.items.length == 0) this.getMachines();

        return paginator;
      },
      set(value){ this.mpMachines.save('machines', value, 'id') }
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
