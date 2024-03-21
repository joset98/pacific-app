<template>
    <!-- Sales Form Data -->
  <!--  pY-20 mY-20 mL-10 mR-20 -->
    <div class="bg-white | py-2 px-3 | h-100 w-100">
        <div class="d-flex justify-content-start align-items-start">
          <span class="icon-holder | c-grey-100 bgShopCartEmpty | squareBgUpdate | d-flex justify-content-center align-items-center">
              <i class="ti-shopping-cart"></i>
          </span>
          <h4 class="mL-10">
              Datos de venta
          </h4>
        </div>      

        <div class="d-flex flex-wrap | c-red-700">
          <slot name="inputs"></slot>
        </div>
    </div>
    <!-- Sales Form Data -->
</template>

<script>

export default {
  name: 'sales-form',
}
</script>

<style media="screen">
  .bgShopCartEmpty{
    background-color: rgb(243, 60, 60);
  }
  .squareBgUpdate{
    width: 2.5em;
    height: 2.5em;
  }
  .caseTrue{
    color: green;
  }
  .caseFalse{
    color: red;
  }
</style>
