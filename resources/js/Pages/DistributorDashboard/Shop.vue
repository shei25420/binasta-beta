<script setup>
import { Link } from '@inertiajs/inertia-vue3';

import ShopLayout from '@/Layouts/ShopLayout.vue'
defineProps({
    categories: Array,
    products: Array,
});
</script>

<template>
    <ShopLayout>
        <div class="page-header mt-30 mb-50">
            <div class="container">
                <div class="archive-header">
                    <div class="row align-items-center">
                        <div class="col-xl-3">
                            <h1 class="mb-15">Snack</h1>
                            <div class="breadcrumb">
                                <a href="index.html" rel="nofollow"><i class="fi-rs-home mr-5"></i>Home</a>
                                <span></span> Shop <span></span> Snack
                            </div>
                        </div>
                        <!-- <div class="col-xl-9 text-end d-none d-xl-block">
                            <ul class="tags-list">
                                <li class="hover-up">
                                    <a href="blog-category-grid.html"><i class="fi-rs-cross mr-10"></i>Cabbage</a>
                                </li>
                                <li class="hover-up active">
                                    <a href="blog-category-grid.html"><i class="fi-rs-cross mr-10"></i>Broccoli</a>
                                </li>
                                <li class="hover-up">
                                    <a href="blog-category-grid.html"><i class="fi-rs-cross mr-10"></i>Artichoke</a>
                                </li>
                                <li class="hover-up">
                                    <a href="blog-category-grid.html"><i class="fi-rs-cross mr-10"></i>Celery</a>
                                </li>
                                <li class="hover-up mr-0">
                                    <a href="blog-category-grid.html"><i class="fi-rs-cross mr-10"></i>Spinach</a>
                                </li>
                            </ul>
                        </div> -->
                    </div>
                </div>
            </div>
        </div>
        <div class="container mb-30" style="transform: none">
            <div class="row" style="transform: none">
                <div class="col-lg-4-5">
                    <div class="shop-product-fillter">
                        <div class="totall-product">
                            <p>
                                We found
                                <strong class="text-brand">{{ products.length }}</strong> items for
                                you!
                            </p>
                        </div>
                    </div>
                    <div class="row product-grid">
                        <!--end product card-->
                        <div class="col-lg-1-5 col-md-4 col-12 col-sm-6" v-for="product in products" :key="product.id">
                            <div class="product-cart-wrap mb-30 wow animate__ animate__fadeIn animated"
                                data-wow-delay=".1s"
                                style="visibility: visible;animation-delay: 0.1s;animation-name: fadeIn;">
                                <div class="product-img-action-wrap">
                                    <div class="product-img product-img-zoom">
                                        <Link :href="'/products/' + product.slug">
                                        <img class="default-img" :src="
                                            '/storage/' +
                                            product.images[0].url
                                        " alt="" />
                                        <img class="hover-img" :src="
                                            '/storage/' +
                                            product.images[0].url
                                        " alt="" />
                                        </Link>
                                    </div>
                                    <div class="product-badges product-badges-position product-badges-mrg">
                                        <span v-if="product.discounts.length" class="sale">-{{
                                                product.discounts[0].percentage
                                        }}%</span>
                                    </div>
                                </div>
                                <div class="product-content-wrap">
                                    <div class="product-category">
                                        <a href="shop-grid-right.html">{{
                                                product.product_category.name
                                        }}</a>
                                    </div>
                                    <h2>
                                        <Link :href="'/products/' + product.slug">{{ product.name }}</Link>
                                    </h2>
                                    <div class="product-card-bottom">
                                        <div class="product-price">
                                            <span>ksh.{{
                                                    product.discounts.length
                                                        ? ((100 -
                                                            product
                                                                .discounts[0]
                                                                .percentage) /
                                                            100) *
                                                        product
                                                            .product_options[0]
                                                            .selling_price
                                                        : product
                                                            .product_options[0]
                                                            .selling_price
                                            }}</span>
                                            <span v-if="product.discounts.length" class="old-price">${{
                                                    product.product_options[0]
                                                        .selling_price
                                            }}</span>
                                        </div>
                                        <div class="add-cart">
                                            <Link class="add" :href="
                                                '/products/' + product.slug
                                            "><i class="fi-rs-shopping-cart mr-5"></i>View
                                            </Link>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--product grid-->
                    <!-- <div class="pagination-area mt-20 mb-20">
                        <nav aria-label="Page navigation example">
                            <ul class="pagination justify-content-start">
                                <li class="page-item">
                                    <a class="page-link" href="#"><i class="fi-rs-arrow-small-left"></i></a>
                                </li>
                                <li class="page-item">
                                    <a class="page-link" href="#">1</a>
                                </li>
                                <li class="page-item active">
                                    <a class="page-link" href="#">2</a>
                                </li>
                                <li class="page-item">
                                    <a class="page-link" href="#">3</a>
                                </li>
                                <li class="page-item">
                                    <a class="page-link dot" href="#">...</a>
                                </li>
                                <li class="page-item">
                                    <a class="page-link" href="#">6</a>
                                </li>
                                <li class="page-item">
                                    <a class="page-link" href="#"><i class="fi-rs-arrow-small-right"></i></a>
                                </li>
                            </ul>
                        </nav>
                    </div> -->
                    <!-- <section class="section-padding pb-5" v-if="discounts.length">
                        <div class="section-title">
                            <h3 class="">Deals Of The Day</h3>
                            <a class="show-all" href="shop-grid-right.html">
                                All Deals
                                <i class="fi-rs-angle-right"></i>
                            </a>
                        </div>
                        <div class="row">
                            <div class="col-xl-3 col-lg-4 col-md-6" v-for="discount in discounts" :key="discount.id">
                                <div class="product-cart-wrap style-2">
                                    <div class="product-img-action-wrap">
                                        <div class="product-img">
                                            <Link :href="'/products/' + discount.product.slug">
                                            <img :src="'/storage/' + discount.product.images[0].url" alt="" />
                                            </Link>
                                        </div>
                                    </div>
                                    <div class="product-content-wrap">
                                        <div class="deals-countdown-wrap">
                                            <div class="deals-countdown" :data-countdown="discount.end_date"></div>
                                        </div>
                                        <div class="deals-content">
                                            <h2>
                                                <Link :href="'/products/' + discount.product.slug">{{
                                                        discount.product.name
                                                }}</Link>
                                            </h2>
                                            <div class="product-card-bottom">
                                                <div class="product-price">
                                                    <span>ksh.{{ ((100 - discount.percentage) / 100) * discount.product.product_options[0].selling_price }}</span>
                                                    <span class="old-price">ksh.{{  discount.product.product_options[0].selling_price  }}</span>
                                                </div>
                                                <div class="add-cart">
                                                    <Link class="add" :href="'/products/' + discount.product.slug"><i
                                                            class="fi-rs-shopping-cart mr-5"></i>View
                                                    </Link>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section> -->
                    <!--End Deals-->
                </div>
                <div class="col-lg-1-5 primary-sidebar sticky-sidebar" style="position: relative; overflow: visible; box-sizing: border-box; min-height: 1px;">
                    <!-- Fillter By Price -->

                    <!-- Product sidebar Widget -->
                    <div class="theiaStickySidebar" style="padding-top: 0px; padding-bottom: 1px; position: static; transform: none; top: 0px; left: 12.0156px;">
                        <div class="sidebar-widget widget-category-2 mb-30">
                            <h5 class="section-title style-1 mb-30">
                                Category
                            </h5>
                            <ul>
                                <li v-for="category in categories" :key="category.id">
                                    <a href="shop-grid-right.html">
                                        <img :src="
                                            '/storage/' + category.image.url
                                        " :alt="category.name" />{{ category.name }}</a><span class="count">{{
        category.products_count
}}</span>
                                </li>
                            </ul>
                        </div>
                        <div class="banner-img wow fadeIn mb-lg-0 animated d-lg-block d-none animated"
                            style="visibility: visible">
                            <img src="../../../assets/shop/imgs/banner/banner-11.png" alt="" />
                            <div class="banner-text">
                                <span>Oganic</span>
                                <h4>
                                    Save 17% <br />
                                    on <span class="text-brand">Oganic</span><br />
                                    Juice
                                </h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </ShopLayout>
</template>
