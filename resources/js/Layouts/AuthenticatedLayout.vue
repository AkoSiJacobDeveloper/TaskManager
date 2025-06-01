<script setup>
import Header from '@/Components/Header.vue';
</script>

<template>
    <div class="w-full bg-[#171717] text-[#E0E0E0]">
        <Header />
        <main class="min-h-screen">
            <slot></slot>
        </main>
    </div>
</template>