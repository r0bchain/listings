<template>
    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-4">
        <Box v-for="listing in listings" :key="listing.id">
            <div>

                <Price :price="listing.price" class="text-2xl font-bold" />
                <Link :href="route('listing.show',{listing: listing.id})">
                    <ListingSpace :listing="listing" class="text-xl" />
                    <ListingAddress :listing="listing" class="text-gray"  />
                </Link>
            </div>

            <div>
                <Link :href="route('listing.edit', listing.id)">Edit listing</Link>
            </div>
            <div>
                <Link :href="route('listing.destroy', listing.id)" method="DELETE" as="button">Remove listing</Link>

            </div>
           
        </Box>
    </div>
</template>

<script setup>
import { Link } from '@inertiajs/vue3'
import ListingAddress from '@/Components/ListingAddress.vue'
import ListingSpace from '@/Components/ListingSpace.vue'
import Price from '@/Components/Price.vue'
import Box from '@/Components/UI/Box.vue'

defineProps( {
    listings: Array,

})
</script>