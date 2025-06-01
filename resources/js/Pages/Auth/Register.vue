<script setup>
import { Link, useForm } from '@inertiajs/vue3';
import { watch } from 'vue';

import AuthenticationLayout from '@/Layouts/AuthenticationLayout.vue';

const form = useForm({
    name: '',
    email: '',
    password: '',
    password_confirmation: '',
})

const submit = () => {
    form.post(route('register'), {
        onFinish: () => form.reset('password', 'password_confirmation'),
    });
}

watch(() => form.errors, (errors) => {
    if (Object.keys(errors).length > 0) {
        setTimeout(() => {
            form.clearErrors()
        }, 5000)
    }
})
</script>

<template>
    <AuthenticationLayout>
        <main class="flex flex-col w-96 lg:w-[30vw] h-auto p-10 rounded items-center bg-[#171717]">
            <div class="flex flex-col gap-5">
                <div class="flex justify-center">
                    <img :src="'/Images/applayer.png'" alt="Logo" class="invert w-10 h-10">
                </div>
                <div class="text-center">
                    <p class="font-semibold text-lg md:text-2xl">Create Account</p>
                    <p class="text-xs">Sign Up now to create and manage your task.</p>
                </div>

                <div class="my-5 w-full">
                    <form @submit.prevent="submit">
                        <div class="flex gap-2">
                            <div class="flex flex-col mb-3">
                                <label class="text-sm font-semibold md:text-base" for="name">Name</label>
                                <input v-model="form.name" id="name" name="name" class="text-xs w-full rounded p-3 bg-[#121212] border border-transparent focus:outline-none focus:border-[#1DB954] focus:ring-[#1DB954] focus:ring-1 caret-[#1DB954]" type="text" placeholder="John Doe">
                                <span v-if="form.errors.name" class="text-red-500 text-[0.6em]">{{ form.errors.name }}</span>
                            </div>

                            <div class="flex flex-col mb-3">
                                <label class="text-sm font-semibold md:text-base" for="email">Email</label>
                                <input v-model="form.email" id="email" name="email" class="text-xs  w-full rounded p-3 bg-[#121212] border border-transparent focus:outline-none focus:border-[#1DB954] focus:ring-[#1DB954] focus:ring-1 caret-[#1DB954]" type="email" placeholder="johndoe@gmail.com">
                                <span v-if="form.errors.email" class="text-red-500 text-[0.6em]">{{ form.errors.email }}</span>
                            </div>
                        </div>
                        
                        <div class="mb-3">
                            <label class="text-sm font-semibold md:text-base" for="password">Password</label>
                            <input v-model="form.password" id="password" name="password" class="text-xs  w-full rounded p-3 bg-[#121212] border border-transparent focus:outline-none focus:border-[#1DB954] focus:ring-[#1DB954] focus:ring-1 caret-[#1DB954]" type="password" placeholder="Password">
                        </div>

                        <div class="mb-3 flex flex-col">
                            <label class="text-sm font-semibold block md:text-base" for="password_confirmation">Confirm Password</label>
                            <input v-model="form.password_confirmation" id="password_confirmation" name="password_confirmation" class="text-xs w-full rounded p-3 bg-[#121212] border border-transparent focus:outline-none focus:border-[#1DB954] focus:ring-[#1DB954] focus:ring-1 caret-[#1DB954]"type="password" placeholder="Confirm Password">
                            <span v-if="form.errors.password" class="text-red-500 text-[0.6em] m-0">{{ form.errors.password }}</span>
                            <span v-if="form.errors.password_confirmation" class="text-red-500 text-[0.6em] m-0">{{ form.errors.password_confirmation }}</span>
                        </div>

                        <button type="submit" class="text-sm md:base mt-5 p-3 w-full rounded bg-[#1DB954] hover:bg-[#169c45] transition-colors text-black font-bold" :disabled="form.processing">Sign Up</button>
                    </form>
                </div>
            </div>
            <div class="text-center">
                <p class="text-xs md:text-sm">Dont have an account yet? <Link class="hover:underline text-[#1DB954]" href="/login">Login</Link></p>
            </div>
        </main>
    </AuthenticationLayout>
</template>