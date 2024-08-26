<template>
    <h1 class="text-3xl mb-4">Your Notifications</h1>

    <section v-if="notifications.data.length" class="text-grey-700 dark:text-grey-600">
        <div v-for="notification in notifications.data" :key="notification.id" 
        class="flex justify-between items-center border-b border-gray-200 dark:border-gray-800 py-4">
            <div>
               
                <span v-if="notification.type == 'App\\Notifications\\OfferMade'">
                    Offer <Price :price="notification.data.amount" /> made on your listing
                    <Link :href="route('realtor.listing.show', { listing: notification.data.listing_id })" 
                        class="text-indigo-600 dark:text-indigo-400">(View listing)
                    </Link> was made
                </span>
            </div>
            <div> 
                <button @click="markAsRead(notification.id)" class="btn-outline text-xs font-medium" >
                    Mark as read
                </button>
            </div>
        </div>
    </section>

    <EmptyState v-else>No notifications yet!</EmptyState>

    <section v-if="notifications.data.length" class="w-full flex justify-center">
        <Pagination :links="notifications.links" />
    </section>
</template>

<script setup>
import { Link } from '@inertiajs/vue3';
import Pagination from '@/Components/UI/Pagination.vue';
import EmptyState from '@/Components/UI/EmptyState.vue';
import Price from '@/Components/Price.vue';

defineProps({
    // Pagination used an object with a data property
    notifications: Object
})

</script>