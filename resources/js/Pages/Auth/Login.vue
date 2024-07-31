<template>
    <form @submit.prevent="login">
        <div class="w-1/2 mx-auto">
            <div class="mt-4">
                <label for="email" class="label">E-mail (username)</label>
                <input v-model="form.email" type="text" class="input"/>
            </div>
            <div v-if="form.errors.email" class="input-error">{{  form.errors.email }}</div>
            <div class="mt-4">
                <label for="password" class="label">Password</label>
                <input v-model="form.password" type="password" class="input mt-2" />
                <div v-if="form.errors.password" class="input-error">{{  form.errors.password }}</div>

            </div>            
            <div class="mt-4">
                <button type="submit" class="btn-primary w-full">Login</button>
            </div>

        </div>
    </form>
</template>

<script setup>
import { useForm } from '@inertiajs/vue3'

// userForm will catch all the validation errors coming from the backend
// form.erros.email, form.errors.password ...

const form = useForm({
    email: '',
    password: ''
})

const login = () => {
    form.post(route('login'))
}
</script>