<template>
    <div v-if="errorMsg" class="input-error">
          {{ errorMsg }}
    </div>
</template>

<script setup> 
 defineProps({
    errorMsg: Object
  })

</script>