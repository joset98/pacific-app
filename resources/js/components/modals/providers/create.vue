<template>
  <modal-slot layout_fixed v-model="modal">
    <div slot="header">
      {{title}}
      <!-- Creacion de nuevo proveedor -->
    </div>

    <!-- Body -->
    <div class="d-flex flex-column">
      <!-- Inputs -->

      <div class="d-flex flex-column">
        <label class="text-normal text-dark">Nombre</label>
        <input v-model="currentProvider.name" type="text">
      </div>
      <div class="d-flex flex-column mT-20">
        <div class="d-flex justify-content-between pT-5">
          <label  class="text-normal text-dark">Descripción</label>
          <p>cantidad máxima de 250 caracteres</p>
        </div>
        <textarea v-model="currentProvider.desc" class="form-control" aria-label="With textarea"></textarea>
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
  name: 'create-providers',
  props:{
    value:{
      type: Boolean,
      default: null
    },
    currentProvider:{
      type: [Object, Array],
      default:  function () {
        return { 
          name: null,
          desc: null
       }
      }
    },
    title:{
      type: [String],
      default: null
    }
  },
  data(){
    return{
      provider: {
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
    },
    dataProvider:{
      get(){ return this.provider; },
      set(value){ this.$emit('input', value)}
    }
  },
  methods:{
    async create(){
      //# Validando mis datos
        if(this.$allErrors.verifyFields(this.currentProvider)) return this.verifyFields = true;
      //# Creando mi formData

        let data = this.$toFormData.transform(this.currentProvider);
        let url = this.currentProvider.id ? 'providers/update' : 
                                            'providers/create';
        
        console.log(this.currentProvider)
      //# Enviando peticion
      this.$loader.full();
        let request = await this.$store.dispatch(url, data);
      this.$loader.hide();
      //# Validando la respuesta
        if(!request.ok) return this.$allErrors.getError(request.data);
      console.log(request);
      this.$emit('refresh')
      this.modal = false;
    }
  },
}
</script>
