<script setup>
import '../../assets/generic_dashboard/libs/bundle.js';
import '../../assets/generic_dashboard/libs/charts/apex/apexcharts.min.js';
import '@/vendors/generic_dashboard/js/app.min.js';

import HeaderMenu from '@/Components/GenericDashboard/HeaderMenu.vue';
import FooterMenu from '@/Components/GenericDashboard/FooterMenu.vue';
import NotificationSideBar from '@/Components/GenericDashboard/NotificationSideBar.vue';
import MenuSideBar from '@/Components/GenericDashboard/MenuSideBar.vue';

if(document.body.classList.contains("auth")) document.body.classList.remove("auth");
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