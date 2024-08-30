<template>
    <div class="w-full bg-gray-100 dark:bg-gray-800 m-auto">
        {{  props.selectedCategoryName  }}
        <section class="w-full flex items-center mr-auto text-center">
            <ul class="flex flex-wrap w-full text-center items-center m-auto pt-4 pb-2 justify-between">
               <li :class="{'active': selectedCategory === category.id}" class="p-3" v-for="category in categories" :key="category.id">
                <i class="fa-solid fa-house p-1">   </i>  <br/>
                <Link :href="route('listing.index',{categoryId: category.id})" v-text="category.name"

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


const page = usePage()

const props = defineProps( {
    selectedCategoryName: {
        type: String,
        default: null // Default value if parent does not pass a value
    }
})

const emit = defineEmits(['categoryClicked'])

const updateCategory = debounce((id) => {
    emit('categoryClicked', id )
}, 200)

const categories = computed(
    () => page.props.categories 
)

</script>

