<template>
    <div class="flex flex-col-reverse md:grid md:grid-cols-12 gap-4">
        <Box class="md:col-span-7 flex items-center w-full">
            <div class="w-full text-center font-medium text-gray-500">No images yet!</div>
        </Box>
        <div class="md:col-span-5 flex flex-col gap-4">
            <Box>
                <template #header>
                    Basic info
                </template>
                <Price :price="listing.price" class="text-2xl font-bold" />
                <ListingSpace :listing="listing" class="text-xl" />
                <ListingAddress :listing="listing" class="text-gray"  />
            </Box>
            <Box>
                <template #header>
                    Offer
                </template>
                Make and offer
            </Box>
        </div>
    </div>
    <div class="flex md:grid md:grid-cols-12 gap-4 text-center">
        <Box class="flex items-center md:col-span-12 text-center justify-between">
            <div class="btn-listing-actions md:col-span-6 grid text-left m-auto gap-2">
                <Link :href="route('listing.destroy', listing.id)" method="DELETE">Remove listing</Link>
            </div>
            <div class="btn-listing-actions md:col-span-6 grid text-left  m-auto gap-2">
                <Link :href="route('listing.edit', listing.id)" as="button">Update listing</Link>
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
    listing: Object,

})
</script>