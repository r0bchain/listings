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

                <div v-if="user" class="flex items-center gap-4">
                    <div class="text-sm text-gray-500">{{ user.name }}</div>
                    <Link :href="route('listing.create')" class="btn-primary">+ New Listing</Link>
                    <div class="text-sm text-gray-500">
                        <Link :href="route('logout')" method="DELETE" as="button">Logout</Link>
                        <!-- <Link :href="route('logout')" @click.prevent="$inertia.post(route('logout'))">Logout</Link> -->
                    </div>
                </div>
                <div v-else class="flex items-center gap-2 text-sm text-gray-500 flex ">
                    <Link :href="route('login')">Sign-In</Link> |
                    <Link :href="route('user-account.create')">Register</Link>

                </div>

            </nav>
        </div>
    </header>
    <!-- <div>The page with time {{timer}}</div> -->
    <!-- <div v-if="$page.props.flash.success  " v-text="$page.props.flash.success" class="success" > -->
    
    <main class="container mx-auto p-4 w-full">
        <div v-if="flashSuccess" v-text="flashSuccess" class="mb-4 border rounded-md shadow-sm border-green-200 dark:border-green-800 bg-green-50 dark:bg-green-900 p-2"></div>        
        <slot>Default content </slot>
    </main>
</template>


<script setup>
    import { Link, usePage } from '@inertiajs/vue3'
    import { computed } from 'vue'
    
    // Page props 
    const page = usePage()
    console.log('success', page.props.flash)
    const flashSuccess = computed(
        () => page.props.flash.success 
    )

    const user = computed(() => page.props.user)

    defineProps({ message: String })

</script>

<style scoped>
    .success {
        background-color: lightgreen;
        padding: 10px;
        margin: 10px 0;
    }
</style>