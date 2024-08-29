<template>
    <Filters :filters="filters" />
    
    <Categories   @category-changed="defaultCategoryId = $event"/>
    <div class="listing-container">
        <Listing v-for="listing in listings.data" :key="listing.id" :listing="listing" />

    </div>
    <div v-if="listings.data.length" class="w-full justify-center mt-4 mb-4">
        <Pagination :links="listings.links" />
    </div>
</template>

<script setup>
import { ref, computed } from 'vue'
import Listing from '@/Pages/Listing/Index/Components/Listing.vue'
import ErrorMessage from '@/Components/Messages/ErrorMessage.vue'
import Pagination from '@/Components/UI/Pagination.vue';
import Filters from '@/Pages/Listing/Index/Components/Filters.vue';
import Categories from '@/Pages/Listing/Index/Components/Categories.vue';
import { Link, usePage } from '@inertiajs/vue3'

// Page props 
const page = usePage()

const categories = computed(
    () => page.props.categories 
)


const props = defineProps( {
    listings: Object,
    filters: Object,

})

const category = ref(props.filters.categoryId)

</script>