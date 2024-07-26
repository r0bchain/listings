<template>

    <header class="border-b-2 border-gey-600 dark:border-gray-600 bg-white dark:bg-gray-900 w-full">
        <div class="container mx-auto">
            <nav class="p-4 flex items-center justify-between">
                <div class="text-lg font-medium">
                    <Link :href="route('listing.index')">Listings</Link> &nbsp;
                </div>
                <div class="text-xl text-indigo-600 dark:text-indigo-300">        
                    <Link :href="route('listing.index')">Crytpo Bazar</Link>
                </div>
                <div class="dark:text-indigo-300 bg-indigo-600 hover:bg-indigo:500 text-white font-medium p-2 rounded-md">        
                    <Link :href="route('listing.create')" class="btn-primary">+ New Listing</Link>
                </div>

            </nav>
        </div>
    </header>
    <!-- <div>The page with time {{timer}}</div> -->
    <!-- <div v-if="$page.props.flash.success  " v-text="$page.props.flash.success" class="success" > -->
    
    <main class="container mx-auto p-4">
        <div v-if="flashSuccess" v-text="flashSuccess" class="mb-4 border rounded-md shadow-sm border-green-200 dark:border-green-800 bg-green-50 dark:bg-green-900 p-2"></div>        
        <slot>Default content </slot>
    </main>
</template>


<script setup>
    import { Link, usePage } from '@inertiajs/vue3'
    import { computed } from 'vue'
    import DarkModeSwitcher from '@/Components/Buttons/DarkModeSwitcher.vue'
    
    // Page props 
    const page = usePage()
    console.log('success', page.props.flash)
    const flashSuccess = computed(
        () => page.props.flash.success 
    )

    defineProps({ message: String })

</script>

<style scoped>
    .success {
        background-color: lightgreen;
        padding: 10px;
        margin: 10px 0;
    }
</style>