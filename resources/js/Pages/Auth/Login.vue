<template>
    <div><LoginBox :randomImage="randomImage.imageUrl" :location="location"/></div>

</template>

<script setup>
import { Link, usePage } from '@inertiajs/vue3'
import LoginBox from '@/Pages/Auth/Components/LoginBox.vue';
import {ref} from 'vue'
import { randomImages } from '@/Composables/randomImages';

const page = usePage()
const imageUrl = ref('https://images.pexels.com/photos/2956618/pexels-photo-2956618.jpeg?auto=compress&cs=tinysrgb&fit=crop&h=1200&w=800')

const topics = ['Beach thailand', 'Buddha Thailand', 'Hua-Hin', 'Bangkok', 'Ayutaya', 'Phuket', 'Krabi', 'Chiang Mai', 'Pattaya', 'Koh Samui', 'Koh Phi Phi', 'Koh Lanta', 'Koh Tao', 'Koh Chang', 'Koh Phangan', 'Koh Maak', 'Koh Lipe']

// Fetch the image URL on component mount

const { randomImage, location } = randomImages(
    imageUrl,
    page.props.site.RANDOM_IMAGED_KEY, 
    topics,
    {per_page: 1, size: 'small', locale: 'en-US', orientation: 'landscape' }
)
// const randomImage = 'https://images.pexels.com/photos/13419316/pexels-photo-13419316.jpeg?auto=compress&cs=tinysrgb&fit=crop&h=627&w=1200';

console.log('randomImage',  randomImage)

</script>