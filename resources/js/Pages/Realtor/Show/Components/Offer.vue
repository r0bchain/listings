<template>
   <Box>
        <template #header>Offer #{{ offer.id }}</template>

        <section class="flex items-center justify-between">
            <div>
                <Price :price="offer.amount" class="text-xl p-2" />
                <div class="text-gray-500">
                    Difference <Price :price="difference" />
                </div>

                <div class="text-gray-500 text-sm">
                    Made by Papa Xulo
                </div>
                <div class="text-gray-500 text-sm">
                    Made on {{ madeOn }}
                </div>
            </div>
            <div>
                <Link class="btn-outline text-xs font-medium" as="button">Accept</Link>
            </div>

        </section>
   </Box> 
</template>

<script setup>
import { Link } from '@inertiajs/vue3'
import { computed } from 'vue'

import Box from '@/Components/UI/Box.vue'
import Price from '@/Components/Price.vue'

 const props =  defineProps({
        offer: Object,
        listingPrice: Number
})

const difference = computed(() => {
    return props.offer.amount - props.listingPrice
})

const madeOn = computed(() => {
    return new Date(props.offer.created_at).toDateString()
})

</script>