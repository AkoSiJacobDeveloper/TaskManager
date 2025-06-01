<script setup>
import { Head, usePage } from '@inertiajs/vue3';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import AddTask from '@/Components/AddTask.vue';

const page = usePage();
const taskStats = page.props.taskStats;

defineProps({
    tasks: {
        type: Array,
        required: true
    }
});

const containers = [
    { heading: 'Total Tasks', value: taskStats?.total ?? 0 },
    { heading: 'Pending Tasks', value: taskStats?.pending ?? 0 },
    { heading: 'Completed Tasks', value: taskStats?.completed ?? 0 },
]
</script>

<template>
    <Head title="UserDashboard" />

    <AuthenticatedLayout>
        <main class="py-10 px-10 pt-28 md:px-20 min-h-screen w-full">
            <section class="flex justify-between items-center my-6">
                <p class="text-2xl lg:text-3xl font-bold flex justify-center items-center">Dashboard</p>
                <AddTask />
            </section>

            <section class="flex justify-center items-center mt-5">
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-5 w-full">
                    <div v-for="(container, index) in containers" :key="index" class="flex-1 rounded">
                        <p class="text-lg md:text-2xl text-center font-bold mb-5 bg-[#121212]  rounded-lg p-2 md:p-5">{{ container.heading }}</p>
                        <p class="text-2xl md:text-3xl lg:text-4xl text-center font-semibold bg-[#121212] rounded-lg flex justify-center items-center h-24 md:h-96">{{ container.value }}</p>
                    </div>
                </div>
            </section>
        </main>
    </AuthenticatedLayout>
</template>