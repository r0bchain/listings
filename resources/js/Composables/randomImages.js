
import {computed, ref} from 'vue'
import { createClient } from 'pexels';

export const randomImages = (initialImageUrl, api_key, words, options) => {
    const imageUrl = ref(initialImageUrl);
    const location = ref(words[Math.floor(Math.random() * words.length)])
    const randomImage = computed(() => {

        // console.log('api_key', api_key)
        // console.log('words', typeof words)
        // console.log('options', options)
    
        const client = createClient(api_key)
        // console.log('words.length', words.length)
        // const location = words[Math.floor(Math.random() * words.length)];
        console.log('location', location);
        client.photos.search({ location, per_page: options.per_page, size: options.size ?? 'small', locale: options.locale ?? 'en-US', orientation: options.orientation ?? 'landscape' })
        .then(photos => {
            imageUrl.value = photos.photos[0].src.landscape ?? imageUrl
            console.log('imageUrl.value', imageUrl.value)

        
        }).catch(err => {
            console.log('error', err)
            imageUrl.value = initialImageUrl
             
        })

        return { imageUrl, location}
    })

  
    return { randomImage, location }


}