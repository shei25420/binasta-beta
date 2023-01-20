<script setup>
import { Link } from '@inertiajs/inertia-vue3';

import ShoppingCart from '@/Components/Distributor/ShoppingCart.vue';
</script>
    
<template>
    <div class="header">
    <div class="menu-toggle-btn"> <!-- Menu close button for mobile devices -->
        <a href="#">
            <i class="bi bi-list"></i>
        </a>
    </div>
    <!-- Logo -->
    <Link href="/" class="logo">
        <img width="100" src="../../../assets/generic_dashboard/flogo.png" alt="logo">
    </Link>
    <!-- ./ Logo -->
    <div class="page-title">Overview</div>
    <form class="search-form">
        <div class="input-group">
            <button class="btn btn-outline-light" type="button" id="button-addon1">
                <i class="bi bi-search"></i>
            </button>
            <input type="text" class="form-control" placeholder="Search..." aria-label="Example text with button addon" aria-describedby="button-addon1">
            <a href="#" class="btn btn-outline-light close-header-search-bar">
                <i class="bi bi-x"></i>
            </a>
        </div>
    </form>
    <div class="header-bar ms-auto">
        <ul class="navbar-nav justify-content-end">
            <ShoppingCart />
            <li class="nav-item">
                <a href="#" class="nav-link nav-link-notify" data-count="2" data-sidebar-target="#notifications">
                    <i class="bi bi-bell icon-lg"></i>
                </a>
            </li>
        </ul>
    </div>
    <!-- Header mobile buttons -->
    <div class="header-mobile-buttons">
        <ul class="navbar-nav justify-content-end">
            <ShoppingCart />
            <li class="nav-item">
                <a href="#" class="nav-link nav-link-notify" data-count="2" data-sidebar-target="#notifications">
                    <i class="bi bi-bell icon-lg"></i>
                </a>
            </li>
        </ul>
    </div>
    <!-- ./ Header mobile buttons -->
</div>
</template>
<style>

</style>