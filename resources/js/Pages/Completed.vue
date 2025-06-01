<script setup>
import { Head, usePage, router } from '@inertiajs/vue3';
import { ref, onMounted, watch } from 'vue';

import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';

const props = defineProps({
    tasks: {
        type: Array,
        required: true
    }
});

const page = usePage();
const success = ref(page.props.flash.success);

// Watch for changes in the flash message
watch(() => page.props.flash.success, (newValue) => {
    success.value = newValue;
    if (newValue) {
        setTimeout(() => {
            success.value = null;
        }, 5000);
    }
});


const deleteTask = (id) => {
    if (confirm('Are you sure?')) {
        router.delete(route('tasks.destroy', id), {
            onSuccess: () => {
                success.value = 'Deleted Successfully';
                setTimeout(() => {
                    success.value = null;
                }, 5000);
            }
        });
    }
}

onMounted(() => {
    if(success.value) {
        setTimeout(() => {
            success.value = null;
        }, 5000)
    }
})

// Refresh the page to get latest data
const refreshPage = () => {
    router.reload({ only: ['tasks'] });
}
</script>

<template>
    <Head title="Completed" />

    <AuthenticatedLayout>
        <main class="pt-28 pb-10 px-10 md:pt-28 md:px-20 min-h-screen w-full">
            <div class="flex justify-between items-center my-6">
                <h1 class="text-2xl lg:text-3xl font-bold flex justify-center items-center">Completed Task</h1>
                <div v-if="success" class="p-2 text-center bg-[#dff0d8] text-[#3c763d] border border-[#d6e9c6] rounded flex justify-center items-center gap-2 text-xs md:text-base">
                    <i class="fa-solid fa-circle-check text-sm flex justify-center items-center"></i>
                    {{ success }}
                </div>
            </div>

            <!-- Task List -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-3">
                <div v-if="tasks.length === 0" class="text-gray-500 py-8">
                    No completed tasks found.
                </div>
                
                <div v-else v-for="task in tasks" :key="task.id" 
                    class="bg-[#121212] p-5 lg:p-10 rounded-lg shadow hover:shadow-md transition transform duration-300 ease-in-out hover:-translate-y-1 flex flex-col justify-center">
                    <div class="flex flex-col">
                        <div class="flex justify-between">
                            <h3 class="text-sm lg:text-lg font-bold flex justify-center items-center">{{ task.title }}</h3>
                            <div class="">
                                <span class="px-3 py-1 rounded-full text-xs bg-green-500/20 text-green-500">
                                    {{ task.status }}
                                </span>
                            </div>
                        </div>
                        <div class="h-24 flex items-center">
                            <p class="text-gray-400 my-3 text-sm">{{ task.description }}</p>
                        </div>
                    </div>
                    <div class="mt-4 flex justify-between">
                        <div class="text-sm text-gray-400">
                            <p>Completed: {{ new Date(task.completed_at).toLocaleDateString() }}</p>
                            <p>Due: {{ new Date(task.due_date).toLocaleDateString() }}</p>
                        </div>
                        <img @click="deleteTask(task.id)" :src="'/Svg/delete.svg'" alt="Delete" class="invert h-4 w-4 hover:cursor-pointer">
                    </div>
                </div>
            </div>
        </main>
    </AuthenticatedLayout>
</template>