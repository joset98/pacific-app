<template>
  <div v-if="keyId" :class="['peer', classList]">
    <div class="checkbox checkbox-circle checkbox-info peers ai-c">
      <input type="checkbox" v-model="data" :id="keyId" :name="label" class="peer">
      <label v-if="label" :for="keyId" class="peers peer-greed js-sb ai-c">
        <span class="peer peer-greed">{{label}}</span>
      </label>
    </div>
  </div>
</template>

<script>
export default {
  name: 'adminator-checkbox',
  props:{
    value:{
      default: null
    },
    label:{
      type: String,
      default: null
    },
    keyId:{
      type: String,
      default: null
    },
    classList:{
      type: String,
      default: null
    },
  },
  computed:{
    data:{
      get(){ return this.value; },
      set(value){ this.$emit('input', value); }
    }
  },
}
</script>
