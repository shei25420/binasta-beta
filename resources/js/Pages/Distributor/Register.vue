<script setup>
import { Head, useForm } from '@inertiajs/inertia-vue3';
import AuthenticationLayout from '@/Layouts/AuthenticationLayout.vue';

defineProps({
    countries: Array
});

const form = useForm({
    first_name: '',
    last_name: '',
    email: '',
    password: '',
    domain: '',
    gender: '',
    country_id: '',
    terms: false,
});

const register = () => {
    form.clearErrors();
    if(!form.first_name || form.first_name.trim() == "") {
        form.setError('first_name', 'first name is required');
    }
    if(!form.last_name || form.last_name.trim() == "") {
        form.setError('last_name', 'first name is required');
    }
    if(!form.email || form.email.trim() == "") {
        form.setError('email', 'email is required');
    }
    if(!form.password || form.password.trim() == "") {
        form.setError('password', 'password is required');
    }
    if(!form.domain || form.domain.trim() == "") {
        form.setError('domain', 'domain is required');
    }
    if(!form.gender || form.gender.trim() == "") {
        form.setError('gender', 'gender is required');
    }
    if(!form.country_id || parseInt(form.country_id) == NaN) {
        form.setError('country_id', 'country is required');
    }

    if(form.errors && Object.keys(form.errors).length) return;

    const btn = document.getElementById('submitBtn');
    btn.innerText = "Singing up....";
    form.post('/register', {
        onSuccess: () => {
            console.log("success fuckshit");
        },
        onError: (err) => {
            console.log("sign up err:", err);
        },
        onFinish: () => {
            btn.innerText = "Sign up";
            form.reset('password', 'password_confirmation')
        },
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
                        <div class="col-md-7">
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
                                    <form @submit.prevent="register" class="mb-5">
                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                            <input v-model="form.first_name" type="text" class="form-control" placeholder="First Name"
                                                required="">
                                            <div class="invalid-feedback" v-if="form.errors.first_name">{{ form.errors.first_name  }}</div>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <input v-model="form.last_name" type="text" class="form-control" placeholder="Last Name"
                                                    required="">
                                                <div class="invalid-feedback" v-if="form.errors.last_name">{{ form.errors.last_name  }}</div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <input v-model="form.email" type="email" class="form-control" placeholder="Enter email"
                                                    required="">
                                                    <div class="invalid-feedback" v-if="form.errors.email">{{ form.errors.email  }}</div>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <input v-model="form.password" type="password" class="form-control" placeholder="Enter password"
                                                    required="">
                                                <div class="invalid-feedback" v-if="form.errors.password">{{ form.errors.password  }}</div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <select v-model="form.country_id" class="form-control">
                                                    <option value="">Select Country</option>
                                                    <option v-for="country in countries" :key="country.id" :value="country.id">{{  country.name  }}</option>
                                                </select>
                                                <div class="invalid-feedback" v-if="form.errors.country_id">{{ form.errors.country_id  }}</div>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <select v-model="form.gender" class="form-control">
                                                    <option value="">Select Gender</option>
                                                    <option value="0">Male</option>
                                                    <option value="1">Female</option>
                                                </select>
                                                <div class="invalid-feedback" v-if="form.errors.gender">{{ form.errors.gender  }}</div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="mb-3">
                                                <div class="input-group mb-3">
                                                    <input type="text" v-model="form.domain" class="form-control" placeholder="Prefered domain name" aria-label="Recipient's username" aria-describedby="basic-addon2">
                                                    <div class="input-group-append">
                                                        <span class="input-group-text" id="basic-addon2">.binasta.co.ke</span>
                                                    </div>
                                                </div>
                                                <div class="invalid-feedback" v-if="form.errors.domain">{{ form.errors.domain  }}</div>
                                            </div>
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
                            class="col-md-5 d-none d-lg-flex border-start align-items-center justify-content-between flex-column text-center">
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
<style scoped>
.invalid-feedback {
    display: inline-block;
}
</style>
