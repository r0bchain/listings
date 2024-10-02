<template> 
    <MenuNav />
    <!-- <h3 v-if="currentCategory" class="title w-full text-left p-4">{{ currentCategory.name }} || {{ currentCategory.description }}</h3>  -->
    <Filters 
    :filters="filters"
    :selectedCategoryId="updateCategory"
    :selectedCategory="category"
    :cities="cities"  
    :defaultCity="defaultCity"
    :categoriesChildren="props.categoriesChildren ?? null"
    @category-filter-changed="updateCategory = $event"
   
     />

    <!-- hanged name for the variable recibed to "selectedCategory" instead of "categoryId" 
    to avoid conflicts with the binding categoryId in the Filters component form 
    -->
   
  <Categories 
    @category-clicked="updateCategory = $event" 
    :selectedCategory="category"
    :headerBg="imageUrl"
    :categoriesChildren="props.categoriesChildren ?? null"/> 
    
    <div class="listing-container">
        <Listing v-for="listing in listings.data" :key="listing.id" :listing="listing" />

    </div>
    <div v-if="listings.data.length" class="w-full justify-center mt-4 mb-4">
        <Pagination :links="listings.links" />
    </div>
</template>

<script setup>
import { ref, computed, onMounted } from 'vue'
import axios from 'axios';
// import { debounce } from 'lodash'
import Listing from '@/Pages/Listing/Index/Components/Listing.vue'
// import ErrorMessage from '@/Components/Messages/ErrorMessage.vue'
import Pagination from '@/Components/UI/Pagination.vue';
import MenuNav from '@/Components/UI/MenuNav.vue';

import Filters from '@/Pages/Listing/Index/Components/Filters.vue';
import Categories from '@/Pages/Listing/Index/Components/Categories.vue';
import { usePage } from '@inertiajs/vue3'
import { randomImages } from '@/Composables/randomImages';


// Page props 
const page = usePage()

const props = defineProps( {
    listings: Object,
    filters: Object,
    cities: Array,
    defaultCity: String,
    category: {
        Type: Object,
      
    },
    categoriesChildren: Object 
})

const updateCategory = ref(props.filters.categoryId ?? props.category.id)

const totalImages = page.props.site.DEFAULT_CATEGORY_IMAGE.length
const randomImageIndex = Math.floor(Math.random() * totalImages)

const imageUrl = ref((props.category && props.category.cover_image) ?
 props.category.cover_image : page.props.site.DEFAULT_CATEGORY_IMAGE[randomImageIndex])

const topics = (props.category && props.category.name) ? [props.category.name] : page.props.site.TOPICS_IMAGE

// Fetch the image URL on component mount
// console.log('category', props.category[0].cover_image)

const getRandomImageIfNotExists = (currentImageUrl, topics) => {

    if (currentImageUrl === null) {
        const { randomImage, location } = randomImages(
            null,
            page.props.site.RANDOM_IMAGE_KEY, 
            topics,
            {per_page: 20, size: 'small', locale: 'en-US', orientation: 'landscape' }
        )

        console.log('location', location)

        return { randomImage, location }

    }

}


const currentCategory = computed(() => {
  
    // Ojo con la comparacion de tipos!!! , hacer casting a Number para evitar errores
  return page.props.categories.find(category => Number(category.id) === Number(updateCategory.value))
})

// Fetch the image URL on component mount
// We only call the async external API to fetch the image URL if the category image is null
onMounted(async() => {
    if(props.category === null) {
        const data = getRandomImageIfNotExists(props.category[0].cover_image, topics)
        console.log('data', data)
        console.log('randomImage ', data.randomImage.value.imageUrl )
        imageUrl.value = data.randomImage.value.imageUrl
    } else {
        imageUrl.value = props.category.cover_image
    }
    // const categoryId = currentCategory.value.id
    // try {
    // const response = await axios.put('https://category/' + categoryId, {
    //   cover_image: imageUrl.value 
    // });
    // console.log('URLs sent successfully:', response.data);
    // } catch (error) {
    //     console.log('currentCategory', currentCategory.value.id)
    //     console.error('Error sending URLs:', error);
    // }
  
})


</script>