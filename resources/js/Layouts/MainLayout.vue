<template>
    <div>
        <nav>
            <Link href="/listing">Listings</Link> &nbsp;
            <Link href="/listing/create">New listing</Link>
        </nav>
        <!-- <div>The page with time {{timer}}</div> -->
        <!-- <div v-if="$page.props.flash.success  " v-text="$page.props.flash.success" class="success" > -->
        <div v-if="flashSuccess" v-text="flashSuccess" class="success" >

        </div>
    </div>

    <slot>Default content </slot>
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

    
    // const timer = ref(0)
    // setInterval(() => timer.value++, 1000)

    defineProps({ message: String })

</script>

<style scoped>
    .success {
        background-color: lightgreen;
        padding: 10px;
        margin: 10px 0;
    }
</style>