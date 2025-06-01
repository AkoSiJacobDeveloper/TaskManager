<script setup>
import { Link } from '@inertiajs/vue3';

</script>

<template>
    <Link href="/tasks/create" as="button" class="w-3xs">
        <p class="text-sm rounded text-black bg-[#1DB954] p-2 md:py-3 md:px-3 flex justify-center items-center gap-1">
            <img :src="'/Svg/plus.svg'" class="h-3 w-3 md:h-5 md:w-5" alt="">
            Add Task</p>
    </Link>
    
</template>