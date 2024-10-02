<template>
    <form>
      <div class="mb-4 mt-4 flex flex-wrap gap-4">
        <div class="flex flex-nowrap items-center gap-4">
          <input
            id="deleted"
            v-model="filterForm.deleted"
            type="checkbox" 
            class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500"
          />
          <label for="deleted">Deleted</label>
        </div>
  
        <div>
          <select v-model="filterForm.by" class="input-filter-l w-24">
            <option value="created_at">Added</option>
            <option value="price">Price</option>
          </select>
          <select v-model="filterForm.order" class="input-filter-r w-32">
            <option
              v-for="option in sortOptions" 
              :key="option.value" :value="option.value"
            >
              {{ option.label }}
            </option>
          </select>
        </div>
      </div>
    </form>
  </template>

<script setup>

    import { reactive, watch, computed } from 'vue'
    import { router } from '@inertiajs/vue3'
    import { debounce } from 'lodash';


   // Define props
    const props = defineProps({
        filters: Object,
    });


    const filterForm = reactive({
        by: props.filters.by ?? 'created_at',
        order: props.filters.order ?? 'desc',
        deleted: props.filters.deleted ?? false,


    });

    // Check changes in the deleted property
    watch(() => props.filters.deleted , (newValue) => {
        filterForm.deleted = newValue;
        console.log('isChecked', filterForm.deleted);
    });


    const sortLabels = {
        created_at: [
            {
            label: 'Latest',
            value: 'desc',
            },
            {
            label: 'Oldest',
            value: 'asc',
            },
        ],
        price: [
            {
            label: 'Pricey',
            value: 'desc',
            },
            {
            label: 'Cheapest',
            value: 'asc',
            },
        ],
    }

    const sortOptions = computed(() => sortLabels[filterForm.by])


    // reactive / ref / computed // only watched for changes in the deleted property
    // 1 second delay to avoid multiple backend queries
    watch( filterForm, debounce(() => {
        // console.log('deleted', props.filters.deleted);
        router.get(
            route('realtor.listing.index'),
            filterForm,
            {preserveState: true, preserveScroll: true},
            )
        }
    ));
 


 </script>

 