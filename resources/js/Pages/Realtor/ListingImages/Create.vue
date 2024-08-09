<template>
    <Box>
        <template #header>Upload images</template>
        <form method="POST" @submit.prevent="upload" 
        :action="route('realtor.listing.image.store', { listing: listing.id})">  
        <section class="flex items-center gap-2 my-4">
            <input class="input-file" type="file" multiple @input="addFiles" />
            <button type="submit" class="btn-outline disabled:opacity-25 disabled:cursor-not-allowed" :disabled="!canUpload">Upload</button>
            <button type="reset" class="btn-outline" @click="reset">Reset</button>
        </section>
        </form>
    </Box>
</template>

<script setup>
import Box from '@/Components/UI/Box.vue';
import { useForm } from '@inertiajs/vue3';
import { computed } from 'vue';
import { Inertia } from '@inertiajs/inertia';
import NProgress from 'nprogress';

const props = defineProps({ listing: Object })

// We limit the progress here to 90%, since we still need to wait for a response from the server.
// @dev: https://inertiajs.com/progress-indicators

Inertia.on('progress', (event) => {
    if (event.detail.progress.percentage) {
        console.log('event.detail.progress.percentage ', event.detail.progress.percentage )
        NProgress.set(event.detail.progress.percentage / 100 * 0.9)
    } 
})

const canUpload = computed(() => {
    return form.images.length > 0
})

const form = useForm({
    images: []
})

const upload = () => {
    form.post(route('realtor.listing.image.store', { listing: props.listing.id }), {
        onSuccess: () => {
            form.reset(...form.data)
            console.log('success')
        }
    })
}

const addFiles = (e) => {
    form.images = e.target.files

    // for(const image of e.target.files) {
    //     form.images.push(image)
    // }
}

const reset = () => {
    form.reset()
}

// Note:
/*
* The form does not need the POST method neither the enctype="multipart/form-data" 
* the name attribute is also not needed, Inertia will handle the upload using AXIOS.
*/
</script>