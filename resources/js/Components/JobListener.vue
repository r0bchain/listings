<template>
  <div>
	<!-- Your component template -->
  </div>
</template>

<script>
import { onMounted } from 'vue';
import { usePage } from '@inertiajs/vue3'
import Echo from 'laravel-echo';
import Pusher from 'pusher-js';

export default {
  setup() {
	const { reload } = usePage();

	onMounted(() => {

        console.log('JobListener component mounted');

        window.Pusher = Pusher;

	  window.Echo = new Echo({
		broadcaster: 'pusher',
		key: import.meta.env.VITE_PUSHER_APP_KEY,
		cluster: import.meta.env.VITE_PUSHER_APP_CLUSTER,
		encrypted: true,
	  });

      console.log('Echo instance initialized');


	  window.Echo.channel('job-pinned-finished')
		.listen('JobPinnedFinished', (e) => {
		  console.log('Job pinned finished for listing ID:', e.listingId);
		  // Refresh the page
		  reload();
		});
	});

	return {};
  },
};
</script>

<style scoped>
/* Your component styles */
</style>