<template>
  <div class="">
    <h4 class="c-grey-900 mT-10 mb-3">Inicio</h4>
    <a @click="showModal = true" class="btn btn-primary">Modal example</a>
    <a @click="showModal2 = true" class="btn btn-secondary">Modal verify</a>


    <example v-model="showModal" />
    <verify v-model="showModal2" :jsonData="jsonData" />
  </div>
</template>

<script>
import { example, verify } from '../components/modals';
export default {
  name: 'home',
  components:{ example, verify },
  data(){
    return{
      showModal: false,
      showModal2: false,
      jsonData:{
        dataEmit: false,
        title: 'Alerta',
        icon: {
          name: 'report_problem',
          style:{
            color: 'red'
          }
        },
      }
    }
  },
  mounted(){
    console.log("Home success");
  },
}
</script>
