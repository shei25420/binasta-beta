<script setup>
import { useStorage } from '@vueuse/core';
import { Link } from '@inertiajs/inertia-vue3'

const cartItems = useStorage('cart', []);

const removeCart = (itemToRemove) => {
    cartItems.value = cartItems.value.filter(item => parseInt(item.product.id) !== parseInt(itemToRemove.product.id));
};

</script>
<template>
    <header class="header-area header-style-1 header-height-2 sticky-bar">
        <div class="mobile-promotion"><span>Grand opening, <strong>up to 15%</strong> off all items. Only <strong>3
                    days</strong> left</span></div>
        <div class="header-top header-top-ptb-1 d-none d-lg-block">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-xl-3 col-lg-4">
                        <div class="header-info">
                            <ul>
                                <!-- <li><a href="#">My Account</a></li> -->
                                <!-- <li><a href="#">Order Tracking</a></li> -->
                            </ul>
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-4">
                        <div class="text-center">
                            <div id="news-flash" class="d-inline-block"
                                style="overflow: hidden; position: relative; height: 14px;">
                                <ul style="position: absolute; margin: 0px; padding: 0px; top: -13.9601px;">
                                    <li style="margin: 0px; padding: 0px; height: 14px;">Supper Value Deals - Save more
                                        with coupons</li>
                                    <li style="margin: 0px; padding: 0px; height: 14px;">Supper Value Deals - Save more
                                        with coupons</li>
                                    <li style="margin: 0px; padding: 0px; height: 14px;">Supper Value Deals - Save more
                                        with coupons</li>
                                    <li style="margin: 0px; padding: 0px; height: 14px;">Supper Value Deals - Save more
                                        with coupons</li>
                                    <li style="margin: 0px; padding: 0px; height: 14px;">Supper Value Deals - Save more
                                        with coupons</li>
                                    <li style="margin: 0px; padding: 0px; height: 14px; opacity: 0.948321;">Supper Value
                                        Deals - Save more with coupons</li>
                                    <li style="margin: 0px; padding: 0px; height: 14px; opacity: 0.948321;">Supper Value
                                        Deals - Save more with coupons</li>
                                    <li style="margin: 0px; padding: 0px; height: 14px; opacity: 0.948321;">Supper Value
                                        Deals - Save more with coupons</li>
                                    <li style="margin: 0px; padding: 0px; height: 14px; opacity: 0.948321;">Supper Value
                                        Deals - Save more with coupons</li>
                                    <li style="margin: 0px; padding: 0px; height: 14px; opacity: 0.948321;">Supper Value
                                        Deals - Save more with coupons</li>
                                    <li style="margin: 0px; padding: 0px; height: 14px; opacity: 0.948321;">Supper Value
                                        Deals - Save more with coupons</li>
                                    <li style="margin: 0px; padding: 0px; height: 14px; opacity: 0.948321;">Supper Value
                                        Deals - Save more with coupons</li>
                                    <li style="margin: 0px; padding: 0px; height: 14px; opacity: 0.948321;">Supper Value
                                        Deals - Save more with coupons</li>
                                    <li style="margin: 0px; padding: 0px; height: 14px; opacity: 0.948321;">Supper Value
                                        Deals - Save more with coupons</li>
                                    <li style="margin: 0px; padding: 0px; height: 14px; opacity: 0.948321;">Supper Value
                                        Deals - Save more with coupons</li>
                                    <li style="margin: 0px; padding: 0px; height: 14px; opacity: 0.948321;">Supper Value
                                        Deals - Save more with coupons</li>
                                    <li style="margin: 0px; padding: 0px; height: 14px; opacity: 0.948321;">Supper Value
                                        Deals - Save more with coupons</li>
                                    <li style="margin: 0px; padding: 0px; height: 14px; opacity: 0.948321;">Supper Value
                                        Deals - Save more with coupons</li>
                                    <li style="margin: 0px; padding: 0px; height: 14px; opacity: 0.948321;">Supper Value
                                        Deals - Save more with coupons</li>
                                    <li style="margin: 0px; padding: 0px; height: 14px; opacity: 0.948321;">Supper Value
                                        Deals - Save more with coupons</li>
                                    <li style="margin: 0px; padding: 0px; height: 14px; opacity: 0.948321;">Supper Value
                                        Deals - Save more with coupons</li>
                                    <li style="margin: 0px; padding: 0px; height: 14px; opacity: 0.948321;">Supper Value
                                        Deals - Save more with coupons</li>
                                    <li style="margin: 0px; padding: 0px; height: 14px; opacity: 0.948321;">Supper Value
                                        Deals - Save more with coupons</li>
                                    <li style="margin: 0px; padding: 0px; height: 14px; opacity: 0.948321;">Supper Value
                                        Deals - Save more with coupons</li>
                                    <li style="margin: 0px; padding: 0px; height: 14px; opacity: 0.948321;">Supper Value
                                        Deals - Save more with coupons</li>
                                    <li style="margin: 0px; padding: 0px; height: 14px; opacity: 0.948321;">Supper Value
                                        Deals - Save more with coupons</li>
                                    <li style="margin: 0px; padding: 0px; height: 14px; opacity: 0.948321;">Supper Value
                                        Deals - Save more with coupons</li>
                                    <li style="margin: 0px; padding: 0px; height: 14px; opacity: 0.948321;">Supper Value
                                        Deals - Save more with coupons</li>
                                    <li style="margin: 0px; padding: 0px; height: 14px; opacity: 0.948321;">Supper Value
                                        Deals - Save more with coupons</li>
                                    <li style="margin: 0px; padding: 0px; height: 14px; opacity: 0.948321;">Supper Value
                                        Deals - Save more with coupons</li>
                                    <li style="margin: 0px; padding: 0px; height: 14px; opacity: 0.948321;">Supper Value
                                        Deals - Save more with coupons</li>
                                    <li style="margin: 0px; padding: 0px; height: 14px; opacity: 0.948321;">Supper Value
                                        Deals - Save more with coupons</li>
                                    <li style="margin: 0px; padding: 0px; height: 14px; opacity: 0.948321;">Supper Value
                                        Deals - Save more with coupons</li>
                                    <li style="margin: 0px; padding: 0px; height: 14px; opacity: 0.948321;">Supper Value
                                        Deals - Save more with coupons</li>
                                    <li style="margin: 0px; padding: 0px; height: 14px; opacity: 0.948321;">Supper Value
                                        Deals - Save more with coupons</li>
                                    <li style="margin: 0px; padding: 0px; height: 14px; opacity: 0.948321;">Supper Value
                                        Deals - Save more with coupons</li>
                                    <li style="margin: 0px; padding: 0px; height: 14px; opacity: 0.948321;">Supper Value
                                        Deals - Save more with coupons</li>
                                    <li style="margin: 0px; padding: 0px; height: 14px; opacity: 0.948321;">Supper Value
                                        Deals - Save more with coupons</li>
                                    <li style="margin: 0px; padding: 0px; height: 14px; opacity: 0.948321;">Supper Value
                                        Deals - Save more with coupons</li>
                                    <li style="margin: 0px; padding: 0px; height: 14px; opacity: 0.948321;">Supper Value
                                        Deals - Save more with coupons</li>
                                    <li style="margin: 0px; padding: 0px; height: 14px; opacity: 0.948321;">Supper Value
                                        Deals - Save more with coupons</li>
                                    <li style="margin: 0px; padding: 0px; height: 14px; opacity: 0.948321;">Supper Value
                                        Deals - Save more with coupons</li>
                                    <li style="margin: 0px; padding: 0px; height: 14px;">Supper Value Deals - Save more
                                        with coupons</li>
                                    <li style="margin: 0px; padding: 0px; height: 14px;">Supper Value Deals - Save more
                                        with coupons</li>
                                    <li style="margin: 0px; padding: 0px; height: 14px;">Supper Value Deals - Save more
                                        with coupons</li>
                                    <li style="margin: 0px; padding: 0px; height: 14px;">Supper Value Deals - Save more
                                        with coupons</li>
                                    <li style="margin: 0px; padding: 0px; height: 14px;">Supper Value Deals - Save more
                                        with coupons</li>
                                    <li style="margin: 0px; padding: 0px; height: 14px;">Supper Value Deals - Save more
                                        with coupons</li>
                                    <li style="margin: 0px; padding: 0px; height: 14px;">Supper Value Deals - Save more
                                        with coupons</li>
                                    <li style="margin: 0px; padding: 0px; height: 14px;">Supper Value Deals - Save more
                                        with coupons</li>
                                    <li style="margin: 0px; padding: 0px; height: 14px;">Supper Value Deals - Save more
                                        with coupons</li>
                                    <li style="margin: 0px; padding: 0px; height: 14px;">Supper Value Deals - Save more
                                        with coupons</li>
                                    <li style="margin: 0px; padding: 0px; height: 14px;">Supper Value Deals - Save more
                                        with coupons</li>
                                    <li style="margin: 0px; padding: 0px; height: 14px;">Supper Value Deals - Save more
                                        with coupons</li>
                                    <li style="margin: 0px; padding: 0px; height: 14px;">Supper Value Deals - Save more
                                        with coupons</li>
                                    <li style="margin: 0px; padding: 0px; height: 14px;">Supper Value Deals - Save more
                                        with coupons</li>
                                    <li style="margin: 0px; padding: 0px; height: 14px;">Supper Value Deals - Save more
                                        with coupons</li>
                                    <li style="margin: 0px; padding: 0px; height: 14px;">Supper Value Deals - Save more
                                        with coupons</li>
                                    <li style="margin: 0px; padding: 0px; height: 14px;">Supper Value Deals - Save more
                                        with coupons</li>
                                    <li style="margin: 0px; padding: 0px; height: 14px;">Supper Value Deals - Save more
                                        with coupons</li>
                                    <li style="margin: 0px; padding: 0px; height: 14px;">Supper Value Deals - Save more
                                        with coupons</li>
                                    <li style="margin: 0px; padding: 0px; height: 14px;">Supper Value Deals - Save more
                                        with coupons</li>
                                    <li style="margin: 0px; padding: 0px; height: 14px;">Supper Value Deals - Save more
                                        with coupons</li>
                                    <li style="margin: 0px; padding: 0px; height: 14px;">Supper Value Deals - Save more
                                        with coupons</li>
                                    <li style="margin: 0px; padding: 0px; height: 14px;">Supper Value Deals - Save more
                                        with coupons</li>
                                    <li style="margin: 0px; padding: 0px; height: 14px;">Supper Value Deals - Save more
                                        with coupons</li>
                                    <li style="margin: 0px; padding: 0px; height: 14px;">Supper Value Deals - Save more
                                        with coupons</li>
                                    <li style="margin: 0px; padding: 0px; height: 14px;">Supper Value Deals - Save more
                                        with coupons</li>
                                    <li style="margin: 0px; padding: 0px; height: 14px;">Supper Value Deals - Save more
                                        with coupons</li>
                                    <li style="margin: 0px; padding: 0px; height: 14px;">Supper Value Deals - Save more
                                        with coupons</li>
                                    <li style="margin: 0px; padding: 0px; height: 14px;">Supper Value Deals - Save more
                                        with coupons</li>
                                    <li style="margin: 0px; padding: 0px; height: 14px;">Supper Value Deals - Save more
                                        with coupons</li>
                                    <li style="margin: 0px; padding: 0px; height: 14px;">Supper Value Deals - Save more
                                        with coupons</li>
                                    <li style="margin: 0px; padding: 0px; height: 14px;">Supper Value Deals - Save more
                                        with coupons</li>
                                    <li style="margin: 0px; padding: 0px; height: 14px;">Supper Value Deals - Save more
                                        with coupons</li>
                                    <li style="margin: 0px; padding: 0px; height: 14px;">Supper Value Deals - Save more
                                        with coupons</li>
                                    <li style="margin: 0px; padding: 0px; height: 14px;">Supper Value Deals - Save more
                                        with coupons</li>
                                    <li style="margin: 0px; padding: 0px; height: 14px;">Supper Value Deals - Save more
                                        with coupons</li>
                                    <li style="margin: 0px; padding: 0px; height: 14px;">Supper Value Deals - Save more
                                        with coupons</li>
                                    <li style="margin: 0px; padding: 0px; height: 14px;">Supper Value Deals - Save more
                                        with coupons</li>
                                    <li style="margin: 0px; padding: 0px; height: 14px;">Supper Value Deals - Save more
                                        with coupons</li>
                                    <li style="margin: 0px; padding: 0px; height: 14px;">Supper Value Deals - Save more
                                        with coupons</li>
                                    <li style="margin: 0px; padding: 0px; height: 14px;">Supper Value Deals - Save more
                                        with coupons</li>
                                    <li style="margin: 0px; padding: 0px; height: 14px;">Supper Value Deals - Save more
                                        with coupons</li>
                                    <li style="margin: 0px; padding: 0px; height: 14px;">Supper Value Deals - Save more
                                        with coupons</li>
                                    <li style="margin: 0px; padding: 0px; height: 14px;">Supper Value Deals - Save more
                                        with coupons</li>
                                    <li style="margin: 0px; padding: 0px; height: 14px;">Supper Value Deals - Save more
                                        with coupons</li>
                                    <li style="margin: 0px; padding: 0px; height: 14px;">Supper Value Deals - Save more
                                        with coupons</li>
                                    <li style="margin: 0px; padding: 0px; height: 14px;">Supper Value Deals - Save more
                                        with coupons</li>
                                    <li style="margin: 0px; padding: 0px; height: 14px;">Supper Value Deals - Save more
                                        with coupons</li>
                                    <li style="margin: 0px; padding: 0px; height: 14px;">Supper Value Deals - Save more
                                        with coupons</li>
                                    <li style="margin: 0px; padding: 0px; height: 14px;">Supper Value Deals - Save more
                                        with coupons</li>
                                    <li style="margin: 0px; padding: 0px; height: 14px;">Supper Value Deals - Save more
                                        with coupons</li>
                                    <li style="margin: 0px; padding: 0px; height: 14px;">Supper Value Deals - Save more
                                        with coupons</li>
                                    <li style="margin: 0px; padding: 0px; height: 14px;">Supper Value Deals - Save more
                                        with coupons</li>
                                    <li style="margin: 0px; padding: 0px; height: 14px;">Supper Value Deals - Save more
                                        with coupons</li>
                                    <li style="margin: 0px; padding: 0px; height: 14px;">Supper Value Deals - Save more
                                        with coupons</li>
                                    <li style="margin: 0px; padding: 0px; height: 14px;">Supper Value Deals - Save more
                                        with coupons</li>
                                    <li style="margin: 0px; padding: 0px; height: 14px;">Supper Value Deals - Save more
                                        with coupons</li>
                                    <li style="margin: 0px; padding: 0px; height: 14px;">Supper Value Deals - Save more
                                        with coupons</li>
                                    <li style="margin: 0px; padding: 0px; height: 14px;">Supper Value Deals - Save more
                                        with coupons</li>
                                    <li style="margin: 0px; padding: 0px; height: 14px;">Supper Value Deals - Save more
                                        with coupons</li>
                                    <li style="margin: 0px; padding: 0px; height: 14px;">Supper Value Deals - Save more
                                        with coupons</li>
                                    <li style="margin: 0px; padding: 0px; height: 14px;">Supper Value Deals - Save more
                                        with coupons</li>
                                    <li style="margin: 0px; padding: 0px; height: 14px;">Supper Value Deals - Save more
                                        with coupons</li>
                                    <li style="margin: 0px; padding: 0px; height: 14px;">Supper Value Deals - Save more
                                        with coupons</li>
                                    <li style="margin: 0px; padding: 0px; height: 14px;">Supper Value Deals - Save more
                                        with coupons</li>
                                    <li style="margin: 0px; padding: 0px; height: 14px;">Supper Value Deals - Save more
                                        with coupons</li>
                                    <li style="margin: 0px; padding: 0px; height: 14px;">Supper Value Deals - Save more
                                        with coupons</li>
                                    <li style="margin: 0px; padding: 0px; height: 14px;">Supper Value Deals - Save more
                                        with coupons</li>
                                    <li style="margin: 0px; padding: 0px; height: 14px;">Supper Value Deals - Save more
                                        with coupons</li>
                                    <li style="margin: 0px; padding: 0px; height: 14px;">Supper Value Deals - Save more
                                        with coupons</li>
                                    <li style="margin: 0px; padding: 0px; height: 14px;">Supper Value Deals - Save more
                                        with coupons</li>
                                    <li style="margin: 0px; padding: 0px; height: 14px;">Supper Value Deals - Save more
                                        with coupons</li>
                                    <li style="margin: 0px; padding: 0px; height: 14px;">Supper Value Deals - Save more
                                        with coupons</li>
                                    <li style="margin: 0px; padding: 0px; height: 14px;">Supper Value Deals - Save more
                                        with coupons</li>
                                    <li style="margin: 0px; padding: 0px; height: 14px;">Supper Value Deals - Save more
                                        with coupons</li>
                                    <li style="margin: 0px; padding: 0px; height: 14px;">Supper Value Deals - Save more
                                        with coupons</li>
                                    <li style="margin: 0px; padding: 0px; height: 14px;">Supper Value Deals - Save more
                                        with coupons</li>
                                    <li style="margin: 0px; padding: 0px; height: 14px;">Supper Value Deals - Save more
                                        with coupons</li>
                                    <li style="margin: 0px; padding: 0px; height: 14px;">Supper Value Deals - Save more
                                        with coupons</li>
                                    <li style="margin: 0px; padding: 0px; height: 14px;">Supper Value Deals - Save more
                                        with coupons</li>
                                    <li style="margin: 0px; padding: 0px; height: 14px;">Supper Value Deals - Save more
                                        with coupons</li>
                                    <li style="margin: 0px; padding: 0px; height: 14px;">Supper Value Deals - Save more
                                        with coupons</li>
                                    <li style="margin: 0px; padding: 0px; height: 14px;">Supper Value Deals - Save more
                                        with coupons</li>
                                    <li style="margin: 0px; padding: 0px; height: 14px;">Supper Value Deals - Save more
                                        with coupons</li>
                                    <li style="margin: 0px; padding: 0px; height: 14px;">Supper Value Deals - Save more
                                        with coupons</li>
                                    <li style="margin: 0px; padding: 0px; height: 14px;">Supper Value Deals - Save more
                                        with coupons</li>
                                    <li style="margin: 0px; padding: 0px; height: 14px;">Supper Value Deals - Save more
                                        with coupons</li>
                                    <li style="margin: 0px; padding: 0px; height: 14px;">Supper Value Deals - Save more
                                        with coupons</li>
                                    <li style="margin: 0px; padding: 0px; height: 14px;">Supper Value Deals - Save more
                                        with coupons</li>
                                    <li style="margin: 0px; padding: 0px; height: 14px;">Supper Value Deals - Save more
                                        with coupons</li>
                                    <li style="margin: 0px; padding: 0px; height: 14px;">Supper Value Deals - Save more
                                        with coupons</li>
                                    <li style="margin: 0px; padding: 0px; height: 14px;">Supper Value Deals - Save more
                                        with coupons</li>
                                    <li style="margin: 0px; padding: 0px; height: 14px;">Supper Value Deals - Save more
                                        with coupons</li>
                                    <li style="margin: 0px; padding: 0px; height: 14px;">Supper Value Deals - Save more
                                        with coupons</li>
                                    <li style="margin: 0px; padding: 0px; height: 14px;">Supper Value Deals - Save more
                                        with coupons</li>
                                    <li style="margin: 0px; padding: 0px; height: 14px;">Supper Value Deals - Save more
                                        with coupons</li>
                                    <li style="margin: 0px; padding: 0px; height: 14px;">Supper Value Deals - Save more
                                        with coupons</li>
                                    <li style="margin: 0px; padding: 0px; height: 14px;">Supper Value Deals - Save more
                                        with coupons</li>
                                    <li style="margin: 0px; padding: 0px; height: 14px;">Supper Value Deals - Save more
                                        with coupons</li>
                                    <li style="margin: 0px; padding: 0px; height: 14px;">Supper Value Deals - Save more
                                        with coupons</li>
                                    <li style="margin: 0px; padding: 0px; height: 14px;">Supper Value Deals - Save more
                                        with coupons</li>
                                    <li style="margin: 0px; padding: 0px; height: 14px;">Supper Value Deals - Save more
                                        with coupons</li>
                                    <li style="margin: 0px; padding: 0px; height: 14px;">Supper Value Deals - Save more
                                        with coupons</li>
                                    <li style="margin: 0px; padding: 0px; height: 14px;">Supper Value Deals - Save more
                                        with coupons</li>
                                    <li style="margin: 0px; padding: 0px; height: 14px; opacity: 0.999645;">Supper Value
                                        Deals - Save more with coupons</li>
                                    <li style="margin: 0px; padding: 0px; height: 14px; opacity: 0.999645;">Supper Value
                                        Deals - Save more with coupons</li>
                                    <li style="margin: 0px; padding: 0px; height: 14px; opacity: 0.999645;">Supper Value
                                        Deals - Save more with coupons</li>
                                    <li style="margin: 0px; padding: 0px; height: 14px; opacity: 0.999645;">Supper Value
                                        Deals - Save more with coupons</li>
                                    <li style="margin: 0px; padding: 0px; height: 14px; opacity: 0.999645;">Supper Value
                                        Deals - Save more with coupons</li>
                                    <li style="margin: 0px; padding: 0px; height: 14px; opacity: 0.999645;">Supper Value
                                        Deals - Save more with coupons</li>
                                    <li style="margin: 0px; padding: 0px; height: 14px; opacity: 0.999645;">Supper Value
                                        Deals - Save more with coupons</li>
                                    <li style="margin: 0px; padding: 0px; height: 14px; opacity: 0.999645;">Supper Value
                                        Deals - Save more with coupons</li>
                                    <li style="margin: 0px; padding: 0px; height: 14px; opacity: 0.999645;">Supper Value
                                        Deals - Save more with coupons</li>
                                    <li style="margin: 0px; padding: 0px; height: 14px; opacity: 0.999645;">Supper Value
                                        Deals - Save more with coupons</li>
                                    <li style="margin: 0px; padding: 0px; height: 14px; opacity: 0.999645;">Supper Value
                                        Deals - Save more with coupons</li>
                                    <li style="margin: 0px; padding: 0px; height: 14px; opacity: 0.999645;">Supper Value
                                        Deals - Save more with coupons</li>
                                    <li style="margin: 0px; padding: 0px; height: 14px; opacity: 0.999645;">Supper Value
                                        Deals - Save more with coupons</li>
                                    <li style="margin: 0px; padding: 0px; height: 14px; opacity: 0.999645;">Supper Value
                                        Deals - Save more with coupons</li>
                                    <li style="margin: 0px; padding: 0px; height: 14px; opacity: 0.999645;">Supper Value
                                        Deals - Save more with coupons</li>
                                    <li style="margin: 0px; padding: 0px; height: 14px; opacity: 0.999645;">Supper Value
                                        Deals - Save more with coupons</li>
                                    <li style="margin: 0px; padding: 0px; height: 14px; opacity: 0.999645;">Supper Value
                                        Deals - Save more with coupons</li>
                                    <li style="margin: 0px; padding: 0px; height: 14px; opacity: 0.999645;">Supper Value
                                        Deals - Save more with coupons</li>
                                    <li style="margin: 0px; padding: 0px; height: 14px; opacity: 0.999645;">Supper Value
                                        Deals - Save more with coupons</li>
                                    <li style="margin: 0px; padding: 0px; height: 14px; opacity: 0.999645;">Supper Value
                                        Deals - Save more with coupons</li>
                                    <li style="margin: 0px; padding: 0px; height: 14px; opacity: 0.999645;">Supper Value
                                        Deals - Save more with coupons</li>
                                    <li style="margin: 0px; padding: 0px; height: 14px; opacity: 0.999645;">Supper Value
                                        Deals - Save more with coupons</li>
                                    <li style="margin: 0px; padding: 0px; height: 14px; opacity: 0.999645;">Supper Value
                                        Deals - Save more with coupons</li>
                                    <li style="margin: 0px; padding: 0px; height: 14px; opacity: 0.999645;">Supper Value
                                        Deals - Save more with coupons</li>
                                    <li style="margin: 0px; padding: 0px; height: 14px; opacity: 0.999645;">Supper Value
                                        Deals - Save more with coupons</li>
                                    <li style="margin: 0px; padding: 0px; height: 14px; opacity: 0.999645;">Supper Value
                                        Deals - Save more with coupons</li>
                                    <li style="margin: 0px; padding: 0px; height: 14px; opacity: 0.999645;">Supper Value
                                        Deals - Save more with coupons</li>
                                    <li style="margin: 0px; padding: 0px; height: 14px; opacity: 0.999645;">Supper Value
                                        Deals - Save more with coupons</li>
                                    <li style="margin: 0px; padding: 0px; height: 14px; opacity: 0.999645;">Supper Value
                                        Deals - Save more with coupons</li>
                                    <li style="margin: 0px; padding: 0px; height: 14px; opacity: 0.999645;">Supper Value
                                        Deals - Save more with coupons</li>
                                    <li style="margin: 0px; padding: 0px; height: 14px; opacity: 0.999645;">Supper Value
                                        Deals - Save more with coupons</li>
                                    <li style="margin: 0px; padding: 0px; height: 14px; opacity: 0.999645;">Supper Value
                                        Deals - Save more with coupons</li>
                                    <li style="margin: 0px; padding: 0px; height: 14px; opacity: 0.999645;">Supper Value
                                        Deals - Save more with coupons</li>
                                    <li style="margin: 0px; padding: 0px; height: 14px; opacity: 0.999645;">Supper Value
                                        Deals - Save more with coupons</li>
                                    <li style="margin: 0px; padding: 0px; height: 14px; opacity: 0.999645;">Supper Value
                                        Deals - Save more with coupons</li>
                                    <li style="margin: 0px; padding: 0px; height: 14px; opacity: 0.999645;">Supper Value
                                        Deals - Save more with coupons</li>
                                    <li style="margin: 0px; padding: 0px; height: 14px; opacity: 0.999645;">Supper Value
                                        Deals - Save more with coupons</li>
                                    <li style="margin: 0px; padding: 0px; height: 14px; opacity: 0.999645;">Supper Value
                                        Deals - Save more with coupons</li>
                                    <li style="margin: 0px; padding: 0px; height: 14px; opacity: 0.999645;">Supper Value
                                        Deals - Save more with coupons</li>
                                    <li style="margin: 0px; padding: 0px; height: 14px; opacity: 0.999645;">Supper Value
                                        Deals - Save more with coupons</li>
                                    <li style="margin: 0px; padding: 0px; height: 14px; opacity: 0.999645;">Supper Value
                                        Deals - Save more with coupons</li>
                                    <li style="margin: 0px; padding: 0px; height: 14px; opacity: 0.999645;">Supper Value
                                        Deals - Save more with coupons</li>
                                    <li style="margin: 0px; padding: 0px; height: 14px; opacity: 0.999645;">Supper Value
                                        Deals - Save more with coupons</li>
                                    <li style="margin: 0px; padding: 0px; height: 14px; opacity: 0.999645;">Supper Value
                                        Deals - Save more with coupons</li>
                                    <li style="margin: 0px; padding: 0px; height: 14px; opacity: 0.999645;">Supper Value
                                        Deals - Save more with coupons</li>
                                    <li style="margin: 0px; padding: 0px; height: 14px; opacity: 0.999645;">Supper Value
                                        Deals - Save more with coupons</li>
                                    <li style="margin: 0px; padding: 0px; height: 14px; opacity: 0.999645;">Supper Value
                                        Deals - Save more with coupons</li>
                                    <li style="margin: 0px; padding: 0px; height: 14px; opacity: 0.999645;">Supper Value
                                        Deals - Save more with coupons</li>
                                    <li style="margin: 0px; padding: 0px; height: 14px; opacity: 0.999645;">Supper Value
                                        Deals - Save more with coupons</li>
                                    <li style="margin: 0px; padding: 0px; height: 14px; opacity: 0.999645;">Supper Value
                                        Deals - Save more with coupons</li>
                                    <li style="margin: 0px; padding: 0px; height: 14px; opacity: 0.999645;">Supper Value
                                        Deals - Save more with coupons</li>
                                    <li style="margin: 0px; padding: 0px; height: 14px; opacity: 0.999645;">Supper Value
                                        Deals - Save more with coupons</li>
                                    <li style="margin: 0px; padding: 0px; height: 14px; opacity: 0.999645;">Supper Value
                                        Deals - Save more with coupons</li>
                                    <li style="margin: 0px; padding: 0px; height: 14px; opacity: 0.999645;">Supper Value
                                        Deals - Save more with coupons</li>
                                    <li style="margin: 0px; padding: 0px; height: 14px; opacity: 0.999645;">Supper Value
                                        Deals - Save more with coupons</li>
                                    <li style="margin: 0px; padding: 0px; height: 14px; opacity: 0.999645;">Supper Value
                                        Deals - Save more with coupons</li>
                                    <li style="margin: 0px; padding: 0px; height: 14px; opacity: 0.999645;">Supper Value
                                        Deals - Save more with coupons</li>
                                    <li style="margin: 0px; padding: 0px; height: 14px; opacity: 0.999645;">Supper Value
                                        Deals - Save more with coupons</li>
                                    <li style="margin: 0px; padding: 0px; height: 14px; opacity: 0.999645;">Supper Value
                                        Deals - Save more with coupons</li>
                                    <li style="margin: 0px; padding: 0px; height: 14px; opacity: 0.999645;">Supper Value
                                        Deals - Save more with coupons</li>
                                    <li style="margin: 0px; padding: 0px; height: 14px; opacity: 0.999645;">Supper Value
                                        Deals - Save more with coupons</li>
                                    <li style="margin: 0px; padding: 0px; height: 14px; opacity: 0.999645;">Supper Value
                                        Deals - Save more with coupons</li>
                                    <li style="margin: 0px; padding: 0px; height: 14px; opacity: 0.999645;">Supper Value
                                        Deals - Save more with coupons</li>
                                    <li style="margin: 0px; padding: 0px; height: 14px; opacity: 0.999645;">Supper Value
                                        Deals - Save more with coupons</li>
                                    <li style="margin: 0px; padding: 0px; height: 14px; opacity: 0.999645;">Supper Value
                                        Deals - Save more with coupons</li>
                                    <li style="margin: 0px; padding: 0px; height: 14px; opacity: 0.999645;">Supper Value
                                        Deals - Save more with coupons</li>
                                    <li style="margin: 0px; padding: 0px; height: 14px; opacity: 0.999645;">Supper Value
                                        Deals - Save more with coupons</li>
                                    <li style="margin: 0px; padding: 0px; height: 14px; opacity: 0.999645;">Supper Value
                                        Deals - Save more with coupons</li>
                                    <li style="margin: 0px; padding: 0px; height: 14px; opacity: 0.999645;">Supper Value
                                        Deals - Save more with coupons</li>
                                    <li style="margin: 0px; padding: 0px; height: 14px; opacity: 0.999645;">Supper Value
                                        Deals - Save more with coupons</li>
                                    <li style="margin: 0px; padding: 0px; height: 14px; opacity: 0.999645;">Supper Value
                                        Deals - Save more with coupons</li>
                                    <li style="margin: 0px; padding: 0px; height: 14px; opacity: 0.999645;">Supper Value
                                        Deals - Save more with coupons</li>
                                    <li style="margin: 0px; padding: 0px; height: 14px; opacity: 0.999645;">Supper Value
                                        Deals - Save more with coupons</li>
                                    <li style="margin: 0px; padding: 0px; height: 14px; opacity: 0.999645;">Supper Value
                                        Deals - Save more with coupons</li>
                                    <li style="margin: 0px; padding: 0px; height: 14px; opacity: 0.999645;">Supper Value
                                        Deals - Save more with coupons</li>
                                    <li style="margin: 0px; padding: 0px; height: 14px; opacity: 0.999645;">Supper Value
                                        Deals - Save more with coupons</li>
                                    <li style="margin: 0px; padding: 0px; height: 14px; opacity: 0.999645;">Supper Value
                                        Deals - Save more with coupons</li>
                                    <li style="margin: 0px; padding: 0px; height: 14px; opacity: 0.999645;">Supper Value
                                        Deals - Save more with coupons</li>
                                    <li style="margin: 0px; padding: 0px; height: 14px; opacity: 0.999645;">Supper Value
                                        Deals - Save more with coupons</li>
                                    <li style="margin: 0px; padding: 0px; height: 14px; opacity: 0.999645;">Supper Value
                                        Deals - Save more with coupons</li>
                                    <li style="margin: 0px; padding: 0px; height: 14px; opacity: 0.999645;">Supper Value
                                        Deals - Save more with coupons</li>
                                    <li style="margin: 0px; padding: 0px; height: 14px; opacity: 0.999645;">Supper Value
                                        Deals - Save more with coupons</li>
                                    <li style="margin: 0px; padding: 0px; height: 14px; opacity: 0.999645;">Supper Value
                                        Deals - Save more with coupons</li>
                                    <li style="margin: 0px; padding: 0px; height: 14px; opacity: 0.999645;">Supper Value
                                        Deals - Save more with coupons</li>
                                    <li style="margin: 0px; padding: 0px; height: 14px; opacity: 0.999645;">Supper Value
                                        Deals - Save more with coupons</li>
                                    <li style="margin: 0px; padding: 0px; height: 14px; opacity: 0.999645;">Supper Value
                                        Deals - Save more with coupons</li>
                                    <li style="margin: 0px; padding: 0px; height: 14px; opacity: 0.999645;">Supper Value
                                        Deals - Save more with coupons</li>
                                    <li style="margin: 0px; padding: 0px; height: 14px; opacity: 0.999645;">Supper Value
                                        Deals - Save more with coupons</li>
                                    <li style="margin: 0px; padding: 0px; height: 14px;">Supper Value Deals - Save more
                                        with coupons</li>
                                    <li style="margin: 0px; padding: 0px; height: 14px;">100% Secure delivery without
                                        contacting the courier</li>
                                    <li style="margin: 0px; padding: 0px; height: 14px;">Supper Value Deals - Save more
                                        with coupons</li>
                                    <li style="margin: 0px; padding: 0px; height: 14px;">Supper Value Deals - Save more
                                        with coupons</li>
                                    <li style="margin: 0px; padding: 0px; height: 14px;">Supper Value Deals - Save more
                                        with coupons</li>
                                    <li style="margin: 0px; padding: 0px; height: 14px;">Supper Value Deals - Save more
                                        with coupons</li>
                                    <li style="margin: 0px; padding: 0px; height: 14px;">Supper Value Deals - Save more
                                        with coupons</li>
                                    <li style="margin: 0px; padding: 0px; height: 14px;">Supper Value Deals - Save more
                                        with coupons</li>
                                    <li style="margin: 0px; padding: 0px; height: 14px;">Supper Value Deals - Save more
                                        with coupons</li>
                                    <li style="margin: 0px; padding: 0px; height: 14px;">Supper Value Deals - Save more
                                        with coupons</li>
                                    <li style="margin: 0px; padding: 0px; height: 14px;">Supper Value Deals - Save more
                                        with coupons</li>
                                    <li style="margin: 0px; padding: 0px; height: 14px;">Supper Value Deals - Save more
                                        with coupons</li>
                                    <li style="margin: 0px; padding: 0px; height: 14px;">Supper Value Deals - Save more
                                        with coupons</li>
                                    <li style="margin: 0px; padding: 0px; height: 14px;">Supper Value Deals - Save more
                                        with coupons</li>
                                    <li style="margin: 0px; padding: 0px; height: 14px;">Supper Value Deals - Save more
                                        with coupons</li>
                                    <li style="margin: 0px; padding: 0px; height: 14px;">Supper Value Deals - Save more
                                        with coupons</li>
                                    <li style="margin: 0px; padding: 0px; height: 14px;">Supper Value Deals - Save more
                                        with coupons</li>
                                    <li style="margin: 0px; padding: 0px; height: 14px;">Supper Value Deals - Save more
                                        with coupons</li>
                                    <li style="margin: 0px; padding: 0px; height: 14px;">Supper Value Deals - Save more
                                        with coupons</li>
                                    <li style="margin: 0px; padding: 0px; height: 14px;">Supper Value Deals - Save more
                                        with coupons</li>
                                    <li style="margin: 0px; padding: 0px; height: 14px;">Supper Value Deals - Save more
                                        with coupons</li>
                                    <li style="margin: 0px; padding: 0px; height: 14px;">Supper Value Deals - Save more
                                        with coupons</li>
                                    <li style="margin: 0px; padding: 0px; height: 14px;">Supper Value Deals - Save more
                                        with coupons</li>
                                    <li style="margin: 0px; padding: 0px; height: 14px;">Supper Value Deals - Save more
                                        with coupons</li>
                                    <li style="margin: 0px; padding: 0px; height: 14px;">Supper Value Deals - Save more
                                        with coupons</li>
                                    <li style="margin: 0px; padding: 0px; height: 14px;">Supper Value Deals - Save more
                                        with coupons</li>
                                    <li style="margin: 0px; padding: 0px; height: 14px;">Supper Value Deals - Save more
                                        with coupons</li>
                                    <li style="margin: 0px; padding: 0px; height: 14px;">Supper Value Deals - Save more
                                        with coupons</li>
                                    <li style="margin: 0px; padding: 0px; height: 14px;">Supper Value Deals - Save more
                                        with coupons</li>
                                    <li style="margin: 0px; padding: 0px; height: 14px;">Supper Value Deals - Save more
                                        with coupons</li>
                                    <li style="margin: 0px; padding: 0px; height: 14px;">Supper Value Deals - Save more
                                        with coupons</li>
                                    <li style="margin: 0px; padding: 0px; height: 14px;">Supper Value Deals - Save more
                                        with coupons</li>
                                    <li style="margin: 0px; padding: 0px; height: 14px;">Supper Value Deals - Save more
                                        with coupons</li>
                                    <li style="margin: 0px; padding: 0px; height: 14px;">Supper Value Deals - Save more
                                        with coupons</li>
                                    <li style="margin: 0px; padding: 0px; height: 14px;">Supper Value Deals - Save more
                                        with coupons</li>
                                    <li style="margin: 0px; padding: 0px; height: 14px;">Supper Value Deals - Save more
                                        with coupons</li>
                                    <li style="margin: 0px; padding: 0px; height: 14px;">Supper Value Deals - Save more
                                        with coupons</li>
                                    <li style="margin: 0px; padding: 0px; height: 14px;">Supper Value Deals - Save more
                                        with coupons</li>
                                    <li style="margin: 0px; padding: 0px; height: 14px;">Supper Value Deals - Save more
                                        with coupons</li>
                                    <li style="margin: 0px; padding: 0px; height: 14px;">Supper Value Deals - Save more
                                        with coupons</li>
                                    <li style="margin: 0px; padding: 0px; height: 14px;">Supper Value Deals - Save more
                                        with coupons</li>
                                    <li style="margin: 0px; padding: 0px; height: 14px;">Supper Value Deals - Save more
                                        with coupons</li>
                                    <li style="margin: 0px; padding: 0px; height: 14px;">Supper Value Deals - Save more
                                        with coupons</li>
                                    <li style="margin: 0px; padding: 0px; height: 14px;">Supper Value Deals - Save more
                                        with coupons</li>
                                    <li style="margin: 0px; padding: 0px; height: 14px;">Supper Value Deals - Save more
                                        with coupons</li>
                                    <li style="margin: 0px; padding: 0px; height: 14px; opacity: 0.991723;">Supper Value
                                        Deals - Save more with coupons</li>
                                    <li style="margin: 0px; padding: 0px; height: 14px; opacity: 0.991723;">Supper Value
                                        Deals - Save more with coupons</li>
                                    <li style="margin: 0px; padding: 0px; height: 14px;">Supper Value Deals - Save more
                                        with coupons</li>
                                    <li style="margin: 0px; padding: 0px; height: 14px;">Supper Value Deals - Save more
                                        with coupons</li>
                                    <li style="margin: 0px; padding: 0px; height: 14px;">Supper Value Deals - Save more
                                        with coupons</li>
                                    <li style="margin: 0px; padding: 0px; height: 14px;">Supper Value Deals - Save more
                                        with coupons</li>
                                    <li style="margin: 0px; padding: 0px; height: 14px;">Supper Value Deals - Save more
                                        with coupons</li>
                                    <li style="margin: 0px; padding: 0px; height: 14px;">Supper Value Deals - Save more
                                        with coupons</li>
                                    <li style="margin: 0px; padding: 0px; height: 14px;">Supper Value Deals - Save more
                                        with coupons</li>
                                    <li style="margin: 0px; padding: 0px; height: 14px;">Supper Value Deals - Save more
                                        with coupons</li>
                                    <li style="margin: 0px; padding: 0px; height: 14px;">Supper Value Deals - Save more
                                        with coupons</li>
                                    <li style="margin: 0px; padding: 0px; height: 14px;">Supper Value Deals - Save more
                                        with coupons</li>
                                    <li style="margin: 0px; padding: 0px; height: 14px;">Supper Value Deals - Save more
                                        with coupons</li>
                                    <li style="margin: 0px; padding: 0px; height: 14px;">Supper Value Deals - Save more
                                        with coupons</li>
                                    <li style="margin: 0px; padding: 0px; height: 14px;">Supper Value Deals - Save more
                                        with coupons</li>
                                    <li style="margin: 0px; padding: 0px; height: 14px;">Supper Value Deals - Save more
                                        with coupons</li>
                                    <li style="margin: 0px; padding: 0px; height: 14px;">Supper Value Deals - Save more
                                        with coupons</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-4">
                        <div class="header-info header-info-right">
                            <ul>
                                <li>Need help? Call Us: <strong class="text-brand"> + 254 7123456</strong></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="header-middle header-middle-ptb-1 d-none d-lg-block">
            <div class="container">
                <div class="header-wrap">
                    <div class="logo logo-width-1">
                        <Link href="/"><img src="../../../assets/shop/imgs/theme/flogo.png" alt="logo"></Link>
                    </div>
                    <div class="header-right">
                        <div class="search-style-2">
                            <form action="#">
                                <input type="text" placeholder="Search for items...">
                            </form>
                        </div>
                        <div class="header-action-right">
                            <div class="header-action-2">
                                <div class="header-action-icon-2">
                                    <a class="mini-cart-icon" href="#">
                                        <img alt="Binasta Limited"
                                            src="../../../assets/shop/imgs/theme/icons/icon-cart.svg">
                                        <span class="pro-count blue">{{ cartItems.length }}</span>
                                    </a>
                                    <Link href="/checkout"><span class="lable">Cart</span></Link>
                                    <div class="cart-dropdown-wrap cart-dropdown-hm2">
                                        <ul>
                                            <li v-for="item in cartItems" :key="item.name">
                                                <div class="shopping-cart-img">
                                                    <Link :href="`/products/${item.product.slug}`">
                                                    <img :alt="item.product.name"
                                                        src="../../../assets/shop/imgs/theme/img_loading.gif"
                                                        class="lazy"
                                                        :data-src="`/storage/${item.product.images[0].url}`">
                                                    </Link>
                                                </div>
                                                <div class="shopping-cart-title">
                                                    <h4>
                                                        <Link :href="`/products/${item.product.slug}`">{{
                                                            item.product.name
                                                        }}</Link>
                                                    </h4>
                                                    <h4><span>{{ item.qty }} × </span>ksh.{{
                                                        item.product.discounts.length ? ((100 -
                                                            parseInt(item.product.discounts[0].percentage)) / 100) *
                                                            parseFloat(item.option.selling_price) :
                                                            item.option.selling_price
                                                    }}</h4>
                                                </div>
                                                <div class="shopping-cart-delete" @click="removeCart(item)">
                                                    <a href="#"><i class="fi-rs-cross-small"></i></a>
                                                </div>
                                            </li>
                                        </ul>
                                        <div class="shopping-cart-footer">
                                            <div class="shopping-cart-total">
                                                <h4>Total
                                                    <span>ksh.
                                                        {{
                                                            cartItems.reduce((acc, curr) => {
                                                                return acc += curr.product.discounts.length ? (((100 -
                                                                parseInt(curr.product.discounts[0].percentage)) / 100) *
                                                                parseFloat(curr.option.selling_price)) * parseInt(curr.qty) :
                                                                parseFloat(curr.option.selling_price) * parseInt(curr.qty);
                                                            }, 0)
                                                        }}
                                                    </span>
                                                </h4>
                                            </div>
                                            <div class="shopping-cart-button">
                                                <Link href="/checkout">Checkout</Link>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="header-action-icon-2">
                                    <Link href="page-account.html">
                                    <img class="svgInject" alt="Nest"
                                        src="../../../assets/shop/imgs/theme/icons/icon-user.svg">
                                    </Link>
                                    <a href="page-account.html"><span class="lable ml-0">Account</span></a>
                                    <div class="cart-dropdown-wrap cart-dropdown-hm2 account-dropdown">
                                        <ul v-if="$page.props.auth.user">
                                            <li>
                                                <a href="https://dashboard.binasta.co.ke/orders"><i class="fi fi-rs-user mr-10"></i>My
                                                    Orders</a>
                                            </li>
                                            <li>
                                                <Link href="/logout" method="post" as="button"><i class="fi fi-rs-sign-out mr-10"></i>Sign
                                                    out</Link>
                                            </li>
                                        </ul>
                                        <ul v-else>
                                            <li>
                                                <a href="https://dashboard.binasta.co.ke/login"><i class="fi fi-rs-user mr-10"></i>Log In</a>
                                            </li>
                                            <li>
                                                <a href="https://dashboard.binasta.co.ke/register"><i class="fi fi-rs-user mr-10"></i>Register</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="header-bottom header-bottom-bg-color sticky-bar">
            <div class="container">
                <div class="header-wrap header-space-between position-relative">
                    <div class="logo logo-width-1 d-block d-lg-none">
                        <Link href="/" class="router-link-active router-link-exact-active" aria-current="page"><img
                            src="../../../assets/shop/imgs/theme/flogo.png" alt="logo"
                            style="width: 82px; min-width: 82px;"></Link>
                    </div>
                    <div class="header-action-icon-2 d-block d-lg-none">
                        <div class="burger-icon burger-icon-white"></div>
                    </div>
                    <div class="header-action-right d-block d-lg-none">
                        <div class="header-action-2" style="margin-right: 5px;">
                            <div class="header-action-icon-2"><a class="mini-cart-icon" href="#"><img alt="Nest"
                                        src="../../../assets/shop/imgs/theme/icons/icon-cart.svg"><span
                                        class="pro-count white">{{ cartItems.length }}</span></a>
                                <div class="cart-dropdown-wrap cart-dropdown-hm2">
                                    <ul>
                                        <li v-for="item in cartItems" :key="item.product.id">
                                            <div class="shopping-cart-img">
                                                <Link href="/products">
                                                <img :alt="item.product.name"
                                                    src="../../../assets/shop/imgs/theme/img_loading.gif"
                                                    :data-src="`/storage/${item.product.images[0].url}`">
                                                </Link>
                                            </div>
                                            <div class="shopping-cart-title">
                                                <h4>
                                                    <Link href="/products">{{ item.product.name }} - {{
                                                        item.option.variation
                                                    }}</Link>
                                                </h4>
                                                <h4><span>{{ item.qty }} × </span>ksh.{{ item.product.discounts.length ? ((100 -
                                                            parseInt(item.product.discounts[0].percentage)) / 100) *
                                                            parseFloat(item.option.selling_price) :
                                                            item.option.selling_price }}
                                                </h4>
                                            </div>
                                            <div class="shopping-cart-delete">
                                                <a href="#"><i class="fi-rs-cross-small"></i></a>
                                            </div>
                                        </li>
                                    </ul>
                                    <div class="shopping-cart-footer">
                                        <div class="shopping-cart-total">
                                            <h4>Total <span>ksh.
                                                {{
                                                    cartItems.reduce((acc, curr) => {
                                                        return acc += curr.product.discounts.length ? (((100 -
                                                        parseInt(curr.product.discounts[0].percentage)) / 100) *
                                                        parseFloat(curr.option.selling_price)) * parseInt(curr.qty) :
                                                        parseFloat(curr.option.selling_price) * parseInt(curr.qty);
                                                    }, 0)
                                                }}</span></h4>
                                        </div>
                                        <div class="shopping-cart-button">
                                            <!-- <a href="/_cart" class="">View cart</a> -->
                                            <Link href="/checkout" class="">Checkout</Link>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="header-action-2">
                            <div class="header-action-icon-2">
                                <a href="#">
                                    <img class="svgInject" alt="Nest"
                                        src="../../../assets/shop/imgs/theme/icons/icon-user.svg">
                                </a>
                                    <a href="#"><span class="lable ml-0">Account</span></a>
                                    <div class="cart-dropdown-wrap cart-dropdown-hm2 account-dropdown">
                                        <ul v-if="$page.props.auth.user">
                                            <li>
                                                <a href="https://dashboard.binasta.co.ke/orders"><i class="fi fi-rs-user mr-10"></i>My
                                                    Orders</a>
                                            </li>
                                            <li>
                                                <Link href="/logout" method="post" as="button"><i class="fi fi-rs-sign-out mr-10"></i>Sign
                                                    out</Link>
                                            </li>
                                        </ul>
                                        <ul v-else>
                                            <li>
                                                <a href="https://dashboard.binasta.co.ke/login"><i class="fi fi-rs-user mr-10"></i>Log In</a>
                                            </li>
                                            <li>
                                                <a href="https://dashboard.binasta.co.ke/register"><i class="fi fi-rs-user mr-10"></i>Register</a>
                                            </li>
                                        </ul>
                                    </div>
                            </div>    
                        </div>                
                    </div>
                </div>
            </div>
        </div>
    </header>

</template>
<style scoped>

@media only screen and (max-width: 768px) {
  /* For mobile phones: */
  .header-action-right {
    display: flex !important;
  }
}

</style>