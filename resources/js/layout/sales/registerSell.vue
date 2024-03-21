<template>


</template>

<script>
// Components
import { AtInput, AtCheckbox } from '../../components/forms';

export default {
  name: 'registerSell',
  components:{ AtInput, AtCheckbox },
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
