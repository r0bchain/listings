<template>
    <form method="POST" 
    enctype="multipart/form-data"
    :action="route('realtor.listing.image.store', { listing: listing.id})">  
        <input 
        type="file" 
        multiple
        name="images[]" 
      
        />
        <button type="submit">Send</button>

    </form>
</template>

<script setup>
    defineProps({ listing: Object })
</script>