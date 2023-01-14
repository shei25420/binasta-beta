<script setup>
import { onMounted } from 'vue';
import SiteFooter from '@/Components/Business/SiteFooter.vue';
import SiteHeader from '@/Components/Business/SiteHeader.vue';

import "../../assets/business/js/jquery-3.5.1.min.js";
import "../../assets/business/js/components/jquery.singlePageNav.min.js";
import "../../assets/business/js/custom.js";

onMounted(() => {
    document.body.className = "";
    document.body.classList.add("home", "web", "content-loaded");
});
</script>

<template>
    <div class="main-wrapper">
        <main class="content">
            <slot />    
        </main>
        <SiteHeader />
        <SiteFooter />
    </div>
</template>

<style>
@import "../../assets/business/css/first-screen.css";
/* @import "../../assets/business/fonts/AleoBold.woff2"; */
/* @import "../../assets/business/fonts/Lato/LatoRegular.woff2"; */
/* @import "../../assets/business/fonts/Lato/LatoBold.woff2"; */
@import "../../assets/business/css/style.css";
</style>