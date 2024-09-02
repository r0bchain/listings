<!-- component -->
 <template>
    <form @submit.prevent="register">
        <div class="topic-title "> {{  imageUpdated.query  }}</div>
        <div
        
        :style="{ backgroundImage: `url(${imageUpdated.imageUrl})` }"
        class="min-h-screen bg-gray-100 py-6 flex flex-col justify-center sm:py-12">
            <div class="relative py-3 sm:max-w-xl sm:mx-auto">
                <div class="absolute inset-0 bg-gradient-to-r from-blue-300 to-red-600 shadow-lg transform -skew-y-6 sm:skew-y-0 sm:-rotate-6 sm:rounded-3xl">
                </div>
                <div class="relative px-4 py-10 bg-white shadow-lg sm:rounded-3xl sm:p-20">
                    <div class="max-w-md mx-auto">
                        <div>
                            <h1 class="title-form text-center ">{{ page.props.site.APP_REGISTER_TITLE  }} <br/>{{  page.props.site.APP_SLOGAN   }}</h1>
                        </div>
                        <div class="divide-y divide-gray-200">
                            <div class="py-8 text-base leading-6 space-y-4 text-gray-700 sm:text-lg sm:leading-7">
                                <div class="relative">
                                    <input v-model="form.email" autocomplete="off" id="email" name="email" type="text" class="peer placeholder-transparent h-10 w-full border-b-2 border-gray-300 text-gray-900 focus:outline-none focus:borer-rose-600" placeholder="Email address" />
                                    <label for="email" class="absolute left-0 -top-3.5  text-gray-600 text-sm peer-placeholder-shown:text-base peer-placeholder-shown:text-gray-440 peer-placeholder-shown:top-2 transition-all peer-focus:-top-3.5 peer-focus:text-gray-600 peer-focus:text-sm">Email Address</label>
                                    <div v-if="form.errors.email" class="input-error">{{  form.errors.email }}</div>
                                    <div class="absolute inset-y-0 right-0 pl-0  flex items-center  pointer-events-none"> 
                                        <i class="fas fa-envelope text-gray-400"></i> 

                                    </div> 
                                </div>
                                <div class="relative">
                                    <input v-model="form.name" autocomplete="off" id="name" name="name" type="text" class="peer placeholder-transparent h-10 w-full border-b-2 border-gray-300 text-gray-900 focus:outline-none focus:borer-rose-600" placeholder="Your name" />
                                    <label for="name" class="absolute left-0 -top-3.5 text-gray-600 text-sm peer-placeholder-shown:text-base peer-placeholder-shown:text-gray-440 peer-placeholder-shown:top-2 transition-all peer-focus:-top-3.5 peer-focus:text-gray-600 peer-focus:text-sm">Your name</label>
                                    <div v-if="form.errors.email" class="input-error">{{  form.errors.name }}</div>
                                    <div class="absolute inset-y-0 right-0 pl-0  flex items-center  pointer-events-none"> 
                                        <i class="fa-solid fa-user-secret text-gray-400"></i> 

                                    </div> 

                                </div>
                                <div class="relative">
                                    <input v-model="form.password" autocomplete="off" id="password" name="password" type="password" class="peer placeholder-transparent h-10 w-full border-b-2 border-gray-300 text-gray-900 focus:outline-none focus:borer-rose-600" placeholder="Password" />
                                    <label for="password" class="absolute left-0 -top-3.5 text-gray-600 text-sm peer-placeholder-shown:text-base peer-placeholder-shown:text-gray-440 peer-placeholder-shown:top-2 transition-all peer-focus:-top-3.5 peer-focus:text-gray-600 peer-focus:text-sm">Password</label>
                                
                                    <div v-if="form.errors.password" class="input-error">{{  form.errors.password }}</div>
                                    <div class="absolute inset-y-0 right-0 pl-0  flex items-center  pointer-events-none"> 
                                        <i class="fa-solid fa-key text-gray-400"></i>
                                    </div> 

                                </div>
                                <div class="relative">
                                    <input v-model="form.password_confirmation" autocomplete="off" id="password_confirmation" name="password_confirmation" type="password" class="peer placeholder-transparent h-10 w-full border-b-2 border-gray-300 text-gray-900 focus:outline-none focus:borer-rose-600" placeholder="Password" />
                                    <label for="password_confirmation" class="absolute left-0 -top-3.5 text-gray-600 text-sm peer-placeholder-shown:text-base peer-placeholder-shown:text-gray-440 peer-placeholder-shown:top-2 transition-all peer-focus:-top-3.5 peer-focus:text-gray-600 peer-focus:text-sm">Password confirmation</label>

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

import { useForm, Link, usePage  } from '@inertiajs/vue3'
import { ref} from 'vue'

const page = usePage()
const props = defineProps({
    randomImage: {
        type: Object,
        Required: true
    },
    
})

const imageUpdated = ref(props.randomImage)

const form = useForm({
    name: null,
    email: null,
    password: null,
    password_confirmation: null,
})

const register = () => {
    form.post(route('user-account.store'), {
        onSuccess: () => {
            // Redirect to the dashboard
            //Inertia::visit(route('dashboard'));
        }
    })
}
</script>