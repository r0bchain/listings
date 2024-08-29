<template>
    <div>
        <ListingSpace class="w-72 h-72 bg-white border border-gray-300 p-4 shadow-md">
            <h2 class="text-xl mb-2"><slot name="header" /></h2>
            <div class="bg-red-500 h-24 mb-2">
                <img src="https://via.placeholder.com/150" alt="Thumbnail" class="w-full h-full object-cover">
            </div>
            <slot />
        </ListingSpace>
    </div>
</template>

<script>
export default {
    props: {
        listing: Object,
        
    }
}
</script>