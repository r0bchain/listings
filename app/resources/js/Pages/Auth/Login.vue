<template>
    <div><LoginBox :randomImage="randomImage"/></div>

</template>

<script setup>
import { Link, usePage } from '@inertiajs/vue3'
import LoginBox from '@/Pages/Auth/Components/LoginBox.vue';
import {ref} from 'vue'
import { randomImages } from '@/Composables/randomImages';

const page = usePage()
const imageUrl = ref('https://images.pexels.com/photos/2956618/pexels-photo-2956618.jpeg?auto=compress&cs=tinysrgb&fit=crop&h=1200&w=800')

const topics = page.props.site.TOPICS_IMAGE
// Fetch the image URL on component mount
const { randomImage, location } = randomImages(
    imageUrl,
    page.props.site.RANDOM_IMAGE_KEY, 
    topics,
    {per_page: 1, size: 'small', locale: 'en-US', orientation: 'landscape' }
)


</script>