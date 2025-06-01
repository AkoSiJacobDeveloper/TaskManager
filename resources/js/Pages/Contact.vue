<script setup>
import { Head, Link, useForm, usePage } from '@inertiajs/vue3';
import { ref } from 'vue';

import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';

const page = usePage();
const success = ref(page.props.flash.success);

const form = useForm({
    purpose: '',
    name: '',
    email: '',
    message: '',
})

const socials = [
    { name: 'Facebook', icon: 'fab fa-facebook', url: 'https://www.facebook.com/pauljacob.tocmo' },
    { name: 'Twitter', icon: 'fab fa-twitter', url: 'https://x.com/Jacob_tocs?t=deGyVJ8lQqxuS3WW5z5B_A&s=09' },
    { name: 'Instagram', icon: 'fab fa-instagram', url: 'https://www.instagram.com/paaul_jcb/' },
] 
</script>

<template>
    <Head title="Contact Us" />

    <AuthenticatedLayout>
        <main class="pt-28 pb-10 px-10 md:pt-28 md:px-20 min-h-screen w-full">
            <div class="flex justify-between items-center my-6">
                <h1 class="text-2xl lg:text-3xl font-bold flex justify-center items-center">Contact</h1>
            </div>

            <section class="flex justify-center w-auto">
                <div class="flex flex-col bg-[#121212] rounded-lg">
                    <div class="p-10 flex justify-center items-center flex-col gap-5">
                        <img :src="'/Images/applayer.png'" alt="AppLayer" class="invert h-8 w-8 md:w-12 md:h-12">
                        <div class="text-center">
                            <h1 class="text-lg md:text-3xl font-bold">Contact Me</h1>
                            <p class="text-xs md:text-sm">Got a question? I'd love to hear from you. Send me a message and I'll respond as soon as possible.</p>
                        </div>
                    </div>

                    <form @submit.prevent="submit">
                        <div class="p-10 flex flex-col">
                            <label class="mb-2 font-semibold text-sm md:text-base" for="purpose">What can i help you with?</label>
                            <input v-model="form.purpose" id="name" name="name" class="text-xs mb-3 w-full rounded p-3 md:p-4 bg-[#121212] border focus:outline-none focus:border-[#1DB954] focus:ring-[#1DB954] focus:ring-1 caret-[#1DB954]" type="name" placeholder="Design">

                            <label class="font-semibold text-sm md:text-base" for="name">Full Name</label>
                            <input v-model="form.name" id="name" name="name" class="text-xs mb-3 w-full rounded p-3 md:p-4 bg-[#121212] border focus:outline-none focus:border-[#1DB954] focus:ring-[#1DB954] focus:ring-1 caret-[#1DB954]" type="name" placeholder="John Doe">

                            <label class="font-semibold text-sm md:text-base" for="email">Email</label>
                            <input v-model="form.email" id="email" name="email" class="text-xs mb-3 w-full rounded p-3 md:p-4 bg-[#121212] border focus:outline-none focus:border-[#1DB954] focus:ring-[#1DB954] focus:ring-1 caret-[#1DB954]" type="email" placeholder="johndoe@gmail.com">
                            <span v-if="form.errors.email" class="text-red-500 text-[0.6em]">{{ form.errors.email }}</span>

                            <label class="font-semibold text-sm md:text-base" for="email">Message</label>
                            <textarea v-model="form.message" placeholder="Message" class="h-32 text-xs mb-3 w-full rounded p-3 md:p-4 bg-[#121212] border focus:outline-none focus:border-[#1DB954] focus:ring-[#1DB954] focus:ring-1 caret-[#1DB954]"></textarea>

                            <div class="flex justify-end">
                                <button class="bg-[#1DB954] p-2 md:p-3 rounded w-24 text-sm md:text-base">Send</button>
                            </div>
                        </div>
                    </form>
                    <div class="flex px-10  gap-2">
                        <hr class="border-white w-full mt-3"><p class="text-sm">Or</p><hr class="border-white w-full mt-3">
                    </div>
                    <div class="p-10 flex gap-2 justify-center">
                        <div class="flex gap-2">
                            <a v-for="(social, index) in socials" :key="index" :href="social.url" target="_blank" rel="noopener noreferrer" class="flex p-1 md:p-3 gap-2 w-full rounded border hover:bg-[#1DB954] hover:border-0">
                                <i :class="social.icon" class="text-sm"></i>
                                <p class="text-sm">{{ social.name }}</p>
                            </a>
                        </div>
                    </div>
                </div>
            </section>
        </main>
    </AuthenticatedLayout>
</template>