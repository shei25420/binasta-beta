<script setup>
import { onMounted } from 'vue';
import { usePage } from '@inertiajs/inertia-vue3';

import '../../assets/main/js/plugins.js';

import SiteHeader from '@/Components/Main/SiteHeader.vue';
import SiteFooter from '@/Components/Main/SiteFooter.vue';

onMounted(() => {
    if (!document.body.classList.contains("home_1")) document.body.classList.add("home_1");

    
    jQuery(window).on('scroll', function () {
        jQuery(window).scrollTop() < 200
            ? jQuery('.navbar').removeClass('sticky fadeInDown animated')
            : jQuery('.navbar').addClass('sticky fadeInDown animated')
    })

    jQuery.scrollUp({
        scrollText: '<i class="fa fa-angle-up"></i>',
        animation: 'slide'
    })

    jQuery('.menu-click').on('click', function () {
        return jQuery('.main-menu > ul').toggleClass('show'), !1
    })

    jQuery(window).width() < 1199.98 && jQuery('.main-menu ul li.menu-item-has-children').on('click', function () {
        return (
            jQuery(this)
                .children('ul.sub-menu')
                .slideToggle(),
            jQuery(this).toggleClass('change-icon'),
            !1
        )
    })
    
    jQuery('.main-menu ul li, .main-menu ul ul li').on('click', function (
        e
    ) {
        e.stopPropagation()
    })

    jQuery('.preloader-wrapper').fadeOut(300)

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
    <!--preloader-->
    <div class="preloader-wrapper">
        <div class="preloader-thumb">
            <img src="../../assets/main/images/all-img/preloder.gif" alt="">
        </div>
    </div>

    <!--Header area start-->
    <SiteHeader />
    <slot />
    <!-- footer section -->
    <SiteFooter />

</template>

<style>
@import "https://fonts.googleapis.com/css?family=Lora:400,700";
@import "https://fonts.googleapis.com/css?family=Roboto:100,300,400,700";
@import "../../assets/main/font-awesome/4.7.0/css/font-awesome.min.css";
@import "../../assets/main/css/plugins.css";
@import "../../assets/main/css/app.css";
</style>