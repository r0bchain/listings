<template>
    <div class="flex flex-col-reverse md:grid md:grid-cols-12 gap-4">
        <Box class="md:col-span-7 flex items-center w-full">
            <div class="w-full text-center font-medium text-gray-500">No images yet!</div>
        </Box>
        <div class="md:col-span-5 flex flex-col gap-4">
            <Box>
                <template #header>
                    Montly payment
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

                    <div class="mt-2 text-gray-500">
                        <div class="flex justify-between">
                            <div>Total paid </div>
                            
                            <div>
                                
                                <Price :price="totalPaid" class="font-medium"></Price>
                            </div>

                        </div>
                   
                        <div class="flex justify-between">
                            <div>Principal paid</div>
                            
                            <div>
                                <Price :price="listing.price" class="font-medium"></Price>
                            </div>

                        </div>

                        <div class="flex justify-between">
                            <div>Interest paid</div>
                            
                            <div>
                                <Price :price="totalInterest" class="font-medium"></Price>
                            </div>

                        </div>
                    </div>

                </div>
            </Box>
        </div>
    </div>
    <div class="flex md:grid md:grid-cols-12 gap-4 text-center">
        <Box class="flex items-center md:col-span-12 text-center justify-between">
            <div v-if="user" class="btn-listing-actions md:col-span-6 grid text-left m-auto gap-2">
                <Link :href="route('realtor.listing.destroy', listing.id)" method="DELETE">Remove listing</Link>
            </div>
            <div v-if="user" class="btn-listing-actions md:col-span-6 grid text-left  m-auto gap-2">
                <Link :href="route('realtor.listing.edit', listing.id)" as="button">Update listing</Link>
            </div>
        </Box>
    </div>
</template>

<script setup>
import ListingAddress from '@/Components/ListingAddress.vue'
import ListingSpace from '@/Components/ListingSpace.vue'
import Price from '@/Components/Price.vue'
import Box from '@/Components/UI/Box.vue'
import { useMonthlyPayments } from '@/Composables/useMonthlyPayments'
import { defineProps, ref, computed } from 'vue'
import { Link, usePage } from '@inertiajs/vue3'

const interestRate = ref(2.5)
const duration = ref(25)

const page = usePage()
const user = computed(() => page.props.user)
console.log('user', user)

const props = defineProps( {
    listing: Object,

})

const { monthlyPayment, totalPaid, totalInterest } = useMonthlyPayments(props.listing.price, interestRate, duration)

</script>