<script setup>

import { Head, useForm } from '@inertiajs/inertia-vue3';

import AuthenticationLayout from '@/Layouts/AuthenticationLayout.vue'

const props = defineProps({
    email: String,
    token: String,
});

const form = useForm({
    token: props.token,
    email: props.email,
    password: '',
    password_confirmation: '',
});

const submit = () => {
    form.clearErrors();
    if(!form.password || form.password.trim() == "") {
        form.setError('password', 'Password field is required');
    }

    if(!form.password_confirmation || form.password_confirmation.trim() == "") {
        form.setError('password_confirmation', 'Password confirmation field is required');
    } else if (form.password !== form.password_confirmation) {
        form.setError('password_confirmation', 'Password confirmation does not match with password');
    }

    if(form.errors && Object.keys(form.errors).length) return;

    form.post('/reset-password', {
        onFinish: () => form.reset('password', 'password_confirmation'),
    });
};
</script>

<template>
    <AuthenticationLayout>
        <Head title="Reset Password - Binasta Limited"/>
        <div class="form-wrapper">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 m-auto">
                    <div class="card py-0 py-lg-4">
                        <div class="row">
                            <div class="col align-items-center justify-content-between flex-column text-center">
                                <figure class="mb-5">
                                    <img width="120" src="../../../assets/shop/imgs/theme/flogo.png" alt="logo">
                                </figure>
                                <div class="display-8 mb-4">Reset Your Password</div>
                                <form @submit.prevent="submit">
                                    <div class="form-group mb-3">
                                        <label for="new-password">New Password</label>
                                        <input type="password" class="form-control" v-model="form.password" required autocomplete="new-password">
                                        <div class="invalid-feedback" v-if="form.errors.password">{{  form.errors.password  }}</div>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="confirm-password">Confirm Password</label>
                                        <input type="password" class="form-control" v-model="form.password_confirmation" required autocomplete="new-password">
                                        <div class="invalid-feedback" v-if="form.errors.password_confirmation">{{  form.errors.password_confirmation  }}</div>
                                    </div>
                                    <button type="submit" :class="{ 'opacity-25': form.processing }" :disabled="form.processing" class="btn btn-primary mb-3">Reset</button>
                                    <div v-if="form.errors.email" class="alert alert-danger" role="alert">
                                        {{  form.errors.email  }}
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </AuthenticationLayout>
</template>
<style>
.invalid-feedback {
    display: block
}
</style>