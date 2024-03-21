<template>
  <modal-verify :jsonData="jsonData" v-model="modal">
    <slot name="content" ></slot> 

    <div v-if="hasFooterSlot" slot="footer">
      <slot name="footer"></slot> 
    </div>

  </modal-verify>
</template>

<script>
export default {
  name: 'delete',
  props:{
    value:{
      type: Boolean,
      default: null
    },
    currentItem:{
      type: [ Object, Array ],
      default: null
    },
    jsonData:{
      default: null
    }
  },
  computed:{
    modal:{
      get(){ return this.value; },
      set(val){ this.$emit('input', val)}
    },
    hasFooterSlot () {
      return !!this.$slots['footer']
    },
    hasSlot (name = 'default') {
      return !!this.$slots[ name ] || !!this.$scopedSlots[ name ];
    }
  }
}
</script>
