<template>
      <Box>
            <template #image>
                    <img
                    alt=""
                    src="https://images.unsplash.com/photo-1524758631624-e2822e304c36?ixlib=rb-1.2.1&ixid=MnwxMjA3fDF8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1024&q=80"
                    class="h-50 w-full object-cover border border-white-500"
                    />
                
            </template>
            <div class="flex items-center gap-1">
                
                <Price :price="listing.price" class="text-1xl font-bold" />
            </div>
            
                <Link :href="route('listing.show',{listing: listing.id})">
                    <ListingSpace :listing="listing" class="text-xs" />
                    <ListingAddress :listing="listing" class="text-gray"  />
                </Link>

            <!-- <Box>
                <template #header  v-if="listing.category_id">
                    Montly payment
                </template>

                <div  v-if="listing.category_id">
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
            </Box>                 -->

            <!-- <div class="flex justify-between pt-5">
                <div v-if="user" class="btn-listing-actions">
                    <Link :href="route('realtor.listing.edit', listing.id)">Edit listing</Link>
                </div>
             
            </div> -->
            
           
        </Box>
</template>

<script setup> 
import { Link } from '@inertiajs/vue3'
import ListingAddress from '@/Components/ListingAddress.vue'
import ListingSpace from '@/Components/ListingSpace.vue'
import Price from '@/Components/Price.vue'
import Box from '@/Components/UI/Box.vue'
import { useMonthlyPayment } from '@/Composables/useMonthlyPayment'
import { usePage } from '@inertiajs/vue3'

import {ref} from 'vue'

const page = usePage()

const interestRate = ref(2.5)
const duration = ref(25)

const user = page.props.user

const props = defineProps( {
    listing: Object

})

const { monthlyPayment } = useMonthlyPayment(props.listing.price, interestRate, duration)

</script>

