<script setup>
import { ref, onMounted } from 'vue';
import { Link } from '@inertiajs/inertia-vue3';
import 'slick-carousel/slick/slick.js';
import 'magnific-popup/dist/jquery.magnific-popup.js';

import ShopLayout from '@/Layouts/ShopLayout.vue';

const props = defineProps({
    products: Array,
    categories: Array,
    discounts: Array
});

const subscriptionForm = ref({
    email: ""
});

const subscribe = () => {
    fetch('/subscribe', {
        method: 'POST',
        headers: {
            'Accept': 'application/json',
            'Content-Type': 'application/json',
            'X-XSRF-TOKEN': decodeURIComponent(document.cookie.split(";").filter(cookie => cookie.startsWith("XSRF-TOKEN="))[0].split("=")[1])
        },
        body: JSON.stringify({ email: subscriptionForm.value.email })
    })
        .then(res => res.json())
        .then(data => {

        })
        .catch(err => {
            console.log("subsribe err: ", err);
        });
};

onMounted(() => {
    /*------ Hero slider 1 ----*/
    $(".hero-slider-1").slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        fade: true,
        loop: true,
        dots: true,
        arrows: true,
        prevArrow: '<span class="slider-btn slider-prev"><i class="fi-rs-angle-left"></i></span>',
        nextArrow: '<span class="slider-btn slider-next"><i class="fi-rs-angle-right"></i></span>',
        appendArrows: ".hero-slider-1-arrow",
        autoplay: true
    });

    /*Carausel 10 columns*/
    $(".carausel-10-columns").each(function (key, item) {
        var id = $(this).attr("id");
        var sliderID = "#" + id;
        var appendArrowsClassName = "#" + id + "-arrows";

        $(sliderID).slick({
            dots: false,
            infinite: true,
            speed: 1000,
            arrows: true,
            autoplay: false,
            slidesToShow: 10,
            slidesToScroll: 1,
            loop: true,
            adaptiveHeight: true,
            responsive: [
                {
                    breakpoint: 1025,
                    settings: {
                        slidesToShow: 4,
                        slidesToScroll: 1
                    }
                },
                {
                    breakpoint: 768,
                    settings: {
                        slidesToShow: 3,
                        slidesToScroll: 1
                    }
                },
                {
                    breakpoint: 480,
                    settings: {
                        slidesToShow: 2,
                        slidesToScroll: 1
                    }
                }
            ],
            prevArrow: '<span class="slider-btn slider-prev"><i class="fi-rs-arrow-small-left"></i></span>',
            nextArrow: '<span class="slider-btn slider-next"><i class="fi-rs-arrow-small-right"></i></span>',
            appendArrows: appendArrowsClassName
        });
    });
});

</script>

