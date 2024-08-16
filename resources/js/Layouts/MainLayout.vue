<template>

    <header class="border-b-2 border-gey-600 dark:border-gray-600 bg-white dark:bg-gray-900 w-full">
        <div class="container mx-auto">
            <nav class="p-4 flex items-center justify-between">
                <div class="text-lg font-medium">
                    <Link :href="route('listing.index')">Listings</Link> &nbsp;
                </div>
              
                <div v-if="user" class="flex items-center gap-4">
                    <Link class="text-gray-500 relative pr-2 py-2 text-lg"
                      :ref="route('notification.index')">
                    🔔
                        <div  v-if="notificationCount" class="absolute bell">
                        {{ notificationCount }}
                        </div>
                    </Link>

                    <Link class="text-sm text-gray-500" :href="route('realtor.listing.index')">{{ user.name }}</Link>
                    <Link :href="route('realtor.listing.create')" class="btn-primary">+ New Listing</Link>
                    <div class="text-sm text-gray-500">
                        <Link :href="route('logout')" method="POST" as="button">Logout</Link>
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
        <div v-if="flashError" v-text="flashError" class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert"></div>        

        <slot>Default content </slot>
    </main>
   
</template>


<script setup>
    import { Link, usePage } from '@inertiajs/vue3'
    import { computed } from 'vue'
    
    // Page props 
    const page = usePage()
    
    const flashSuccess = computed(
        () => page.props.flash.success 
    )

    const flashError = computed(
        () => page.props.flash.error 
    )

    const user = computed(() => page.props.user)

    const notificationCount = computed(
        // Take max 9
        () => Math.min(page.props.user.notificationCount, 9),
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