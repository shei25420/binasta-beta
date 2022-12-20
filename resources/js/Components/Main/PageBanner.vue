<script setup>
import { Link } from '@inertiajs/inertia-vue3';

defineProps({
    header: String
});
</script>

<template>
    <section class="page-banner">
            <div class="container">
                <div class="row align-items-center justify-content-center page-bn-height">
                    <div class="col-12 text-center">
                        <h3>{{ header }}</h3>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb site-breadcumb-1 justify-content-center">
                                <li class="breadcrumb-item">
                                    <Link href="/" class="">Home</Link>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">{{ header }}</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
    </section>
</template>