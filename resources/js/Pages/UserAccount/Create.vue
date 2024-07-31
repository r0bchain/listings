<template>
    <form @submit.prevent="register">
        <div class="w-1/2 mx-auto">
            <div class="mt-4">
                <label for="name" class="label">Name</label>
                <input id="name" v-model="form.name" type="text" class="input"/>
                <div v-if="form.errors.name" class="input-error">{{  form.errors.name }}</div>

            </div>
            <div class="mt-4">
                <label for="email" class="label">E-mail (username)</label>
                <input id="email" v-model="form.email" type="text" class="input"/>
                <div v-if="form.errors.email" class="input-error">{{  form.errors.email }}</div>

            </div>
            <div v-if="form.errors.email" class="input-error">{{  form.errors.email }}</div>
            <div class="mt-4">
                <label for="password" class="label">Password</label>
                <input id="password" v-model="form.password" type="password" class="input mt-2" />
                <div v-if="form.errors.password" class="input-error">{{  form.errors.password }}</div>

            </div>    
            <div class="mt-4">
                <label for="password_confirmation" class="label">Password confirmation</label>
                <input id="password_confirmation" v-model="form.password_confirmation" type="password" class="input mt-2" />

            </div>         
            <div class="mt-4">
                <button type="submit" class="btn-primary w-full">Create</button>
            </div>

        </div>
    </form>
</template>

<script setup>
import { useForm } from '@inertiajs/vue3'

// userForm will catch all the validation errors coming from the backend
// form.erros.email, form.errors.password ...

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