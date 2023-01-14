<script setup>
import { onMounted } from 'vue';
import { usePage } from '@inertiajs/inertia-vue3'

import '../../js/vendors/shop/vendor/modernizr-3.6.0.min.js';
import '../../js/vendors/shop/vendor/jquery-3.6.0.min.js';
import '../../js/vendors/shop/vendor/jquery-migrate-3.3.0.min.js';
import '../../js/vendors/shop/vendor/bootstrap.bundle.min.js';
import '@/vendors/shop/plugins/slick.js';
import '../../js/vendors/shop/plugins/waypoints.js';
import '../../js/vendors/shop/plugins/perfect-scrollbar.js';
import '../../js/vendors/shop/plugins/scrollup.js';
import '../../js/vendors/shop/plugins/jquery.theia.sticky.js';
import '../../js/vendors/shop/plugins/jquery.elevatezoom.js';

import HeaderComponent from '@/Components/Shop/HeaderComponent.vue';
import MobileComponent from '@/Components/Shop/MobileComponent.vue';
import FooterComponent from '@/Components/Shop/FooterComponent.vue';

onMounted(() => {
    $("#preloader-active").delay(450).fadeOut("slow");
    $("body").delay(450).css({
        overflow: "visible"
    });
    /*-----------------
        Menu Stick
    -----------------*/
    var header = $(".sticky-bar");
    var win = $(window);
    win.on("scroll", function () {
        var scroll = win.scrollTop();
        if (scroll < 200) {
            header.removeClass("stick");
            $(".header-style-2 .categories-dropdown-active-large").removeClass("open");
            $(".header-style-2 .categories-button-active").removeClass("open");
        } else {
            header.addClass("stick");
        }
    });

    /*------ ScrollUp -------- */
    $.scrollUp({
        scrollText: '<i class="fi-rs-arrow-small-up"></i>',
        easingType: "linear",
        scrollSpeed: 900,
        animation: "fade"
    });

    //sidebar sticky
    if ($(".sticky-sidebar").length) {
        $(".sticky-sidebar").theiaStickySidebar();
    }

    /*-------------------------
        Create an account toggle
    --------------------------*/
    $(".checkout-toggle2").on("click", function () {
        $(".open-toggle2").slideToggle(1000);
    });

    $(".checkout-toggle").on("click", function () {
        $(".open-toggle").slideToggle(1000);
    });

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
    <div class="body-overlay-1"></div>
    <header-component />
    <mobile-component />
    <main  class="main">
        <slot />
    </main>
    <footer-component />
    <a id="scrollUp" href="#top" style="position: fixed; z-index: 2147483647;"><i class="fi-rs-arrow-small-up"></i></a>
</template>
<style>
@import '../../css/shop/plugins/animate.min.css';
@import '../../css/shop/main17e6.css';
</style>