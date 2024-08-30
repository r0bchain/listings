<template>
    <div :style="{ backgroundImage: `url(${props.headerBg})` }" class="w-full opacity-80 bg-gray-100 dark:bg-gray-800 m-auto bg-center">
        <div class="w-full pt-2 pl-4 grid text-center title-category" v-if="props.selectedCategory">
            <h2>{{  props.selectedCategory.name  }}</h2>
            <span>{{ props.selectedCategory.description }}</span>
        </div>
        <section class="w-full flex items-center mr-auto text-center bg-transparent">
            <ul class="flex flex-wrap w-full text-center items-center m-auto pt-4 pb-2 justify-between">
               <li 
               class="menu"
               :class="{'active-menu': props.selectedCategory.id  == category.id, 
               'inactive-menu': props.selectedCategory.id  != category.id}" 
                v-for="category in categories" :key="category.id">
                <i class="fa-solid fa-house p-1">   </i>  <br/>
                <Link  class="link text-xs" :href="route('listing.index',{categoryId: category.id})" v-text="category.name"

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
    headerBg: {
        type: String
    },
    selectedCategory: {
        type: Object
    }
})

const emit = defineEmits(['categoryClicked'])

const updateCategory = debounce((id) => {
    console.log('props.headerBg', props.headerBg)
    emit('categoryClicked', id )
}, 200)

const categories = computed(
    () => page.props.categories 
)



</script>

