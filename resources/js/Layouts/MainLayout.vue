<template>

    <header class="header-container">
        <div class="container mx-auto">
            <nav class="p-4 flex items-center justify-between">
                <div class="text-lg font-medium">
                    <Link :href="route('listing.index')">
                        
                    <img :src="page.props.logo" alt="thai advertisments && listings"  class="logo" />

                    </Link> 
                </div>
              
                <div v-if="user" class="flex items-center gap-4">
                    <Link class="text-gray-500 relative pr-2 py-2 text-lg"
                      :href="route('notification.index')">
                    🔔
                        <div  v-if="notificationCount" class="absolute bell">
                        {{ notificationCount }}
                        </div>
                    </Link>

                    <Link class="link" :href="route('realtor.listing.index')">{{ user.name }}</Link>
                    <Link :href="route('realtor.listing.create')" class="btn-primary">+ New Listing</Link>
                    <div class="text-sm text-gray-500">
                        <Link :href="route('logout')" method="POST" as="button" class="link">Logout</Link>
                        <!-- <Link :href="route('logout')" @click.prevent="$inertia.post(route('logout'))">Logout</Link> -->
                    </div>
                </div>
                <div v-else class="flex items-center gap-2 text-sm text-gray-500 flex ">
                    <Link :href="route('login')" class="link">Sign-In</Link> |
                    <Link :href="route('user-account.create')" class="link">Register</Link>

                </div>

            </nav>
        </div>
    </header>
    <!-- <div>The page with time {{timer}}</div> -->
    <!-- <div v-if="$page.props.flash.success  " v-text="$page.props.flash.success" class="success" > -->
    
    <main class="container">
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