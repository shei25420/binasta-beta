<script setup>
import { Link } from '@inertiajs/inertia-vue3';

import GenericLayout from '@/Layouts/GenericLayout.vue';
</script>

<template>
    <GenericLayout>
        <div class="content align-items-center content d-flex justify-content-center text-center flex-column">     
        <div class="row mb-5">
            <div class="col-md-3 m-auto">
                <figure>
                    <img class="w-100" src="https://vetra.laborasyon.com/assets/svg/access-denied.svg" alt="image">
                </figure>
            </div>
        </div>
        <div class="display-6">Access Denied</div>
        <p class="text-muted my-4">You need to be verified to access this page. Contact us at support@binasta.co.ke for more info.</p>
        <div class="d-flex gap-3 justify-content-center">
            <Link href="/distributor_packages" class="btn btn-primary">Continue Shopping</Link>
            <a href="https://binasta.co.ke" class="btn bg-white">Main Site</a>
        </div>
    
        </div>
    </GenericLayout>
</template>