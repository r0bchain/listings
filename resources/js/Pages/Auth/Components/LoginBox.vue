<!-- component -->
 <template>
    <form @submit.prevent="login">
        <div class="topic-title" v-text="topic"></div> 

        <div 
        :style="{ backgroundImage: `url(${randomImage})` }"
         class="min-h-screen bg-gray-100 py-6 flex flex-col justify-center sm:py-12">

            <div class="relative py-3 sm:max-w-xl sm:mx-auto">
                
                <div class="absolute text-gray-600 inset-0 bg-gradient-to-r from-blue-300 to-red-600 shadow-lg transform -skew-y-6 sm:skew-y-0 sm:-rotate-6 sm:rounded-3xl">
                </div>

                <div class="relative px-4 py-10 bg-white shadow-lg sm:rounded-3xl sm:p-20">
                    <div class="max-w-md mx-auto">
                        
                        
                        <div>
                            <h1 class="title-form">Login</h1>
                        </div>
                        <div class="divide-y divide-gray-200">
                            <div class="py-8 text-base leading-6 space-y-4 text-gray-700 sm:text-lg sm:leading-7">
                                <div class="relative">
                                    <input v-model="form.email" autocomplete="off" id="email" name="email" type="text" class="peer placeholder-transparent h-10 w-full border-b-2 border-gray-300 text-gray-900 focus:outline-none focus:border-rose-600" placeholder="Email address" />
                                    <label for="email" class="absolute left-0 -top-3.5 text-gray-600 text-sm peer-placeholder-shown:text-base peer-placeholder-shown:text-gray-440 peer-placeholder-shown:top-2 transition-all peer-focus:-top-3.5 peer-focus:text-gray-600 peer-focus:text-sm">Email Address</label>
                                    <div v-if="form.errors.email" class="input-error">{{  form.errors.email }}</div>

                                </div>
                                <div class="relative">
                                    <input v-model="form.password" autocomplete="off" id="password" name="password" type="password" class="peer placeholder-transparent h-10 w-full border-b-2 border-gray-300 text-gray-900 focus:outline-none focus:borer-rose-600" placeholder="Password" />
                                    <label for="password" class="absolute left-0 -top-3.5 text-gray-600 text-sm peer-placeholder-shown:text-base peer-placeholder-shown:text-gray-440 peer-placeholder-shown:top-2 transition-all peer-focus:-top-3.5 peer-focus:text-gray-600 peer-focus:text-sm">Password</label>
                                    <div v-if="form.errors.password" class="input-error">{{  form.errors.password }}</div>

                                </div>
                                <div class="relative">
                                    <button class="bg-blue-500 text-white rounded-md px-2 py-1">Submit</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
     </form>
 </template>

 <script setup>
import { useForm } from '@inertiajs/vue3'
import {ref} from 'vue'

const form = useForm({
    email: 'test@example.com',
    password: ''
})


const login = () => {
    form.post(route('login'))
}

const props = defineProps({
    randomImage: {
        type: String,
        Required: true
    },

    topic: {
        type: String,
        Required: false
      
    }
})

// const imageUpdated = ref(props.randomImage)
// console.log('imageUpdated', props.randomImage)

</script>
