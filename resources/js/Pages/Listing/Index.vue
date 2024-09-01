<template> 
    <h3 v-if="currentCategory" class="title w-full text-left p-4">{{ currentCategory.name }} || {{ currentCategory.description }}</h3> 
    <Filters 
    :filters="filters"
    :selectedCategoryId="updateCategory"
    :cities="cities"  
    :defaultCity="defaultCity"
    @category-filter-changed="updateCategory = $event"
   
     />

    <!-- hanged name for the variable recibed to "selectedCategory" instead of "categoryId" 
    to avoid conflicts with the binding categoryId in the Filters component form 
    -->
   
  <Categories 
    @category-clicked="updateCategory = $event" 
    :selectedCategory="currentCategory ?? {}"
    :headerBg="imageUrl"/> 
    
    <div class="listing-container">
        <Listing v-for="listing in listings.data" :key="listing.id" :listing="listing" />

    </div>
    <div v-if="listings.data.length" class="w-full justify-center mt-4 mb-4">
        <Pagination :links="listings.links" />
    </div>
</template>

<script setup>
import { ref, computed, onMounted } from 'vue'
import { debounce } from 'lodash'
import Listing from '@/Pages/Listing/Index/Components/Listing.vue'
import ErrorMessage from '@/Components/Messages/ErrorMessage.vue'
import Pagination from '@/Components/UI/Pagination.vue';
import Filters from '@/Pages/Listing/Index/Components/Filters.vue';
import Categories from '@/Pages/Listing/Index/Components/Categories.vue';
import { usePage } from '@inertiajs/vue3'
import { createClient } from 'pexels';
import { randomImages } from '@/Composables/randomImages';


// Page props 
const page = usePage()

const props = defineProps( {
    listings: Object,
    filters: Object,
    cities: Array,
    defaultCity: String,
    category: Object    
})

const updateCategory = ref(props.filters.categoryId ?? 1)
const imageUrl = ref('')

const topics = (props.category && props.category[0].name) ? [props.category[0].name] : page.props.site.TOPICS_IMAGE

// Fetch the image URL on component mount

const { randomImage, location } = randomImages(
    imageUrl,
    page.props.site.RANDOM_IMAGED_KEY, 
    topics,
    {per_page: 1, size: 'small', locale: 'en-US', orientation: 'landscape' }
)


const currentCategory = computed(() => {
  
    // Ojo con la comparacion de tipos!!! , hacer casting a Number para evitar errores
  return page.props.categories.find(category => Number(category.id) === Number(updateCategory.value))
})

// Fetch the image URL on component mount
onMounted(() => {
    imageUrl.value = randomImage
  
})


</script>