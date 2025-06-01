<script setup>
import { Link, useForm, usePage } from '@inertiajs/vue3';
import { onMounted, watch, ref } from 'vue';

import AuthenticationLayout from '@/Layouts/AuthenticationLayout.vue';

const form = useForm({
    email: '',
    password: '',
});

const submit = () => {
    form.post(route('login'), {
        onFinish: () => form.reset('email','password'),
    });
}

watch(
    () => form.errors,
    (errors) => {
        if (Object.keys(errors).length > 0) {
            setTimeout(() => {
                form.clearErrors()
            }, 3000)
        }
    }
)

const page = usePage();
const success = ref(page.props.flash.success);

onMounted(() => {
    if(success.value) {
        setTimeout(() => {
            success.value = null
        }, 5000)
    }    
})

</script>

<template>
    
    <AuthenticationLayout>
        <main class="flex flex-col w-96 lg:w-[25vw] xl:w-[30vw] h-auto p-10 rounded items-center bg-[#171717]">
            <div class="flex flex-col gap-5">
                <div class="flex justify-center relative">
                    <img :src="'/Images/applayer.png'" alt="Logo" class="invert w-10 h-10">
                    <div v-if="success" class="p-3 w-full text-center bg-[#dff0d8] text-[#3c763d] border border-[#d6e9c6] rounded absolute">
                        {{ success }}
                    </div>
                </div>
                <div class="text-center">
                    <p class="font-bold text-lg md:text-2xl">Welcome Back!</p>
                    <p class="text-xs">Login to your account now and create task.</p>
                </div>

                <span v-if="form.errors.email" class="text-red-500 text-[0.6em] text-center">{{ form.errors.email }}</span>

                <div class="my-5 w-full">
                    <form @submit.prevent="submit">
                        <label class="text-sm font-semibold md:text-base" for="email">Email</label>
                        <input v-model="form.email" id="email" name="email" class="text-xs mb-3 w-full rounded p-3 md:p-4 bg-[#121212] border border-transparent focus:outline-none focus:border-[#1DB954] focus:ring-[#1DB954] focus:ring-1 caret-[#1DB954]" type="email" placeholder="johndoe@gmail.com">

                        <label class="text-sm font-semibold md:text-base" for="password">Password</label>
                        <input v-model="form.password" id="password" name="password" class="text-xs w-full rounded p-3 md:p-4 bg-[#121212] border border-transparent focus:outline-none focus:border-[#1DB954] focus:ring-[#1DB954] focus:ring-1 caret-[#1DB954]" type="password" placeholder="Password">
                        <span v-if="form.errors.password" class="text-red-500 text-[0.6em]">{{ form.errors.password }}</span>
                    
                        <button type="submit" class="text-sm md:base mt-5 p-3 md:p-4 w-full rounded bg-[#1DB954] hover:bg-[#169c45] transition-colors text-black font-bold" :disabled="form.processing">Login</button>
                    </form>
                </div>  
            </div>
            <div class="text-center">
                <p class="text-xs md:text-sm">Dont have an account yet? <Link class="hover:underline text-[#1DB954]" href="/register">Register</Link></p>
            </div>
        </main>
    </AuthenticationLayout>
</template>