<script setup>
    import 'jquery/dist/jquery.js';
    import 'bootstrap/dist/js/bootstrap.js';
    import '@/vendors/generic_dashboard/js/app.min.js';

    if(!document.body.classList.contains("auth")) document.body.classList.add("auth");
</script>
    
<template>
    <div class="form-wrapper">
        <div class="container">
            <div class="card">
                <div class="row g-0">
                    <slot />
                </div>
            </div>
        </div>
    </div>
</template>
<style>
@import '../../assets/generic_dashboard/icons/themify-icons/themify-icons.css';
@import '../../css/generic_dashboard/css/app.min.css';
</style>