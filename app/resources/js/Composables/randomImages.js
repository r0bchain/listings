
import {computed, ref} from 'vue'
import { createClient } from 'pexels';

export const randomImages = (initialImageUrl, api_key, words, options) => {
    const imageUrl = ref(initialImageUrl);
    // const location = ref(words[Math.floor(Math.random() * words.length)])

    const randomImage = computed(() => {
        const location = ref(words[Math.floor(Math.random() * words.length)])

        const query = location.value;
        console.log('query', query)

        const client = createClient(api_key)
        // console.log('words.length', words.length)
        // const location = words[Math.floor(Math.random() * words.length)];
        client.photos.search({query, per_page: options.per_page, size: options.size ?? 'small', locale: options.locale ?? 'en-US', orientation: options.orientation ?? 'landscape' })
        .then(photos => {
            console.log('photos', photos.photos.length)
            const totalImages = photos.photos.length
            // Get different image each time
            const index = Math.floor(Math.random() * totalImages)
            imageUrl.value = photos.photos[index].src.landscape ?? imageUrl
            console.log('query', query)
            console.log('imageUrl.value', imageUrl.value)

        
        }).catch(err => {
            console.log('error', err)
            imageUrl.value = initialImageUrl
             
        })

        return { imageUrl, query}
    })

    return { randomImage, location }

}