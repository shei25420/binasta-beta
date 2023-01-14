<script setup>
import { Head, useForm, Link } from '@inertiajs/inertia-vue3';

import AuthenticationLayout from '@/Layouts/AuthenticationLayout.vue';

defineProps({
    status: String,
});

const form = useForm({
    email: '',
});

const submit = () => {
    form.clearErrors();
    if(!form.email || form.email.trim() == "") {
        form.setError('email', 'Email field is required');
    }

    if(form.errors && Object.keys(form.errors).length) return;

    const btn = document.getElementById("submitBtn");
    btn.innerText = "Sending Link.....";

    form.post('/forgot-password', {
        onSuccess: () => {

        },
        onFinish: () => {
            btn.innerText = "Send Link";
        }
    });
};
</script>

<template>
    <AuthenticationLayout>
        <Head title="Forgot Password - Binasta Limited" />

        <div class="form-wrapper">
            <div class="container">
                <div class="card">
                    <div class="row g-0">
                        <div class="col">
                            <div class="row align-items-center">
                                <div class="col-md-10 offset-md-1">
                                    <div class="d-block d-lg-none text-center text-lg-start">
                                        <img width="120" src="../../../assets/shop/imgs/theme/flogo.png"
                                            alt="logo">
                                    </div>
                                    <div class="my-5 text-center text-lg-start">
                                        <h1 class="display-8 mb-3">Reset Password</h1>
                                        <p class="text-muted">Forgot your password? No problem. Just let us know your email address and we will email you a password reset
                                            link that will allow you to choose a new one.
                                        </p>
                                    </div>
                                    <form @submit.prevent="submit">
                                        <div class="mb-3">
                                            <input type="email" v-model="form.email" class="form-control" placeholder="Enter email"
                                                autofocus="" required="">
                                                <div v-if="form.errors.email" class="invalid-feedback">
                                                    {{  form.errors.email  }}
                                                </div>
                                        </div>
                                        <div class="text-center text-lg-start">
                                            <button id="submitBtn" :class="{ 'opacity-25': form.processing }" :disabled="form.processing" class="btn btn-primary mb-4">Send</button>
                                        </div>
                                    </form>
                                    
                                </div>
                            </div>
                        </div>
                        <div
                            class="col d-none d-lg-flex border-start align-items-center justify-content-between flex-column text-center">
                            <div class="logo">
                                <img width="120" src="../../../assets/shop/imgs/theme/flogo.png" alt="logo">
                            </div>
                            <div>
                                <div class="text-center">
                                    <Link class="btn btn-primary btn-md" href="/login">sign in</Link> or
                                    <Link class="btn btn-primary btn-md" href="/register">create an account</Link>.
                                </div>
                            </div>
                            <ul class="list-inline">
                                <li class="list-inline-item">
                                    <a href="#">Privacy Policy</a>
                                </li>
                                <li class="list-inline-item">
                                    <a href="#">Terms &amp; Conditions</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticationLayout>
</template>

<style>
.invalid-feedback {
    display: block;
}
</style>