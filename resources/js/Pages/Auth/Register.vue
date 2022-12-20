<script setup>
import { Head, useForm } from '@inertiajs/inertia-vue3';
import AuthenticationLayout from '@/Layouts/AuthenticationLayout.vue';

const form = useForm({
    email: '',
    password: '',
    password_confirmation: '',
    terms: false,
});

const submit = () => {
    const btn = document.getElementById('submitBtn');
    btn.innerText = "Siging Up....";
    form.post(route('shop-register'), {
        onFinish: () => form.reset('password', 'password_confirmation'),
    });
};
</script>

<template>
    <AuthenticationLayout>
        <Head title="Register" />

        <div class="form-wrapper">
            <div class="container">
                <div class="card">
                    <div class="row g-0">
                        <div class="col">
                            <div class="row">
                                <div class="col-md-10 offset-md-1">
                                    <div class="ltf-block-logo d-block d-lg-none text-center text-lg-start">
                                        <img width="120" src="https://vetra.laborasyon.com/assets/images/logo.svg"
                                            alt="logo">
                                    </div>
                                    <div class="my-5 text-center text-lg-start">
                                        <h1 class="display-8">Create Account</h1>
                                        <p class="text-muted">You can create a free account now</p>
                                    </div>
                                    <form @submit.prevent="submit" class="mb-5">
                                        <div class="mb-3">
                                            <input v-model="form.email" type="email" class="form-control" placeholder="Enter email"
                                                required="">
                                        </div>
                                        <div class="mb-3">
                                            <input v-model="form.password" type="password" class="form-control" placeholder="Enter password"
                                                required="">
                                        </div>
                                        <div class="mb-3">
                                            <input v-model="form.password_confirmation" type="password" class="form-control" placeholder="Re-enter password"
                                                required="">
                                        </div>
                                        <div class="text-center text-lg-start">
                                            <button type="submit" id="submitBtn" class="btn btn-primary">Sign Up</button>
                                        </div>
                                    </form>
                                    <p class="text-center d-block d-lg-none mt-5 mt-lg-0">
                                        Don't have an account? <a href="#">Sign In</a>.
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div
                            class="col d-none d-lg-flex border-start align-items-center justify-content-between flex-column text-center">
                            <div class="logo">
                                <img width="120" src="https://vetra.laborasyon.com/assets/images/logo.svg" alt="logo">
                            </div>
                            <div>
                                <h3 class="fw-bold">Welcome to Vetra!</h3>
                                <p class="lead my-5">Do you already have an account?</p>
                                <a href="#" class="btn btn-primary">Sign In</a>
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
