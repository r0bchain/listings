<template>
   <Box :class="{ 'opacity-45': offer.rejected_at }">
        <template #header>Offer #{{ offer.id }} 
            <span v-if="offer.accepted_at" class="accepted">accepted</span>
        </template>

        <section class="flex items-center justify-between">
            <div :class="{'opacity-25': offer.rejected_at}">
                <Price :price="offer.amount" class="text-xl p-2" />
                <div class="text-gray-500">
                    Difference <Price :price="difference" />
                </div>

                <div class="text-gray-500 text-sm">
                    Made by {{ offer.bidder.name }}
                </div>
                <div class="text-gray-500 text-sm">
                    Made on {{ madeOn }}
                </div>
            </div>
            <div>
                <Link 
                v-if="!sold"
                :href="route('realtor.offer.accept', { offer: offer.id })" 
                class='btn-outline text-xs font-medium'
                as="button" method="PUT">Accept</Link>
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

const sold = computed(() => {
    return props.offer.accepted_at || props.offer.rejected_at
})

</script>