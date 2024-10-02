<template>
    <div>
      <span class="font-normal">{{ listing.beds }}</span> bds <span class="text-gray-400">| </span>  
      <span class="font-normal">{{ listing.baths }}</span> ba <span
        class="text-gray-400"
      >| </span>
      <span class="font-normal">{{ listing.area }}</span> m²
    </div>
  </template>
  
  <script setup>
  defineProps({
    listing: Object,
  })
  </script>