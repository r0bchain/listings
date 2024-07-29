<template>
      <Box>
            <div class="flex items-center gap-1">
                
                <Price :price="listing.price" class="text-2xl font-bold" />
                <div class="text-xs text-gray-500"></div>
            </div>
                <Link :href="route('listing.show',{listing: listing.id})">
                    <ListingSpace :listing="listing" class="text-xl" />
                    <ListingAddress :listing="listing" class="text-gray"  />
                </Link>

            <Box>
                <template #header>
                    Montly payment
                </template>

                <div>
                    <label class="label">Interest rate ( {{ interestRate }}%)</label>
                    <input v-model.number="interestRate"
                    type="range" 
                    class="range_slide" 
                    min="0.1" max="30" step="0.1"/>

                    <label class="label">Duration ( {{ duration }} years)</label>
                    <input v-model.number="duration"
                    type="range" 
                    class="range_slide" 
                    min="3" max="35" step="1"/>
                    
                    <div class="text-gray-600 dark:text-gray-300 mt-2">
                        <div class="text-gray-400">Your monthly payment</div>
                        <Price :price="monthlyPayment" class="text-3xl"></Price>
                    </div>

                </div>
            </Box>                

            <div>
                <Link :href="route('listing.edit', listing.id)">Edit listing</Link>
            </div>
            <div>
                <Link :href="route('listing.destroy', listing.id)" method="DELETE" as="button">Remove listing</Link>

            </div>
            
           
        </Box>
</template>

<script setup> 
import { Link } from '@inertiajs/vue3'
import ListingAddress from '@/Components/ListingAddress.vue'
import ListingSpace from '@/Components/ListingSpace.vue'
import Price from '@/Components/Price.vue'
import Box from '@/Components/UI/Box.vue'
import { useMonthlyPayments } from '@/Composables/useMonthlyPayments'

import {ref} from 'vue'

const interestRate = ref(2.5)
const duration = ref(25)

const props = defineProps( {
    listing: Object,

})

const { monthlyPayment } = useMonthlyPayments(props.listing.price, interestRate, duration)

</script>

