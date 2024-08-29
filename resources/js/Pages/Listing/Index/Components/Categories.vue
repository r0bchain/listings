<template>
    <div class="w-full bg-gray-100 dark:bg-gray-800 m-auto">
{{ defaultCategory }}
        <section class="w-full flex items-center mr-auto text-center">
            <ul class="flex flex-wrap w-full text-center items-center m-auto pt-4 pb-2 justify-between">
               <li class="p-3" v-for="category in categories" :key="category.id">
                <i class="fa-solid fa-house p-1">   </i>  
                <Link  :href="route('listing.index',{categoryId: category.id})" v-text="category.name"
                @click="updateCategory(category.id)"
                />

                  
               </li>
            </ul>
        </section>    
    </div>
</template>

<script setup>
import { Link, usePage } from '@inertiajs/vue3'
import { computed } from 'vue'
import { debounce } from 'lodash'

const emit = defineEmits(['categoryChanged'])

const updateCategory = (categoryId) => {
    debounce((value) => {
    emit('categoryChanged', categoryId)
    console.log('value', categoryId)
  }, 200)
}


// Page props 
const page = usePage()

const props = defineProps( {
    defaultCategory: Object,
})

const categories = computed(
    () => page.props.categories 
)

</script>

