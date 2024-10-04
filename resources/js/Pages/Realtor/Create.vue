<template>
  <JobListener />
  <form @submit.prevent="create">
    <div class="grid grid-cols-6 gap-2">
      <div class="col-span-2">
        <label class="label">Title</label>
        <input v-model.number="form.title" type="text" class="input" />
        <ErrorMessage :errorMsg="form.errors.title" />

      </div>
      <div class="col-span-2">
        <label class="label">Description</label>
        <textarea v-model.number="form.description" class="input" />
        <ErrorMessage :errorMsg="form.errors.description" />

      </div>
      <div class="col-span-2">
        <label class="label">Category</label>
        <select name="category_id" v-model="form.category_id" class="input" required>
          <option  v-for="category in categories" :value="category.id">{{ category.name }}</option>
       
        </select>
        <ErrorMessage :errorMsg="form.errors.category_id" />

      </div>
    </div>
    <div class="grid grid-cols-6 gap-4">
      <div class="col-span-2">
        <label class="label">Beds</label>
        <input v-model.number="form.beds" type="text" class="input" />
        <ErrorMessage :errorMsg="form.errors.beds" />

      </div>

      <div class="col-span-2">
        <label class="label">Baths1</label>
        <input v-model.number="form.baths" type="text" class="input" />
        
        <ErrorMessage :errorMsg="form.errors.baths" />

      </div>

      <div class="col-span-2">
        <label class="label">Area</label>
        <input v-model.number="form.area" type="text" class="input" />
       
        <ErrorMessage :errorMsg="form.errors.area" />

      </div>

      <div class="col-span-4">
        <label class="label">City</label>
        <input v-model="form.city" type="text" class="input" />
        
        <ErrorMessage :errorMsg="form.errors.city" />

      </div>

      <div class="col-span-2">
        <label class="label">Post Code 1</label>
        <input v-model="form.code" type="text" class="input" />
        <ErrorMessage :errorMsg="form.errors.code" />

      </div>

      <div class="col-span-4">
        <label class="label">Street</label>
        <input v-model="form.street" type="text" class="input" />
        <ErrorMessage :errorMsg="form.errors.street" />

      </div>

      <div class="col-span-2">
        <label class="label">Street Nr</label>
        <input v-model.number="form.street_nr" type="text" class="input" />
        <ErrorMessage :errorMsg="form.errors.street_nr" />

      </div>

      <div class="col-span-6">
        <label class="label">Price</label>
        <input v-model.number="form.price" type="text" class="input" />
        <ErrorMessage :errorMsg="form.errors.price" />

      </div>

      <div class="col-span-6 text-center">
        <button type="submit" class="btn-primary">Create</button>
      </div>
    </div>
  </form>
</template>

<script setup>
import { useForm } from '@inertiajs/vue3'
import ErrorMessage from '@/Components/Messages/ErrorMessage.vue'
import JobListener from '@/Components/JobListener.vue';
const props = defineProps({
    categories: Array,
})

const form = useForm({
  title: null,
  description: null,
  category_id: 1,
  beds: 0,
  baths: 0,
  area: 0,
  city: null,
  street: null,
  code: null,
  street_nr: null,
  price: 0,
})
const create = () => form.post(route('realtor.listing.store'))
</script>

<style scoped>
label {
  margin-right: 2em;
}

div {
  padding: 2px
}
</style>

