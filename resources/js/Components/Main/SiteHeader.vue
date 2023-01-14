<script setup>
import { Link } from '@inertiajs/inertia-vue3'
</script>

<template>
    <div class="site-header">
        <div class="top-header">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 col-md-8">
                        <ul class="text-center text-md-left lft">
                            <li><a href="mailto:spellbit@gmail.com"><i class="icofont">ui_message</i>nfo@example.com</a>
                            </li>
                            <li><i class="icofont">ui_timer</i>Mom-Sat 8.00- 18.00</li>
                        </ul>
                    </div><!-- end top header single -->
                    <div class="col-lg-6 col-md-4">
                        <ul class="text-center text-md-right rgt">
                            <li><a href="#"><i class="icofont">facebook</i></a></li>
                            <li><a href="#"><i class="icofont">twitter</i></a></li>
                            <li><a href="#"><i class="icofont">google_plus</i></a></li>
                            <li><a href="#"><i class="icofont">linkedin</i></a></li>
                        </ul>
                    </div><!-- end top header single -->
                </div>
            </div>
        </div> <!-- end top header -->
        <nav class="navbar">
            <div class="container">
                <Link href="/" class="navbar-brand logo"><img src="/main/images/logo/logo.png" style="width: 165px !important" width="165px" alt=""></Link>
                <div class="ml-auto main-menu">
                    <ul>
                        <li><Link href="/">Home</Link></li>
                        <li><a href="https://shop.binasta.co.ke">Shop</a></li>
                        <li><Link href="/how-it-works">How It Works</Link></li>
                        <li><Link href="/blog">Blog</Link></li>
                        <li><Link href="/contact">Contacts</Link></li>
                    </ul>
                </div> <!-- end main-menu -->
                <div class="mobile-menu ml-auto">
                    <div class="menu-click">
                        <span></span>
                        <span></span>
                        <span></span>
                    </div>
                </div>

            </div>
        </nav>
    </div>
</template>

<style>

</style>