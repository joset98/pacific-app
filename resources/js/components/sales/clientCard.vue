<template>
  <!-- Client Section -->
  <!-- pY-20 | mY-20 mL-20 mR-10 -->
  <div class="bg-white | h-100 w-100">
    <div class="d-flex flex-column align-items-center">
      <div>

      <h4 class="mL-10">
        Cliente
      </h4>
      </div>
      <div>
        {{currentClientData.name}}
      </div>
      <div>
        <!-- profile phto -->
        <img class="client_logo" :src="clientLogo">
      </div>
      <div>
       {{ currentClientData.rut}}
      </div>
    </div>      
    <!-- client content -->
    <div class="d-flex align-items-start flex-column | mT-10">
      <div class="pb-2">
        <div>Correo Electrónico</div>
        <div>{{currentClientData.contact}}</div>
      </div>
      <div class="pb-2">
        <div>Dirección</div>
        <div>{{currentClientData.address}}</div>
      </div>
      <div class="pb-2">
        <div>Razón Social</div>
        <div>{{currentClientData.business_name}}</div>
      </div>
    </div>

  </div>
  <!-- Client Section -->
</template>

<script>
export default {
  name: 'client-card',
  props:{
    client: {
      type: Object,
      default: function (){
        return {
          name: 'nombre',
          rut: '7355354-2',
          email: 'test@email.com',
          business_name: 'business test',
          address: 'address test',
        }
      }    
    },
    logo:{
      type: String,
      default: '/adminator/images/user.png'
    },
  },

  methods:{

    async getSells(){
      this.$loader.containe(this.$refs.sells);
        let request = await this.$store.dispatch('sells/getSells', this.mpSells.params('sells', this.page));
      this.$loader.hide();

      if(request.ok) this.sells = request.data;
    },

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
    clientLogo(){
      return this.logo;
    },
    currentClientData:{

      //Getters 
      get(){ return this.client; },
      getName(){ return this.client.name; },
      getRut(){ return this.client.rut; },
      getEmail(){ return this.client.email; },
      getAddress(){ return this.client.address; },
      //Setters 
      setName(val){ this.currentClient.name = this.client.name = val ; },
      setRut(val){  this.currentClient.rut = this.client.rut = val; },
      setEmail(val){  this.currentClient.email = this.client.email = val; },
      setAddress(val){ this.currentClient.address = this.client.address = val; },

    }

  },
}
</script>

<style media="screen">
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
