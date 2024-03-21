<template>
    <!-- Register Form  w-100-->
    <div class="bg-white | py-2 px-3">

        <div class="d-flex justify-content-start align-items-start">
            <span class="icon-holder | clientBgColor c-grey-100 | squareBgUpdate | d-flex justify-content-center align-items-center">
                <i class="fa fa-user-o fa-2"></i>
            </span>
            <h4 class="mL-10">
            Datos del cliente
            </h4>
        </div>
        
        <div class="d-flex flex-wrap | c-orange-900">
          <slot name="inputs"/>
        </div>

    </div>
    <!-- Register Form -->
</template>

<script>

export default {
  name: 'client-form',
}
</script>

<style media="screen">
  .squareBgUpdate{
    width: 2.5em;
    height: 2.5em;
  }
  .clientBgColor{
    background-color:rgba(226, 45, 0, 0.856);
  }
  .caseTrue{
    color: green;
  }
  .caseFalse{
    color: red;
  }
</style>
