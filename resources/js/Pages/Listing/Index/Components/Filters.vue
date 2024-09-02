<template>

    <div class="filter-wrapper">
        <form @submit.prevent="filter">
            <div class="filter-container">
                <div v-if="filterForm.categoryId == 1" class="flex flex-nowrap items-center">
                    <input v-model="filterForm.priceFrom" type="text" class="input-filter w-28"  placeholder="Price from" />
                    <input v-model="filterForm.priceTo" type="text" class="input-filter w-28"  placeholder="Price to"/>
                </div>
                <div v-if="filterForm.categoryId == 1"  class="flex flex-nowrap items-center">
                   <select v-model="filterForm.beds" class="input-filter w-22">
                     <option :value="null">Beds</option>
                     <option v-for="n in 5" :key="n" :value="n" v-text="n" />
                     <option>6+</option>
    
                   </select>
              
                   <select v-model="filterForm.baths" class="input-filter w-22">
                     <option :value="null">Baths</option>
                     <option v-for="n in 5" :key="n" :value="n" v-text="n" />
                     <option>6+</option>
    
                   </select>
                </div>
    
                <div v-if="filterForm.categoryId == 1"  class="flex flex-nowrap items-center">
                    <input v-model="filterForm.areaFrom" type="text" class="input-filter w-28" placeholder="Area from" />
                    <input v-model="filterForm.areaTo"   type="text" class="input-filter w-28" placeholder="Area to"/>
                </div>

                <div class="flex flex-nowrap items-center">
                    <select v-model="filterForm.categoryId" class="input-filter w-22">
                        <option 
                            v-for="category in categories" :key="category.id" 
                            :value="category.id" 
                            :selected="category.id == filterForm.categoryId"
                            
                            >{{ category.name }}
                            
                        </option>
                        <option 
                        v-if="props.selectedCategory" 
                        :value="props.selectedCategory.id">
                         {{  props.selectedCategory.name }}
                        </option>

                    </select>
                </div>

                <div class="flex flex-nowrap items-center">
                    <select v-model="filterForm.city" class="input-filter w-22">
                        <option :value="null">All location</option>
                        <option 
                        v-for="element in props.cities" :key="element.city" 
                        :value="element.city" 
                        :selected="element.city == filterForm.city"
                        
                        >{{ element.city }}
                        
                    </option>
                    </select>
                </div>
    
                <button type="submit" class="btn-normal">Filters</button>
                <button type="reset" @click="clear" class="btn-danger">Clear</button>
    
            </div>
            
        </form>
    </div>
</template>

<script setup> 

import { useForm } from '@inertiajs/vue3'
import { usePage } from '@inertiajs/vue3'
import { computed } from 'vue'
import { debounce } from 'lodash'

// Page props 
const page = usePage()

const categories = computed(
    () => page.props.categories 
)


const props = defineProps( {
    filters: Object,
    cities: Array,
    defaultCity: String,
    selectedCategory: {
        type: Object
    },
    categoriesChildren: {
        type: Object,
        default: null
    }
})
const emit = defineEmits(['categoryFilterChanged'])

const updateCategory = debounce(() => {
    emit('categoryFilterChanged', filterForm.categoryId)
}, 200)


const filterForm = useForm({
    priceFrom: props.filters.priceFrom ?? null,
    priceTo: props.filters.priceTo ?? null,
    beds: props.filters.beds ?? null,
    baths: props.filters.baths ?? null,
    areaFrom: props.filters.areaFrom ?? null,
    areaTo: props.filters.areaTo ?? null,
    categoryId: props.selectedCategory.id ?? 3, // Real state by default
    city: props.filters.city ?? null,
})


const filter = () => {
    filterForm.get(
        route('listing.index'),
        {
            preserveState: true,
            preserveScroll: true,
        }
    )
    updateCategory()
    // filterForm.reset()
}

const clear = () => {

  const fields = ['priceFrom', 'priceTo', 'beds', 'baths', 'areaFrom', 'areaTo'];

  fields.forEach(field => {
    filterForm[field] = null;
  });
  
  filter()
}
</script>