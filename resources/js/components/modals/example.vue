<template>
  <modal-slot layout_fixed v-model="modal">
     <div v-for="i in 10">
       Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
       Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor
       in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt
       in culpa qui officia deserunt mollit anim id est laborum.
     </div>
   </modal-slot>
</template>

<script>
export default {
  name: 'example',
  props:{
    value:{
      type: Boolean,
      default: null
    }
  },
  computed:{
    modal:{
      get(){ return this.value; },
      set(val){ this.$emit('input', val)}
    }
  }
}
</script>
