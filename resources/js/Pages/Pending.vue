<script setup>
import { Head, Link, usePage, router } from '@inertiajs/vue3';
import { onMounted, ref, computed } from 'vue';

import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';

const props = defineProps({
    tasks: {
        type: Array,
        required: true
    }
});

const page = usePage();
const success = ref(page.props.flash.success);

onMounted(() => {
    if(success.value) {
        setTimeout(() => {
            success.value = null;
        }, 5000)
    }
})

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

const markAsCompleted = (id) => {
    // Find the task in the tasks array using props.tasks
    const task = props.tasks.find(t => t.id === id);
    
    router.put(route('tasks.update', id), {
        title: task.title,
        description: task.description,
        due_date: task.due_date,
        status: 'Completed',
        completed_at: new Date().toISOString()
    }, {
        onSuccess: () => {
            success.value = 'Task Completed';
            setTimeout(() => {
                success.value = null;
            }, 5000);
        },
        onError: (errors) => {
            console.error('Error updating task:', errors);
        }
    });
}
</script>

<template>
    <Head title="Pending" />

    <AuthenticatedLayout>
        <main class="pt-28 pb-10 px-10 md:pt-28 md:px-20 min-h-screen w-full">
            <div class="flex justify-between items-center my-6">
                <h1 class="text-2xl lg:text-3xl font-bold flex justify-center items-center">Pending Task</h1>
                <div v-if="success" class="p-2 text-center bg-[#dff0d8] text-[#3c763d] border border-[#d6e9c6] rounded flex justify-center items-center gap-2 text-xs md:text-base">
                    <i class="fa-solid fa-circle-check text-sm flex justify-center items-center"></i>
                    {{ success }}
                </div>
            </div>

            <!-- Task List -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-3">
                <div v-if="tasks.length === 0" class="text-gray-500 py-8">
                    No pending tasks found.
                </div>
                
                <div v-else v-for="task in tasks" :key="task.id" 
                    class=" bg-[#121212] p-5 lg:p-10 rounded-lg shadow hover:shadow-md transition transform duration-300 ease-in-out hover:-translate-y-1 flex flex-col">
                    <div class="flex flex-col">
                        <div class="flex justify-between">
                            <h3 class="text-sm lg:text-lg font-bold flex justify-center items-center">{{ task.title }}</h3>
                            <div class="">
                                <span :class="{
                                    'px-3 py-1 rounded-full text-xs': true,
                                    'bg-yellow-500/20 text-yellow-500': task.status === 'Pending',
                                    'bg-green-500/20 text-green-500': task.status === 'Completed', }">
                                    {{ task.status }}
                                </span>
                            </div>
                        </div>
                        <div class="h-24 flex items-center">
                            <p class="text-gray-400 my-3 text-sm">{{ task.description }}</p>
                        </div>
                    </div>
                    <div class="mt-4 text-sm text-gray-400 flex justify-between">
                        <p class="text-sm">Due: {{ new Date(task.due_date).toLocaleDateString() }}</p>
                        <div class="flex gap-3">
                            <Link :href="route('tasks.edit', task.id)">
                                <img :src="'/Svg/edit.svg'" alt="Edit" class="invert h-4 w-4">
                            </Link>
                            <img @click="deleteTask(task.id)" :src="'/Svg/delete.svg'" alt="Delete" class="invert h-4 w-4 hover:cursor-pointer">
                            <button v-if="task.status === 'Pending'" @click="markAsCompleted(task.id)" class="text-green-500 hover:text-green-600">
                                <i class="fa-solid fa-check"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </AuthenticatedLayout>
</template>

