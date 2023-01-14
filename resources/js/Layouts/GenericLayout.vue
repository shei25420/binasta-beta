<script setup>
import { onMounted } from 'vue';
import { usePage } from '@inertiajs/inertia-vue3';

import '../../assets/generic_dashboard/libs/bundle.js';
import '@/vendors/generic_dashboard/js/app.min.js';

import HeaderMenu from '@/Components/GenericDashboard/HeaderMenu.vue';
import FooterMenu from '@/Components/GenericDashboard/FooterMenu.vue';
import NotificationSideBar from '@/Components/GenericDashboard/NotificationSideBar.vue';
import MenuSideBar from '@/Components/GenericDashboard/MenuSideBar.vue';

if(document.body.classList.contains("auth")) document.body.classList.remove("auth");

onMounted(() => {
    if("IntersectionObserver" in window) {
        let lazyLoadImages = Array.from(document.querySelectorAll(".lazy"));
        let imageObserver = new IntersectionObserver(function (entries, observer) {
            entries.forEach((entry) => {
                if(entry.isIntersecting) {
                    let image = entry.target;
                    image.src = `${usePage().props.value.base.url}${image.dataset.src}`;
                    image.classList.remove("lazy");
                    imageObserver.unobserve(image);
                }
            });
        });
        lazyLoadImages.forEach(img => imageObserver.observe(img));
    }
});
</script>
    
<template>
    <notification-side-bar />
    <menu-side-bar />
    <div class="layout-wrapper">
        <header-menu />
        <div class="content">
            <slot />
        </div>
        <footer-menu />
    </div>
</template>
<style>
@import '../../assets/generic_dashboard/icons/bootstrap-icons-1.4.0/bootstrap-icons.min.css';
@import '../../css/generic_dashboard/css/bootstrap-docs.css';
@import '../../css/generic_dashboard/css/app.min.css';
</style>