<template>
    <div :key="listing.id">
        <ListingAddress :listing="listing" />
        <Link :href="route('listing.edit', listing.id)">Edit listing</Link>

    </div>
    <div>
        <!-- <Link :href="`/listing/${listing.id}`" method="DELETE" as="button">Delete listing</Link> -->
        <Link :href="route('listing.destroy', listing.id)" method="DELETE">Remove listing</Link>

    </div>
</template>

<script setup>
import { Link } from '@inertiajs/vue3'
import ListingAddress from '@/Components/ListingAddress.vue'

defineProps( {
    listing: Object,

})
</script>