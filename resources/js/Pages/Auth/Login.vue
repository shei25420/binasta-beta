<script setup>
import { useForm, Link } from '@inertiajs/inertia-vue3';
import AuthenticationLayout from '@/Layouts/AuthenticationLayout.vue';

const form = useForm({
    email: '',
    password: ''
});

const authenticate = () => {
    form.clearErrors();

    if(!form.email || form.email.trim() === "") form.setError("email", "Email field is required");
    if(!form.password || form.password.trim() === "") form.setError("password", "Password field is required");

    if(form.errors && Object.keys(form.errors).length) return;

    const btn = document.getElementById("submitBtn");
    btn.innerText = "Siging In....";
    btn.setAttribute("disabled", true);
    form.post('/login', {
        onFinish: () => {
            btn.innerText = "Sign In";
            btn.removeAttribute("disabled");
        }
    });
};

</script>

<template>
    <AuthenticationLayout>
        <div class="col">
            <div class="row">
                <div class="col-md-10 offset-md-1">
                    <div class="d-block d-lg-none text-center text-lg-start">
                        <img width="120" src="../../../assets/shop/imgs/theme/flogo.png" alt="logo">
                    </div>
                    <div class="my-5 text-center text-lg-start">
                        <h1 class="display-8">Sign In</h1>
                        <p class="text-muted">Sign in to Binasta to continue</p>
                    </div>
                    <form @submit.prevent="authenticate" class="mb-5">
                        <div class="mb-3">
                            <input v-model="form.email" type="email" class="form-control" placeholder="Enter email" autofocus="" required="" autocomplete="email">
                        </div>
                        <div class="mb-3">
                            <input v-model="form.password" type="password" class="form-control" placeholder="Enter password" required="" autocomplete="current-password">
                        </div>
                        <div class="text-center text-lg-start">
                            <p class="small">Can't access your account? <Link href="/forgot-password">Reset your password now</Link>.</p>
                            <button id="submitBtn" class="btn btn-primary">Sign In</button>
                        </div>
                    </form>
                    <p class="text-center d-block d-lg-none mt-5 mt-lg-0">
                        Don't have an account? <Link href="/register">Sign up</Link>.
                    </p>
                </div>
            </div>
        </div>
        <div
            class="col d-none d-lg-flex border-start align-items-center justify-content-between flex-column text-center">
            <div class="logo">
                <img width="120" src="../../../assets/shop/imgs/theme/flogo.png" alt="logo">
            </div>
            <div>
                <h3 class="fw-bold">Welcome to Binasta!</h3>
                <p class="lead my-5">If you don't have an account, would you like to register right now?</p>
                <Link href="/register" class="btn btn-primary">Sign up</Link>
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
    </AuthenticationLayout>
</template>
