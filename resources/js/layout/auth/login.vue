<template>
  <at-auth title="Autenticacion">
    <!-- Inputs -->
    <template v-slot:inputs>
      <atInput v-model="loginData.username" :classLabel="'text-dark'" type="text" label="Usuario" 
        :alert="verifyFields" 
      />
      <atInput v-model="loginData.password" type="password" label="Contraseña" :classLabel="'text-dark'"
        :alert="verifyFields" 
      />
    </template>

    <!-- Actions -->
    <template v-slot:actions>
      <div class="d-flex flex-column w-100">
        <atCheckbox v-model="loginData.remenber_me" label="Recuerdame" keyId="remenber_me"/>

        <div class="peer authBtn mT-20">
          <button @click="login" class="btn btn-primary w-100">Acceder</button>
        </div>
      </div>
    </template>

    <!-- Footer -->
    <template v-slot:footer>
      <div class="authLink mt-2">
        <router-link tag="a" to="/registro" >
          Registrate aquí
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
  name: 'login',
  components:{ AtAuth, AtInput, AtCheckbox },
  data(){
    return{
      loginData: {
        username: null,
        password: null,
        remenber_me: false
      },
      verifyFields: false
    }
  },
  methods:{
    async login(){
      //# Validando mis datos
        if(this.$allErrors.verifyFields(this.loginData)) return this.verifyFields = true;
      //# Creando mi formData
        let data = this.$toFormData.transform(this.loginData)
      //# Enviando peticion
      this.$loader.full();
        let request = await this.$store.dispatch('main/login', data);
      this.$loader.hide();
      //# Validando la respuesta
        if(!request.ok) return this.$allErrors.getError(request.data);
      console.log(request)
      this.$router.push("/inicio");
    }
  },
}
</script>
