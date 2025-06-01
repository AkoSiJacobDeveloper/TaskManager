<script setup>
import { useForm } from '@inertiajs/vue3';

import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';

const props = defineProps({
    task: {
        type: Object,
        required: true,
    }
})

const form = useForm({
    title: props.task.title,
    description: props.task.description,
    due_date: props.task.due_date,
    status: props.task.status,
    completed_at: props.task.completed_at,
})

// Get today's date in YYYY-MM-DD format
const today = new Date().toISOString().split('T')[0];

function submit() {
    form.put(route('tasks.update', props.task.id))
}
</script>

<template>
    <Head title="Edit" />

    <AuthenticatedLayout>
        <main class="relative pt-28 pb-10 px-10 md:pt-28 md:px-20">
            <h1 class="text-2xl lg:text-3xl my-6 font-bold">Edit Task</h1>
            <section>
                <form @submit.prevent="submit">
                    <div class="flex flex-col gap-4">
                        <div class="flex flex-col">
                            <label class="mb-2 font-semibold" for="title">Title</label>
                            <input v-model="form.title" type="text" id="title" name="title" placeholder="Title" class="bg-[#121212] p-3 rounded border-0 outline-none focus:outline focus:outline-2 focus:outline-[#1DB954] focus:ring-0 text-sm md:text-base">
                        </div>
                        
                        <div class="flex flex-col">
                            <label class="mb-2 font-semibold" for="description">Description</label>
                            <input v-model="form.description" type="text" id="description" name="description" placeholder="Description" class="bg-[#121212] p-3 rounded border-0 outline-none focus:outline focus:outline-2 focus:outline-[#1DB954] focus:ring-0 text-sm md:text-base">
                        </div>

                        <div class="flex flex-col">
                            <label class="mb-2 font-semibold" for="duedate">Due Date</label>
                            <input v-model="form.due_date" type="date" id="duedate" name="duedate" :min="today" class="bg-[#121212] p-3 rounded border-0 outline-none focus:outline focus:outline-2 focus:outline-[#1DB954] focus:ring-0 text-sm md:text-base">
                        </div>

                        <div class="flex flex-col">
                            <label class="mb-2 font-semibold" for="status">Status</label>
                            <select v-model="form.status" name="status" id="status" class="bg-[#121212] p-3 rounded border-0 outline-none focus:outline focus:outline-2 focus:outline-[#1DB954] focus:ring-0 text-sm md:text-base">
                                <option value="Pending">Pending</option>
                                <!-- <option value="Completed">Completed</option> -->
                            </select>
                        </div>

                        <!-- <div v-if="form.status === 'Completed'" class="flex flex-col">
                            <label for="completed">Completed At</label>
                            <input v-model="form.completed_at" type="datetime-local" id="completed" name="completed" class="bg-[#121212] p-3">
                        </div> -->

                        <button type="submit" class="text-sm md:text-base bg-[#1DB954] p-3 mt-4 rounded">Update Task</button>
                    </div>
                </form>
            </section>
        </main>
    </AuthenticatedLayout>
</template>