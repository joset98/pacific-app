<template>
  <div class="px-4 pt-2 mb-2">
    <h4 class="c-grey-900 mT-10 mb-3">Gestion de Ventas</h4>
    
    <div class="row">
      <div ref="sales" class="col-md-12">
        <at-general
          title="Lista de usuarios"
          classHead="bg-dark"
          rounded="4px"
          striped
          :titles="salesTitles"
          :rows="salesRows"
          v-model="sales.items"
        >
        <!-- head -->
          <template v-slot:head>
            <div class="d-flex justify-content-between mB-20">
              <h4 class="c-grey-900 mT-10">Lista de ventas</h4>
              <div class="peer mT-10">
                <a href="/ventas/registro" class="btn btn-primary">
                  <span class="icon-holder">
                    <i class="ti-plus"></i>
                  </span>
                  Nueva Venta
                </a>
              </div>
            </div>
          </template>
        <!-- head -->
        <!-- Action -->
          <template v-slot:actions="props">
            <!-- <div class="d-flex align-items-center justify-content-start"> -->
              <div class="p-0 btn-table">
                <a :href="'/ventas/'+ props.item.id +'/detalles'" class="btn btn-outline-primary">
                  <span class="icon-holder">
                    <i class="ti-eye"></i>
                  </span>
                  Detalle
                </a>
              </div>

              <div class="p-0">
                <a :href="'/ventas/'+ props.item.id +'/editar'" class="btn btn-outline-primary mX-1 mY-1">
                  <span class="icon-holder">
                  <i class="ti-pencil"></i>
                  </span>
                    Editar
                </a>
              </div>
            <!-- </div> -->

          </template>
        <!-- Action -->
        
          <template v-slot:footer :position="start">
            <!-- <div class="d-flex justify-content-start"> -->
              <paginator v-model="page" :paginator="sales" position="end"/>
            <!-- </div> -->
          </template>
        </at-general>

      </div>
    </div>
  </div>
</template>

<script>
import { AtGeneral } from '../components/tables';
import paginator from '../components/paginator/paginator.vue';

export default {
  name: 'sales',
  components:{ AtGeneral, paginator },
  data(){
    return{
      titleModal: 'Titulo Default',
      currentSale: {},
      showModal: false,
      showDeleteModal: false,
      mpSales: this.$mpage.index(10),
      page: 1,
      filter: null,
    }
  },
  methods:{

    async getSales(){
      this.$loader.containe(this.$refs.sales);
        let request = await this.$store.dispatch('sales/getSales', this.mpSales.params('sales', this.page));
      this.$loader.hide();

      if(request.ok && request.data.items && request.data.items.length > 0) this.sales = request.data;
    },

    async refreshData(sale = false){
      this.$loader.dinamic();
        let request = await this.$store.dispatch('sales/getSales', this.mpSales.resetParams('sales'));
      this.$loader.hide();

      if(request.ok && request.data.items && request.data.items.length > 0){
        if(sale) this.mpSales.remove('sales', sale, 'id');
        this.sales = request.data;
      }
    }
  },
  computed:{
    salesTitles(){ return ['ID', 'Cliente', 'Rut', 'Maquina', 'Nº Order','Estado', ''] },
    salesRows(){
      return [
        {value: 'id',           classList: '', style: ''},
        {value: 'client_name',  classList: '', style: ''},
        {value: 'rut',          classList: '', style: ''},
        {value: 'machine_name', classList: '', style: ''},
        {value: 'num_order',    classList: '', style: ''},
        {value: 'sale_state',   classList: '', style: ''},
        {value: 'actions',      classList: '', slot: true}
      ]
    },
    sales:{
      get(){
        let paginator = this.mpSales.get('sales', this.page, null);
        if(paginator.items.length == 0) this.getSales();

        return paginator;
      },
      set(value){ this.mpSales.save('sales', value, 'id') }
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
