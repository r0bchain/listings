<template>
    <div class="box-container">
      <BoxDetails>
          <template #header>
            <h3 class="title-show">{{ listing.title }}</h3>
          </template>

          <h3 class="box-title">Description:</h3>
          <div class="description-show">{{ listing.description }}</div>
        <Box v-if="listing.images.length" >
        
          <div class="grid grid-cols-2 gap-1">
            <img
              v-for="image in listing.images" :key="image.id"
              :src="image.src"/>
          </div>
        </Box>
        <EmptyState v-else class="md:col-span-7 flex items-center">No Images</EmptyState>

      </BoxDetails>
      <div class="md:col-span-5 flex flex-col gap-4">
        <Box class="box">
          <template #header>
            Basic info
          </template>
          <Price :price="listing.price" class="text-2xl font-bold" />
          <ListingSpace :listing="listing" class="text-lg" />
          <ListingAddress :listing="listing" class="" />
        </Box>
  
        <Box class="box">
          <template #header>
            Monthly Payment
          </template>
          <div>
            <label class="label">Interest rate ({{ interestRate }}%)</label>
            <input
              v-model.number="interestRate"
              type="range" min="0.1" max="30" step="0.1"
              class="w-full h-4 rounded-lg appearance-none cursor-pointer"
            />
  
            <label class="label">Duration ({{ duration }} years)</label>
            <input
              v-model.number="duration"
              type="range" min="3" max="35" step="1"
              class="w-full h-4 rounded-lg appearance-none cursor-pointe"
            />
  
            <div class="text-gray-600 dark:text-gray-300 mt-2">
              <div class="text-gray-400">Your monthly payment</div>
              <Price :price="monthlyPayment" class="text-3xl" />
            </div>
  
            <div class="mt-2 text-gray-500">
              <div class="flex justify-between">
                <div>Total paid</div>
                <div>
                  <Price :price="totalPaid" class="font-medium" />
                </div>
              </div>
              <div class="flex justify-between">
                <div>Principal paid</div>
                <div>
                  <Price :price="listing.price" class="font-medium" />
                </div>
              </div>
              <div class="flex justify-between">
                <div>Interest paid</div>
                <div>
                  <Price :price="totalInterest" class="font-medium" />
                </div>
              </div>
            </div>
          </div>
        </Box>
  
        <MakeOffer 
            v-if="user && !offerMade" 
            :listing-id="listing.id" 
            :price="listing.price" 
            @offer-updated="offer = $event"
            />
  
    <OfferMade v-if="user && offerMade" :offer="offerMade" />
      </div>
    </div>
  </template>
  
  <script setup>
  import { Link, usePage } from '@inertiajs/vue3'
  import { ref, computed } from 'vue'
  import ListingAddress from '@/Components/ListingAddress.vue'
  import ListingSpace from '@/Components/ListingSpace.vue'
  import Price from '@/Components/Price.vue'
  import BoxDetails from '@/Components/UI/BoxDetails.vue'
  import Box from '@/Components/UI/Box.vue'

  import MakeOffer from '@/Pages/Listing/Show/Components/MakeOffer.vue'
  import OfferMade from '@/Pages/Listing/Show/Components/OfferMade.vue'
  import { useMonthlyPayment } from '@/Composables/useMonthlyPayment'
  import EmptyState from '@/Components/UI/EmptyState.vue'
  
  // Page props 
  const page = usePage()

  const props = defineProps({
    listing: Object,
    offerMade: Object,
  })

  const interestRate = ref(2.5)
  const duration = ref(25)
  const offer = ref(props.listing.price)

  const { monthlyPayment, totalPaid, totalInterest } = useMonthlyPayment(
    offer, interestRate, duration,
  )

  const user = computed(() => page.props.user)

  </script>