<template>
    <RegisterBox :randomImage="topicImage" :topic="topic" />
  
</template>

<script setup>
import { usePage  } from '@inertiajs/vue3'
import {ref, onMounted} from 'vue'
import RegisterBox from '@/Pages/UserAccount/Components/RegisterBox.vue'
import { searchIPFSImage } from '@/Composables/searchIPFSImage';

const page = usePage()

const props = defineProps({ listing: Object })
const topicImage = ref(null)

// Get a random topic
const topic = ref(page.props.site.TOPICS_IMAGE[Math.floor(Math.random() * page.props.site.TOPICS_IMAGE.length)])


// Fetch the image URL on component mount

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