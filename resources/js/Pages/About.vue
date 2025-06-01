<script setup>
import { Head } from '@inertiajs/vue3';

import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';

const features = [
    {
        icon: 'square-check', text: 'Create, edit, and delete tasks effortlessly'
    },
    {
        icon: 'calendar-plus', text: 'Set due dates and track deadlines'
    },
    {
        icon: 'rotate', text: 'Clean and responsive design that supports mobile'
    },
    {
        icon: 'lock', text: 'Authentication and user-specific task lists'
    }
]

const techs = [
    {
        icon: 'laravel', style: 'fa-brands', headline: 'Laravel', text: 'Powerful PHP framework for building robust APIs and backend logic'
    },
    {
        icon: 'link', style: 'fa-solid', headline: 'Inertia.js', text: 'Bridges the gap between Laravel and Vue.js without the complexity of a full SPA'
    },
    {
        icon: 'vuejs', style: 'fa-brands', headline: 'Vue.js', text: 'Modern frontend framework for reactive, component-based interfaces'
    },
    {
        icon: 'wind', style: 'fa-solid', headline: 'Tailwind CSS', text: 'Utility-first CSS framework for rapid UI development'
    },
    {
        icon: 'lock', style: 'fa-solid', headline: 'Laravel Breeze', text: 'Lightweight starter kit for authentication'
    }
]

const purposes = [
    { text: 'Practice full-stack development using Inertia.js' },
    { text: 'Understand how to structure CRUD operations across Laravel and Vue '},
    { text: 'Learn how to build dynamic, reactive UIs while keeping backend logic clean and testable '}
]

</script>

<template>
    <Head title="About" />

    <AuthenticatedLayout>
        <main class="pt-28 pb-10 px-10 md:pt-28 md:px-20 min-h-screen w-full">
            <div class="flex justify-between items-center my-6">
                <h1 class="text-2xl lg:text-3xl font-bold flex justify-center items-center">About</h1>
            </div>

            <section class="flex flex-col gap-10" >
                <section class="bg-[#121212] p-10 rounded-lg">
                    <p class="text-lg"><strong>Task Manager</strong> is a simple yet powerful productivity app designed to help you stay organized and get things done. Built with <strong>Laravel</strong>, <strong>Vue.js</strong>, and <strong>Inertia.js</strong>, this application demonstrates how modern web technologies can be used to create a seamless single-page application (SPA) experience — without giving up the robustness of a traditional backend.</p>
                </section>

                <section>
                    <h1 class="text-2xl lg:text-3xl font-bold my-6">Key Features</h1>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                        <div v-for="(feature, index) in features" :key="index" class="bg-[#121212] p-10 rounded-lg">
                            <i :class="`fa-solid fa-${feature.icon}`" class="text-6xl"></i>
                            <p class="my-6">{{ feature.text }}</p>
                        </div>
                    </div>
                </section>

                <section>
                    <h1 class="text-2xl lg:text-3xl font-bold my-6">Tech Stack</h1>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                        <div v-for="(tech, index) in techs" :key="index" class="bg-[#121212] p-10 rounded-lg">
                            <i :class="`${tech.style} fa-${tech.icon} text-6xl`"></i>
                            <div class="my-6">   
                                <p class="text-2xl font-bold text-[#1DB954] mb-2">{{ tech.headline }}</p>
                                <p class="text-sm">{{ tech.text }}</p>
                            </div>
                        </div>
                    </div>
                </section>

                <section>
                    <h1 class="text-2xl lg:text-3xl font-bold my-6">Purpose</h1>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                        <div v-for="(purpose, index) in purposes" :key="index" class="bg-[#121212] p-10 rounded-lg">
                            <p>{{ purpose.text }}</p>
                        </div>
                    </div>
                </section>
            </section>
        </main>
    </AuthenticatedLayout>
</template>
