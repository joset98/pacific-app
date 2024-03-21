<template>
  <li class="notifications dropdown">
    <span v-if="counter > 0" class="counter bgc-red">{{counter}}</span>
    <a class="dropdown-toggle no-after" data-toggle="dropdown">
      <i :class="[icon]"></i>
    </a>

    <slot></slot>
  </li>
</template>

<script>
export default {
  name: 'btnNotifications',
  props:{
    counter:{
      type: [String, Number],
      default: 0
    },
    icon:{
      type: String,
      default: 'ti-bell'
    },
  }
}
</script>
