<template>
    <div><LoginBox :randomImage="topicImage" :topic="topic"/></div>

</template>

<script setup>
import { usePage } from '@inertiajs/vue3'
import LoginBox from '@/Pages/Auth/Components/LoginBox.vue';
import {ref, onMounted} from 'vue'
import { randomImages } from '@/Composables/randomImages';
import { searchIPFSImage } from '@/Composables/searchIPFSImage'

const page = usePage()
const imageUrl = ref('https://images.pexels.com/photos/2956618/pexels-photo-2956618.jpeg?auto=compress&cs=tinysrgb&fit=crop&h=1200&w=800')
const topicImage = ref(null)

const topics = page.props.site.TOPICS_IMAGE

// Get a random topic
const topic = ref(page.props.site.TOPICS_IMAGE[Math.floor(Math.random() * page.props.site.TOPICS_IMAGE.length)])


// Fetch the image URL on component mount
const { randomImage, location } = randomImages(
    imageUrl,
    page.props.site.RANDOM_IMAGE_KEY, 
    topics,
    {per_page: 1, size: 'small', locale: 'en-US', orientation: 'landscape' }
)

onMounted(async () => {
    try {
        const result = await searchIPFSImage(topic.value.trim(), page.props.config.PINATA_SECRET_JWT, page.props.config.PINATA_GATEWAY);
        console.log('result', result);
        topicImage.value = result;
    } catch (error) {
        console.log('error', error);
    }
});

</script>