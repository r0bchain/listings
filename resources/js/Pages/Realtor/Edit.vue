

<template>
  <form @submit.prevent="update">
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
        <p type="text" class="input" v-text="listing.category.name" ></p>
      </div>
    </div>
    <div class="grid grid-cols-6 gap-4">
      <div class="col-span-2">
        <label class="label">Beds</label>
        <input v-model.number="form.beds" type="text" class="input" />

        <ErrorMessage :errorMsg="form.errors.beds" />
     
      </div>

      <div class="col-span-2">
        <label class="label">Baths</label>
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
        <label class="label">Post Code</label>
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
        <button type="submit" class="btn-primary">Update</button>
      </div>
    </div>
  </form>
</template>
  
  <script setup>
  import { useForm } from '@inertiajs/vue3'
  import ErrorMessage from '@/Components/Messages/ErrorMessage.vue'

  const props = defineProps({
    listing: Object
  })

  const form = useForm({
    title: props.listing.title || '',
    description: props.listing.description  || '',
    beds: props.listing.beds,
    baths: props.listing.baths,
    area: props.listing.area,
    city: props.listing.city,
    street: props.listing.street,
    code: props.listing.code,
    street_nr: props.listing.street_nr,
    price: props.listing.price,
  })
  const update = () => form.put(route('realtor.listing.update', {listing: props.listing.slug}))
  </script>
  
  <style scoped>
  label {
    margin-right: 2em;
  }
  
  div {
    padding: 2px
  }
  </style>