<template>
    <form @submit.prevent="filter">
        <div class="mb-8 mt-4 flex flex-wrap gap-2">
            <div class="flex flex-nowrap items-center">
                <input v-model="filterForm.priceFrom" type="text" class="input-filter-l w-28"  placeholder="Price from" />
                <input v-model="filterForm.priceTo" type="text" class="input-filter-r w-28"  placeholder="Price to"/>
            </div>
            <div class="flex flex-nowrap items-center">
               <select v-model="filterForm.beds" class="input-filter-l w-22">
                 <option :value="null">Beds</option>
                 <option v-for="n in 5" :key="n" :value="n" v-text="n" />
                 <option>6+</option>

               </select>
          
               <select v-model="filterForm.baths" class="input-filter-r w-22">
                 <option :value="null">Baths</option>
                 <option v-for="n in 5" :key="n" :value="n" v-text="n" />
                 <option>6+</option>

               </select>
            </div>

            <div class="flex flex-nowrap items-center">
                <input v-model="filterForm.areaFrom" type="text" class="input-filter-l w-28" placeholder="Area from" />
                <input v-model="filterForm.areaTo"   type="text" class="input-filter-r w-28" placeholder="Area to"/>
            </div>

            <button type="submit" class="btn-normal">Filters</button>
            <button type="reset" @click="clear">Clear</button>

        </div>
        
    </form>
</template>

<script setup> 

import { useForm } from '@inertiajs/vue3';

const props = defineProps( {
    filters: Object
})

console.log('filters props', props.filters);
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