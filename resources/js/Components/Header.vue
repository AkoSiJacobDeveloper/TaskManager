<script setup>
import { Link, router, usePage } from '@inertiajs/vue3';
import { ref } from 'vue';

// get the user name
const page = usePage();
const user = page.props.auth.user;

const isMenuOpen = ref(false);

const toggleMenu = () => {
    isMenuOpen.value = !isMenuOpen.value;
};

const links = [
    { src: '/userdashboard', name: 'Dashboard' },
    { src: '/pending', name: 'Pending'},
    { src: '/completed', name: 'Completed' },
    { src: '/about', name: 'About' },
    { src: '/contact', name: 'Contact' },
]

const logout = () => {
    router.post('/logout', {}, {
        replace: true,
    })
}
</script>

<template>
    <header class="w-full flex justify-between py-10 px-10 md:px-20 lg:py-3 lg:px-20 fixed z-[9999] bg-[#171717]">
        <div class="flex lg:gap-3">
            <!-- Image Container -->
            <div class="flex justify-center items-center">
                <img :src="'/Images/applayer.png'" alt="logo" class="invert h-8 w-8 lg:h-10 lg:w-10">
            </div>

            <!-- Desktop Links Container -->
            <div class="hidden lg:flex justify-center items-center">
                <ul class="flex gap-3">
                    <li v-for="(link, index) in links" :key="index">
                        <Link :href="link.src" :class="{'text-[#1DB954]' : link.src === page.url }">{{ link.name }}</Link>
                    </li>
                </ul>
            </div>
        </div>

        <!-- Desktop User Info -->
        <div class="hidden lg:flex py-5 gap-5">
            <p class="flex justify-center items-center">{{ user.name }}</p>
            <button class="flex gap-1 py-2 px-7 bg-[#1DB954] hover:bg-[#169c45] transition-colors rounded text-black" @click="logout">Logout</button>
        </div>

        <!-- Mobile/Tablet Menu Button -->
        <button @click="toggleMenu" class="lg:hidden text-white p-2 text-xl">
            <i class="fas" :class="isMenuOpen ? 'fa-times' : 'fa-bars'"></i>
        </button>

        <!-- Mobile/Tablet Menu Overlay -->
        <div v-if="isMenuOpen" 
            class="fixed inset-0 bg-black bg-opacity-50 z-40 lg:hidden"
            @click="toggleMenu">
        </div>

        <!-- Mobile/Tablet Menu -->
        <div :class="[
            'fixed top-0 right-0 h-full w-64 bg-[#171717] z-50 transform transition-transform duration-300 ease-in-out lg:hidden',
            isMenuOpen ? 'translate-x-0' : 'translate-x-full'
        ]">
            <div class="p-5">
                <div class="flex justify-between items-center mb-8">
                    <p class="text-white">{{ user.name }}</p>
                    <button @click="toggleMenu" class="text-white p-2">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                
                <ul class="space-y-4">
                    <li v-for="(link, index) in links" :key="index">
                        <Link 
                            :href="link.src" 
                            :class="[
                                'block py-2 px-4 rounded',
                                link.src === page.url ? 'text-[#1DB954]' : 'text-white hover:bg-[#1DB954] hover:text-black'
                            ]"
                            @click="toggleMenu"
                        >
                            {{ link.name }}
                        </Link>
                    </li>
                    <li>
                        <button 
                            @click="logout" 
                            class="w-full text-left py-2 px-4 rounded bg-[#1DB954] hover:bg-[#169c45] transition-colors text-black"
                        >
                            Logout
                        </button>
                    </li>
                </ul>
            </div>
        </div>
    </header>
</template>