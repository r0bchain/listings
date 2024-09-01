<template>
    <ul>
        <li class="line-clamp-1">{{ listing.title }}</li>
        <li>{{ listing.street }}</li>
        <li>{{ listing.city }}</li>         
    </ul> 
    </br>
</template>

<script setup>

defineProps( {
    listing: Object,

})
</script>