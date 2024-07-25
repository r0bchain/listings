<template>
    <div v-for="listing in listings" :key="listing.id">
        <div>

            <Link :href="route('listing.show',{listing: listing.id})">
                <ListingAddress :listing="listing" />
            </Link>
        </div>

        <div>
            <Link :href="route('listing.edit', listing.id)">Edit listing</Link>
        </div>
        <div>
            <Link :href="route('listing.destroy', listing.id)" method="DELETE" as="button">Remove listing</Link>

        </div>
    </div>
</template>

<script setup>
import { Link } from '@inertiajs/vue3'
import ListingAddress from '@/Components/ListingAddress.vue'

defineProps( {
    listings: Array,

})
</script>