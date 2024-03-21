<template>
  <at-auth title="Registro">
    <!-- Inputs -->
    <template v-slot:inputs>
      <atInput v-model="registerData.fullname" type="text" label="Nombre completo" :classLabel="'text-dark'"
        :alert="verifyFields" 
      />
      <atInput v-model="registerData.username" type="text" label="Nombre de usurio" :classLabel="'text-dark'" 
        :alert="verifyFields" 
      />
      <atInput v-model="registerData.email" type="email" label="Correo electronico" :classLabel="'text-dark'" 
        :alert="verifyFields"
      />
      <atInput v-model="registerData.password" type="password" label="Contraseña" :classLabel="'text-dark'" 
        :alert="verifyFields" 
      />
    </template>

    <!-- Actions -->
    <template v-slot:actions>
      <div class="d-flex justify-content-end w-100">
        <div class="peer authBtn">
          <button @click="register" class="btn btn-primary">Registrarce</button>
        </div>
      </div>
    </template>

    <!-- Footer -->
    <template v-slot:footer>
      <div class="authLink mt-2">
        <router-link tag="a" to="/acceso" >
          Iniciar sesión
        </router-link>
      </div>
    </template>
  </at-auth>
</template>

<script>
// Components
import { AtAuth } from '../../components/auth';
import { AtInput, AtCheckbox } from '../../components/forms';

export default {
  name: 'register',
  components:{ AtAuth, AtInput, AtCheckbox },
  data(){
    return{
      registerData:{
        fullname: null,
        username: null,
        email: null,
        password: null
      },
      verifyFields: false
    }
  },
  methods:{
    async register(){
      //# Validando mis datos
        if(this.$allErrors.verifyFields(this.registerData)) return this.verifyFields = true;
      //# Creando mi formData
        let data = this.$toFormData.transform(this.registerData);
      //# Enviando peticion
      this.$loader.full();
        let request = await this.$store.dispatch('main/register', data);
      this.$loader.hide();
      //# Validando la respuesta
      if(!request.ok) return this.$allErrors.getError(request.data);

      this.resetFields();
      this.$router.push("/acceso");
    },

    resetFields(){
      this.registerData = {
        fullname: null,
        username: null,
        email: null,
        password: null
      }
    },
  }
}
</script>
