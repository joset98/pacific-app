<template>
  <modal-slot layout_fixed v-model="modal">
    <div slot="header">
      {{title}}
    </div>
    <!-- Body -->
    <div>
      <!-- Inputs -->
        <!-- <slot name="inputs" /> -->
        <div class="d-flex flex-column">
          <div class="d-flex flex-row">
            <atInput v-model="currentUser.name" type="text" label="Nombre" :classLabel="'text-dark'"
              :alert="verifyFields" class="col-6"
            />
            <atInput v-model="currentUser.last_name" type="text" label="Apellido" :classLabel="'text-dark'"
              :alert="verifyFields" class="col-6" 
            />
          </div>
          <div class="d-flex flex-row">
            <atInput v-model="currentUser.rut" type="text" label="RUT" :classLabel="'text-dark'"
              :alert="verifyFields" class="col-6"
            />
            <atInput v-model="currentUser.email" type="email" label="Correo Electrónico" :classLabel="'text-dark'"
              :alert="verifyFields" class="col-6"
            />
          </div>
          <div class="d-flex flex-row ">
            <atInput v-model="currentUser.password" type="password" label="Contraseña" :classLabel="'text-dark'"
              :alert="verifyFields" class="col-6"
            />
          </div>
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
import {AtInput} from '../../forms';

export default {
  name: 'create-users',
  components:{ AtInput },
  props:{
    value:{
      type: Boolean,
      default: null
    },
    currentUser:{
      type: [Object, Array],
      default: {
        name: null,
        last_name: null,
        rut: null,
        email: null,
        password: null,
      },
    },
    title:{
      type: [String],
      default: null
    }
  },
  data(){
    return{
      user: {
        name: null,
        last_name: null,
        rut: null,
        email: null,
        password: null,
      },
      verifyFields: false
    }
  },
  computed:{
    modal:{
      get(){ return this.value; },
      set(val){ this.$emit('input', val)}
    },
    currentUserData:{

      //Getters 
      get(){ return this.currentUser; },
    //Setters 
      set(val){ this.user = this.currentUser = val ; },

    }

  },
  methods:{
    async create(){
      const { name, last_name, password, rut, email} = this.currentUser;
      console.log(this.currentUser)
      //# Validando mis datos
      if(this.$allErrors.verifyFields({ name, last_name, password, rut, email})) return this.verifyFields = true;
      //# Creando mi formData
      let data = this.$toFormData.transform(this.currentUser)
      let url = this.currentUser.id ? 'users/update' : 
                                        'users/create';

      //# Enviando peticion
      this.$loader.full();
        let request = await this.$store.dispatch(url, data);
      this.$loader.hide();
      //# Validando la respuesta
      if(!request.ok){
        const {title, type, text} = this.$requestToNotification.transformRequest(request)
        this.$actionNotify.showNotification(type, title, text)
        return this.$allErrors.getError(request.data);
      }
      //emite el evento para refrescar los datos de la pagina 
      this.$emit('refresh');
      this.modal = false;
    }
  },
}
</script>
