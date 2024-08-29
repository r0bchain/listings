<template>
          
    <h1>{{ defaultCategory.name }}</h1>

    <div class="filter-wrapper">
        <form @submit.prevent="filter">
            <div class="filter-container">
                <div class="flex flex-nowrap items-center">
                    <input v-model="filterForm.priceFrom" type="text" class="input-filter w-28"  placeholder="Price from" />
                    <input v-model="filterForm.priceTo" type="text" class="input-filter w-28"  placeholder="Price to"/>
                </div>
                <div class="flex flex-nowrap items-center">
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
    
                <div class="flex flex-nowrap items-center">
                    <input v-model="filterForm.areaFrom" type="text" class="input-filter w-28" placeholder="Area from" />
                    <input v-model="filterForm.areaTo"   type="text" class="input-filter w-28" placeholder="Area to"/>
                </div>

                <div class="flex flex-nowrap items-center">
                    <select v-model="defaultCategory.id" class="input-filter w-22" @change="updateCategoryFilter">
                        <option 
                        v-for="category in categories" :key="category.id" 
                        :value="category.id" 
                        :selected="category.id == defaultCategory.id"
                        
                        >{{ category.name }}
                        
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
import { ref, computed } from 'vue'

// Page props 
const page = usePage()

const categories = computed(
    () => page.props.categories 
)

const props = defineProps( {
    filters: Object,
    defaultCategory: Object,
    
})

const defaultCategory = computed(
    () =>   categories.value.find(category => {
        return category.id === Number(props.filters.categoryId)

    }) 
)
const defaultCategoryId = ref(1)

const emit = defineEmits(['categoryFilterChanged'])

const updateCategoryFilter = (event) => {
    defaultCategory.id = event.target.value
    emit('categoryFilterChanged',  defaultCategory.id )
    console.log('value',  defaultCategory.id )
}


// console.log('defaultCategory', defaultCategory);
const filterForm = useForm({
    priceFrom: props.filters.priceFrom ?? null,
    priceTo: props.filters.priceTo ?? null,
    beds: props.filters.beds ?? null,
    baths: props.filters.baths ?? null,
    areaFrom: props.filters.areaFrom ?? null,
    areaTo: props.filters.areaTo ?? null,
})


const filter = () => {
    console.log(filterForm)
    filterForm.get(
        route('listing.index'),
        {
            preserveState: true,
            preserveScroll: true,
        }
    )

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