<template>
    <ShopLayout>
        <section class="home-slider position-relative mb-30">
            <div class="container">
                <div class="home-slide-cover mt-30">
                    <div class="hero-slider-1 style-4 dot-style-1 dot-style-1-position-1">
                        <div class="single-hero-slider slider-1 single-animation-wrap">
                            <div class="slider-content">
                                <h1 class="display-2 mb-40">
                                    Don’t miss amazing<br>
                                    grocery deals
                                </h1>
                                <p class="mb-65">Sign up for the daily newsletter</p>
                                <form @submit.prevent="subscribe" class="form-subcriber d-flex">
                                    <input v-model="subscriptionForm.email" type="email"
                                        placeholder="Your emaill address" tabindex="0">
                                    <button class="btn" type="submit" tabindex="0">Subscribe</button>
                                </form>
                            </div>
                        </div>
                        <div class="single-hero-slider slider-2 single-animation-wrap">
                            <div class="slider-content">
                                <h1 class="display-2 mb-40">
                                    Fresh Vegetables<br>
                                    Big discount
                                </h1>
                                <p class="mb-65">Save up to 50% off on your first order</p>
                                <form @submit.prevent="subscribe" class="form-subcriber d-flex">
                                    <input v-model="subscriptionForm.email" type="email"
                                        placeholder="Your emaill address" tabindex="-1">
                                    <button class="btn" type="submit" tabindex="-1">Subscribe</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="popular-categories section-padding">
            <div class="container wow animate__ animate__fadeIn animated"
                style="visibility: visible; animation-name: fadeIn;">
                <div class="section-title">
                    <div class="title">
                        <h3>Featured Categories</h3>
                        <ul class="list-inline nav nav-tabs links">
                            <li v-for="category in props.categories" :key="category.id"
                                class="list-inline-item nav-item">
                                <a class="nav-link" href="shop-grid-right.html">{{ category.name }}</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="carausel-10-columns-cover position-relative">
                    <div class="carausel-10-columns" id="carausel-10-columns">
                        <div v-for="category in props.categories" :key="category.name"
                            class="card-2 bg-12 wow animate__ animate__fadeInUp">
                            <figure class="img-hover-scale overflow-hidden">
                                <a href="shop-grid-right.html" tabindex="-1">
                                    <img :src="'/storage/' + category.image.url" alt=""></a>
                            </figure>
                            <h6><a href="shop-grid-right.html" tabindex="-1">{{ category.name }}</a></h6>
                            <span>{{ category.count }} items</span>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="banners mb-25">
            <div class="container">
                <div class="row">
                    <div class="col-lg-4 col-md-6">
                        <div class="banner-img wow animate__ animate__fadeInUp animated" data-wow-delay="0"
                            style="visibility: visible; animation-name: fadeInUp;">
                            <img src="../../../assets/shop/imgs/banner/banner-1.png" alt="">
                            <div class="banner-text">
                                <h4>
                                    Everyday Fresh &amp; <br>Clean with Our<br>
                                    Products
                                </h4>
                                <a href="shop-grid-right.html" class="btn btn-xs">Shop Now <i
                                        class="fi-rs-arrow-small-right"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="banner-img wow animate__ animate__fadeInUp animated" data-wow-delay=".2s"
                            style="visibility: visible; animation-delay: 0.2s; animation-name: fadeInUp;">
                            <img src="../../../assets/shop/imgs/banner/banner-2.png" alt="">
                            <div class="banner-text">
                                <h4>
                                    Make your Breakfast<br>
                                    Healthy and Easy
                                </h4>
                                <a href="shop-grid-right.html" class="btn btn-xs">Shop Now <i
                                        class="fi-rs-arrow-small-right"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 d-md-none d-lg-flex">
                        <div class="banner-img mb-sm-0 wow animate__ animate__fadeInUp animated" data-wow-delay=".4s"
                            style="visibility: visible; animation-delay: 0.4s; animation-name: fadeInUp;">
                            <img src="../../../assets/shop/imgs/banner/banner-3.png" alt="">
                            <div class="banner-text">
                                <h4>The best Organic <br>Products Online</h4>
                                <a href="shop-grid-right.html" class="btn btn-xs">Shop Now <i
                                        class="fi-rs-arrow-small-right"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="product-tabs section-padding position-relative">
            <div class="container">
                <div class="section-title style-2 wow animate__ animate__fadeIn animated"
                    style="visibility: visible; animation-name: fadeIn;">
                    <h3>Popular Products</h3>
                    <ul class="nav nav-tabs links" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="nav-tab-one" data-bs-toggle="tab"
                                data-bs-target="#tab-one" type="button" role="tab" aria-controls="tab-one"
                                aria-selected="true">All</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button v-for="category in props.categories" :key="category.id" class="nav-link"
                                id="nav-tab-two" data-bs-toggle="tab" data-bs-target="#tab-two" type="button" role="tab"
                                aria-controls="tab-two" aria-selected="false">
                                {{ category.name }}
                            </button>
                        </li>
                    </ul>
                </div>
                <!--End nav-tabs-->
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="tab-one" role="tabpanel" aria-labelledby="tab-one">
                        <div class="row product-grid-4">
                            <div v-for="product in products" :key="product.id"
                                class="col-lg-1-5 col-md-4 col-12 col-sm-6">
                                <div class="product-cart-wrap mb-30 wow animate__ animate__fadeIn animated"
                                    data-wow-delay=".1s"
                                    style="visibility: visible; animation-delay: 0.1s; animation-name: fadeIn;">
                                    <div class="product-img-action-wrap">
                                        <div class="product-img product-img-zoom">
                                            <Link v-if="product.images.length" :href="'products/' + product.slug">
                                                <img class="default-img" :src="'/storage/' + product.images[0].url"
                                                    alt="">
                                                <img class="hover-img" :src="'/storage/' + product.images[1].url"
                                                    alt="">
                                            </Link>
                                        </div>
                                        <div v-if="product.discounts.length" class="product-badges product-badges-position product-badges-mrg">
                                            <span class="hot">-{{ product.discounts[0].percentage }}%</span>
                                        </div>
                                    </div>
                                    <div class="product-content-wrap">
                                        <div class="product-category" style="margin-top: 10px;">
                                            <a href="shop-grid-right.html">{{ product.category }}</a>
                                        </div>
                                        <h2><Link :href="'/products/' + product.slug">{{ product.name }}</Link></h2>
                                        <div>
                                            <div class="product-price">
                                                <span>ksh.{{product.discounts.length ? ((100 - product.discounts[0].percentage) / 100) * product.product_options[0].selling_price  : product.product_options[0].selling_price }}</span>
                                                <span v-if="product.discounts.length" class="old-price">ksh.{{ product.product_options[0].selling_price }}</span>
                                            </div>
                                            <br />
                                            <div class="add-cart">
                                                <Link class="add" :href="'/products/' + product.slug">
                                                    <i class="fi-rs-shopping-cart mr-5"></i>View
                                                </Link>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--end product card-->
                        </div>
                        <!--End product-grid-4-->
                    </div>
                    <!--En tab one-->
                </div>
                <!--End tab-content-->
            </div>
        </section>
        <section class="section-padding pb-5" v-if="discounts.length">
            <div class="container">
                <div class="section-title wow animate__ animate__fadeIn animated" data-wow-delay="0"
                    style="visibility: visible; animation-name: fadeIn;">
                    <h3 class="">Deals Of The Day</h3>
                    <a class="show-all" href="shop-grid-right.html">
                        All Deals
                        <i class="fi-rs-angle-right"></i>
                    </a>
                </div>
                <div class="row">
                    <div class="col-xl-3 col-lg-4 col-md-6" v-for="discount in discounts" :key="discount.id">
                        <div class="product-cart-wrap style-2 wow animate__ animate__fadeInUp animated"
                            data-wow-delay="0" style="visibility: visible; animation-name: fadeInUp;">
                            <div class="product-img-action-wrap">
                                <div class="product-img">
                                    <Link :href="'/products/' + discount.product.slug">
                                        <img :src="'/storage/' + discount.product.images[0].url" alt="">
                                    </Link>
                                </div>
                            </div>
                            <div class="product-content-wrap">
                                <div class="deals-countdown-wrap">
                                    <div class="deals-countdown" :data-countdown="discount.end_date"></div>
                                </div>
                                <div class="deals-content">
                                    <h2><Link :href="'/products/' + discount.product.slug">{{ discount.product.name }}</Link></h2>
                                    <div class="product-card-bottom">
                                        <div class="product-price">
                                            <span>ksh.{{ ((100 - discount.percentage) / 100) * discount.product.product_options[0].selling_price }}</span>
                                            <span class="old-price">ksh.{{  discount.product.product_options[0].selling_price  }}</span>
                                        </div>
                                        <div class="add-cart">
                                            <Link class="add" :href="'/products/' + discount.product.slug">
                                                    <i class="fi-rs-shopping-cart mr-5"></i>View
                                                </Link>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="section-padding mb-30">
            <div class="container">
                <div class="row">
                    <div class="col-xl-3 col-lg-4 col-md-6 mb-sm-5 mb-md-0 wow animate__ animate__fadeInUp animated"
                        data-wow-delay="0" style="visibility: visible; animation-name: fadeInUp;">
                        <h4 class="section-title style-1 mb-30 animated animated">Top Selling</h4>
                        <div class="product-list-small animated animated">
                            <article v-for="product in products" :key="product.id" class="row align-items-center hover-up">
                                <figure class="col-md-4 mb-0">
                                    <Link :href="'/products/' + product.slug"><img
                                            :src="'/storage/' + product.images[0].url" alt=""></Link>
                                </figure>
                                <div class="col-md-8 mb-0">
                                    <h6>
                                        <Link :href="'/products/' + product.slug">{{ product.name }}</Link>
                                    </h6>
                                    <div class="product-price">
                                        <span>ksh.{{product.discounts.length ? ((100 - product.discounts[0].percentage) / 100) * product.product_options[0].selling_price  : product.product_options[0].selling_price }}</span>
                                        <span v-if="product.discounts.length" class="old-price">ksh.{{ product.product_options[0].selling_price }}</span>
                                    </div>
                                </div>
                            </article>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-4 col-md-6 mb-md-0 wow animate__ animate__fadeInUp animated"
                        data-wow-delay=".1s"
                        style="visibility: visible; animation-delay: 0.1s; animation-name: fadeInUp;">
                        <h4 class="section-title style-1 mb-30 animated animated">Trending Products</h4>
                        <div class="product-list-small animated animated">
                            <article class="row align-items-center hover-up" v-for="product in products" :key="product.id">
                                <figure class="col-md-4 mb-0">
                                    <Link :href="'/products/' + product.slug"><img
                                            :src="'/storage/' + product.images[0].url" alt="">
                                    </Link>
                                </figure>
                                <div class="col-md-8 mb-0">
                                    <h6>
                                        <Link :href="'/products/' + product.slug">{{ product.name }}</Link>
                                    </h6>
                                    <div class="product-price">
                                        <span>ksh.{{product.discounts.length ? ((100 - product.discounts[0].percentage) / 100) * product.product_options[0].selling_price  : product.product_options[0].selling_price }}</span>
                                        <span v-if="product.discounts.length" class="old-price">ksh.{{ product.product_options[0].selling_price }}</span>
                                    </div>
                                </div>
                            </article>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-4 col-md-6 mb-sm-5 mb-md-0 d-none d-lg-block wow animate__ animate__fadeInUp animated"
                        data-wow-delay=".2s"
                        style="visibility: visible; animation-delay: 0.2s; animation-name: fadeInUp;">
                        <h4 class="section-title style-1 mb-30 animated animated">Recently added</h4>
                        <div class="product-list-small animated animated">
                            <article class="row align-items-center hover-up" v-for="product in products" :key="product.id">
                                <figure class="col-md-4 mb-0">
                                    <Link :href="'/products/' + product.slug"><img
                                            :src="'/storage/' + product.images[0].url" alt="">
                                    </Link>
                                </figure>
                                <div class="col-md-8 mb-0">
                                    <h6>
                                        <Link :href="'/products/' + product.slug">{{ product.name }}</Link>
                                    </h6>
                                    <div class="product-price">
                                        <span>ksh.{{product.discounts.length ? ((100 - product.discounts[0].percentage) / 100) * product.product_options[0].selling_price  : product.product_options[0].selling_price }}</span>
                                        <span v-if="product.discounts.length" class="old-price">ksh.{{ product.product_options[0].selling_price }}</span>
                                    </div>
                                </div>
                            </article>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-4 col-md-6 mb-sm-5 mb-md-0 d-none d-xl-block wow animate__animated animate__fadeInUp animated"
                        data-wow-delay=".3s"
                        style="visibility: visible; animation-delay: 0.3s; animation-name: fadeInUp;">
                        <h4 class="section-title style-1 mb-30 animated animated">Top Rated</h4>
                        <div class="product-list-small animated animated">
                            <article class="row align-items-center hover-up" v-for="product in products" :key="product.id">
                                <figure class="col-md-4 mb-0">
                                    <Link :href="'/products/' + product.slug"><img
                                            :src="'/storage/' + product.images[0].url" alt=""></Link>
                                </figure>
                                <div class="col-md-8 mb-0">
                                    <h6>
                                        <Link :href="'/products/' + product.slug">{{ product.name }}</Link>
                                    </h6>
                                    <div class="product-price">
                                        <span>ksh.{{product.discounts.length ? ((100 - product.discounts[0].percentage) / 100) * product.product_options[0].selling_price  : product.product_options[0].selling_price }}</span>
                                        <span v-if="product.discounts.length" class="old-price">ksh.{{ product.product_options[0].selling_price }}</span>
                                    </div>
                                </div>
                            </article>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </ShopLayout>
</template>
<style scoped>
.add-cart .add {
    position: relative;
    display: inline-block;
    padding: 6px 20px;
    border-radius: 4px;
    background-color: #def9ec;
    font-size: 14px;
    font-weight: 700;
    width: 100%;
    text-align: center;
}
.slider-1 {
    background-image: url(../../../assets/shop/imgs/slider/slider-1.png);
    width: 936px;
    position: relative;
    left: 0px;
    top: 0px;
    z-index: 999;
    opacity: 1;
}

.slider-2 {
    background-image: url(../../../assets/shop/imgs/slider/slider-2.png);
    width: 936px;
    position: relative;
    left: -936px;
    top: 0px;
    z-index: 998;
    opacity: 0;
    transition: opacity 500ms ease 0s;
}
</style>
