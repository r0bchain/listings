<template> 
   
    <h3 v-if="currentCategory" class="title w-full text-left p-4">{{ currentCategory.name }} || {{ currentCategory.description }}</h3> 
    <Filters :filters="filters"  
    @category-filter-changed="updateCategory = $event"
    :selectedCategoryId="updateCategory"
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
import Listing from '@/Pages/Listing/Index/Components/Listing.vue'
import ErrorMessage from '@/Components/Messages/ErrorMessage.vue'
import Pagination from '@/Components/UI/Pagination.vue';
import Filters from '@/Pages/Listing/Index/Components/Filters.vue';
import Categories from '@/Pages/Listing/Index/Components/Categories.vue';
import { usePage } from '@inertiajs/vue3'
import { createClient } from 'pexels';
import { debounce } from 'lodash'


// Page props 
const page = usePage()

const props = defineProps( {
    listings: Object,
    filters: Object,
    pexelKey: String
    
})

const updateCategory = ref(props.filters.categoryId ?? 1)
const imageUrl = ref('')


// Fetch the image URL on component mount
const fetchImageUrl = () => {
    const client = createClient(props.pexelKey)
    const words = ['Beach-thailand', 'Buddha-Thailand', 'Hua-Hin', 'Bangkok', 'Ayutaya']
    const query =  currentCategory.value ? currentCategory.value.name : words[Math.floor(Math.random() * words.length)];
    console.log(query);
    client.photos.search({ query, per_page: 1, size: 'small', locale: 'en-US', orientation: 'landscape' }).then(photos => {
        console.log('imagen index', photos.photos[0].src.portrait);
        imageUrl.value = photos.photos[0].src.landscape
    }).catch(err => {
        console.log('error', err)
    })
}

const currentCategory = computed(() => {
  
    // Ojo con la comparacion de tipos!!! , hacer casting a Number para evitar errores
  return page.props.categories.find(category => Number(category.id) === Number(updateCategory.value))
})

// Fetch the image URL on component mount
onMounted(() => {
    fetchImageUrl()
})


</script>