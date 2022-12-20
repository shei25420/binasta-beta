<script setup>
import { onMounted } from 'vue';

import '../../assets/main/js/plugins.js';

import SiteHeader from '@/Components/Main/SiteHeader.vue';
import SiteFooter from '@/Components/Main/SiteFooter.vue';

onMounted(() => {
    if (!document.body.classList.contains("home_1")) document.body.classList.add("home_1");
    jQuery('.preloader-wrapper').fadeOut(300)

    jQuery('.filter-list').on('click', 'li', function () {
        jQuery('.filter-list li').removeClass('active')
        jQuery(this).addClass('active')

        var i = jQuery(this).attr('data-filter')
        
        jQuery('.grid2').isotope({ filter: i }) 
        jQuery(window).trigger('resize')
    })

    // jQuery('.counter').counterUp({ delay: 10, time: 1e3 }),
    
    jQuery(window).on('scroll', function () {
        jQuery(window).scrollTop() < 200
            ? jQuery('.navbar').removeClass('sticky fadeInDown animated')
            : jQuery('.navbar').addClass('sticky fadeInDown animated')
    })

    jQuery('.review_text-active').slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        arrows: !1,
        fade: !0,
        asNavFor: '.client-minithumb-active'
    })

    jQuery('.client-minithumb-active').slick({
        slidesToShow: 3,
        slidesToScroll: 1,
        asNavFor: '.review_text-active',
        dots: !1,
        arrows: !1,
        focusOnSelect: !0,
        vertical: !0,
        verticalSwiping: !0,
        responsive: [
            {
                breakpoint: 767.98,
                settings: { vertical: !1, verticalSwiping: !1 }
            }
        ]
    })

    jQuery('.rationSinglePrice').on('mouseover', function () {
        jQuery('.rationSinglePrice').removeClass('active'),
        jQuery(this).addClass('active')
    })

    jQuery('.progress').each(function () {
        var i = jQuery(this).attr('data-percent'),
            t = jQuery(this).prev('.progress-title'),
            a = jQuery(this).children('.progress-title')
        t.length > 0
            ? t.css('width', i)
            : a.length > 0 && a.css('width', i),
            jQuery(this).appear(function () {
                jQuery(this)
                    .find('.progress-bar')
                    .animate({ width: i }, 500)
            })
    })

    // jQuery('.img-popup').magnificPopup({
    //     type: 'image',
    //     gallery: { enabled: !0 }
    // })

    // jQuery('.playVideo ').magnificPopup({
    //     type: 'iframe',
    //     removalDelay: 300,
    //     mainClass: 'mfp-fade'
    // })

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

    // jQuery(function () {
    //     function i(i, t) {
    //         i.each(function () {
    //             var i = jQuery(this),
    //                 a = i.attr('data-animation'),
    //                 s = i.attr('data-animation-delay')
    //             i.css({
    //                 '-webkit-animation-delay': s,
    //                 '-moz-animation-delay': s,
    //                 'animation-delay': s
    //             }),
    //                 (t || i).waypoint(
    //                     function () {
    //                         i
    //                             .addClass('animated')
    //                             .css('visibility', 'visible'),
    //                             i.addClass('animated').addClass(a)
    //                     },
    //                     { triggerOnce: !0, offset: '90%' }
    //                 )
    //         })
    //     }
    //     i(jQuery('.animation')),
    //     i(jQuery('.staggered-animation'), jQuery('.staggered-animation-wrap'))
    // })
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