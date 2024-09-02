<template>
 
    <div :style="{ backgroundImage: `url(${props.headerBg})` }" class="categories-header">
        <div class="container-header-category" v-if="props.selectedCategory">
            <h2 class="category-header-title">{{  props.selectedCategory.name  }}</h2>
            <span>{{ props.selectedCategory.description }}</span>
        </div>
        <section class="w-full flex items-center mr-auto text-center bg-transparent">
            <ul class="flex flex-wrap w-full text-center items-center m-auto pt-4 pb-2 justify-between">
               <li
                v-if="(categories && categories.length)"
                class="menu"
                :class="{'active-menu': props.selectedCategory.id  == category.id, 
                'inactive-menu': props.selectedCategory.id  != category.id}" 
                    v-for="category in categories" :key="category.id">
                    <i :class="category.icon" class="p-1">   </i>  <br/>
                    <Link v-if="categories" class="link text-xs" :href="route('listing.index',{categoryId: category.id})" v-text="category.name"

                    @click="updateCategory(category.id)"/>
                </li>

                <li v-else class="menu active-menu text-center m-auto">
                   
                   <i class="fa-solid fa-backward"></i> <br/>
                   <Link 
                   class="link text-xs" 
                   :href="route('listing.index',{categoryId: props.selectedCategory.parent_id})" 
                   @click="updateCategory(props.selectedCategory.parent_id )"
                   >Back
                   </Link>
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
        type: String,
        default: ''
    },
    selectedCategory: {
        type: Object
    },

    categoriesChildren: {
        type: Object,
        default: null
    }
})

// console.log('headerBg', props.headerBg.value)
const emit = defineEmits(['categoryClicked'])

const updateCategory = debounce((id) => {
    console.log('props.headerBg', props.headerBg)
    emit('categoryClicked', id )
}, 200)

const categories = computed(
    () =>  props.categoriesChildren ?? page.props.categories 
)

</script>

