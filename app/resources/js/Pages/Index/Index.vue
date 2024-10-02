<template>

    <div>Index</div>
    <div>The message is {{  message }}</div>

</template>

<script setup>
    import { Link } from '@inertiajs/vue3'
    import MainLayout from '@/Layouts/MainLayout.vue';
    defineProps({ message: String })
    // defineProps(['message'])

</script>

<!-- Added to app.js by default -->
<!-- <script>

import MainLayout from '../../Layouts/MainLayout.vue';
export default {
    layout: MainLayout   
}

</script> -->
