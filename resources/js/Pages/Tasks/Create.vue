<script setup>
import { ref } from 'vue';
import { useForm } from '@inertiajs/vue3';

const form = useForm({
    title: '',
    description: '',
    due_date: '',
    status: 'Pending', // Default status
})

// Get today's date in YYYY-MM-DD format
const today = new Date().toISOString().split('T')[0];

function submit() {
    form.post('/tasks')
}

import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
</script>

<template>
    <AuthenticatedLayout>
        <main class="relative pt-28 pb-10 px-10 md:pt-28 md:px-20">
            <h1 class="text-2xl lg:text-3xl my-6 font-bold">Create Task</h1>
            <section>
                <form @submit.prevent="submit">
                    <div class="flex flex-col gap-4">
                        <div class="flex flex-col">
                            <label class="mb-2 font-semibold text-sm md:text-base" for="title">Title</label>
                            <input v-model="form.title" type="text" id="title" name="title" placeholder="Title" class="text-sm md:text-base bg-[#121212] p-3 rounded border-0 outline-none focus:outline focus:outline-2 focus:outline-[#1DB954] focus:ring-0">
                        </div>
                        
                        <div class="flex flex-col">
                            <label class="mb-2 font-semibold text-sm md:text-base" for="description">Description</label>
                            <input v-model="form.description" type="text" id="description" name="description" placeholder="Description" class="text-sm md:text-base bg-[#121212] p-3 rounded border-0 outline-none focus:outline focus:outline-2 focus:outline-[#1DB954] focus:ring-0">
                        </div>

                        <div class="flex flex-col">
                            <label class="mb-2 font-semibold text-sm md:text-base" for="duedate">Due Date</label>
                            <input v-model="form.due_date" type="date" id="duedate" name="duedate" :min="today" class="text-sm md:text-base bg-[#121212] p-3 rounded border-0 outline-none focus:outline focus:outline-2 focus:outline-[#1DB954] focus:ring-0">
                        </div>

                        <div class="flex flex-col">
                            <label class="mb-2 font-semibold text-sm md:text-base" for="status">Status</label>
                            <select v-model="form.status" name="status" id="status" class="text-sm md:text-base bg-[#121212] p-3 rounded border-0 outline-none focus:outline focus:outline-2 focus:outline-[#1DB954] focus:ring-0">
                                <option value="Pending">Pending</option>
                            </select>
                        </div>

                        <div v-if="form.status === 'Completed'" class="flex flex-col">
                            <label for="completed">Completed At</label>
                            <input v-model="form.completed_at" type="datetime-local" id="completed" name="completed" class="text-sm md:text-base bg-[#121212] p-3 border-0 outline-none focus:outline focus:outline-2 focus:outline-[#1DB954] focus:ring-0">
                        </div>

                        <button type="submit" class="text-sm md:text-base bg-[#1DB954] p-3 mt-4 rounded">Add Task</button>
                    </div>
                </form>
            </section>
        </main>
    </AuthenticatedLayout>
</template>