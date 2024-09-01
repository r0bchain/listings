<template>
    <RegisterBox :randomImage="randomImage" :location="randomImage" />
  
</template>

<script setup>
import { useForm, Link, usePage  } from '@inertiajs/vue3'
import { ref} from 'vue'
import RegisterBox from '@/Pages/UserAccount/Components/RegisterBox.vue'
import { randomImages } from '@/Composables/randomImages';

const page = usePage()
const imageUrl = ref('https://images.pexels.com/photos/2956618/pexels-photo-2956618.jpeg?auto=compress&cs=tinysrgb&fit=crop&h=1200&w=800')

const topics = page.props.site.TOPICS_IMAGE

// Fetch the image URL on component mount

const { randomImage, location } = randomImages(
    imageUrl,
    page.props.site.RANDOM_IMAGED_KEY, 
    topics,
    {per_page: 1, size: 'small', locale: 'en-US', orientation: 'landscape' }
)

</script>