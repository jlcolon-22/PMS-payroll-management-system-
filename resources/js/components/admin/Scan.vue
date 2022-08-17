<template>
	<div>
            <h1 class="text-9xl font-extrabold text-white text-center mt-10">
                <span class="text-yellow-400">P</span>
                <span class="text-red-400">M</span>
                <span class="text-blue-400">S</span>
            </h1>

           
                <StreamBarcodeReader class="w-[630px] h-[500px] mx-auto bg-black" @decode="onDecode" @loaded="onLoaded"></StreamBarcodeReader>
         
  </div>
</template>

<script setup>
  import { StreamBarcodeReader } from "vue-barcode-reader";


  const onDecode = (result) =>{
      console.log(result);
  }


  
</script>

<style lang="css" scoped>
</style>
