<template>
  <modal-slot layout_fixed v-model="modal">
    <div slot="header">
      {{title}}
    </div>

    <!-- Body -->
    <div class="d-flex flex-column">
      <!-- Inputs -->
      <div class="d-flex flex-column">
        <label class="text-normal text-dark">Nombre</label>
        <input v-model="currentSellState.name" type="text">
      </div>
      <div class="d-flex flex-column mT-20">
        <div class="d-flex justify-content-between pT-5">
          <label  class="text-normal text-dark">Descripción</label>
          <p>cantidad máxima de 250 caracteres</p>
        </div>
        <textarea v-model="currentSellState.desc" class="form-control" aria-label="With textarea"></textarea>
      </div>
      <!-- Inputs -->
    </div>
    <!-- Body -->
    
    <div slot="footer">
      <button @click="modal = false" class="btn btn-secondary">
          Cancelar
      </button>
      <button @click="create" class="btn btn-primary">
          <i class="ti-save"></i>
          Guardar
      </button>
   </div>
   </modal-slot>
</template>
<script>

export default {
  name: 'create-sell-state',
  props:{
    value:{
      type: Boolean,
      default: null
    },
    currentSellState:{
      type: [Object, Array],
      default: null
    },
    title:{
      type: String,
      default: null
    }
  },
  data(){
    return{
      sellStateData: {
        name: null,
        desc: null,
      },
      verifyFields: false
    }
  },
  computed:{
    modal:{
      get(){ return this.value; },
      set(val){ this.$emit('input', val)}
    }
  },
  methods:{
    async create(){
      //# Validando mis datos
        if(this.$allErrors.verifyFields(this.currentSellState)) return this.verifyFields = true;
      //# Creando mi formData

        let data = this.$toFormData.transform(this.currentSellState)
        let url = this.currentSellState.id ? 'sellStates/update' : 
                                            'sellStates/create';

      //# Enviando peticion
      this.$loader.full();
        let request = await this.$store.dispatch(url, data);
      this.$loader.hide();
      //# Validando la respuesta
        if(!request.ok) return this.$allErrors.getError(request.data);
      this.$emit('refresh')
      console.log(request);
      this.modal = false;
    }
  },
}
</script>
