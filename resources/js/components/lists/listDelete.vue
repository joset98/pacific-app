<template>
  <div class="">
    <h6 v-if="title" class="c-grey-900">{{title}}</h6>
    <div class="list-group list-scroll">
      <div v-for="(item, index) in data" :key="index" class="list-group-item d-flex flex-wrap">
        <div class="col-9 px-0 d-flex align-items-center text-black">
          {{item}}
        </div>
        <div class="col-3 px-0 d-flex justify-content-end align-items-center">
          <i @click="removeItem(index)" class="ti-trash btn-trash"></i>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: 'list-general',
  methods:{
    removeItem(index){
      this.data.splice(index, 1);
    }
  },
  computed:{
    data:{
      get(){ return this.value; },
      set(val){ this.$emit('input', val); }
    },
  },
  props:{
    value:{
      default: null
    },
    title:{
      type: String,
      default: null
    }
  }
}
</script>


<style scope lang="scss">
.list-scroll{
  max-height: 200px;
  overflow: auto;
}
.btn-trash{
  color: red;
  font-size: 17px;
  cursor: pointer;
  border-radius: 50%;
  width: 30px;
  height: 30px;
  display: flex;
  justify-content: center;
  align-items: center;
  transition: .4s all ease;
}
.btn-trash:hover{
  background: rgba(255,0,0,.2);
}
</style>
