<script setup>
import { ref, onMounted } from 'vue';
import { Link } from '@inertiajs/inertia-vue3';
import ShopLayout from '@/Layouts/ShopLayout.vue';

import '@/vendors/shop/plugins/slick.js';
import { useStorage } from '@vueuse/core';

const props = defineProps({
    product: Object,
    related: Array,
    categories: Array
});

const emit = defineEmits(["addItem"]);
const cart = useStorage("cart", []);

const qty = ref(1);
const selectedOption = ref(props.product.product_options[0]);
let existsInCart = ref(false);

const addToCart = () => {
    if(existsInCart.value) {
        cart.value = cart.value.filter(item => item.product.id !== props.product.id);
        existsInCart.value = false;
    } else {
        if(cart.value.some(item => parseInt(item.product.id) === parseInt(props.product.id))) return;
        
        //New Cart Item -> { productid, productname, price, selectionoption }
        cart.value.push({product: props.product, option: selectedOption.value, qty: qty.value});
        existsInCart.value = true;
    }    
};

const changeQty = (type) => {
    if(type) qty.value++;
    else if(qty.value > 1) qty.value--;
    
    if(existsInCart.value) {
        cart.value.forEach(item => {
            if(parseInt(item.product.id) === parseInt(props.product.id)) {
               item.qty = qty.value; 
            }
        });

        localStorage.setItem("cart", JSON.stringify(cart));
    }
};

const changeSelection = (option) => {
    selectedOption.value = option;
    
    if(existsInCart.value) {
        cart.value.forEach(item => {
            if(parseInt(item.product.id) === parseInt(props.product.id)) {
               item.option = option; 
            }
        });
    }
};

const isActive = (option) => {
    return option.id == selectedOption.value.id;
};

onMounted(() => {
    existsInCart.value = cart.value.some(item => {
        if(parseInt(item.product.id) === parseInt(props.product.id)) {
            selectedOption.value = item.option;
            qty.value = item.qty;
            return true;
        } 
        return false;
    });
    $('.product-image-slider').slick({
        slidesToShow: 1
    });
    // $('.slider-nav-thumbnails').slick({
    //     slidesToShow: 4,
    //     slidesToScroll: 1,
    //     asNavFor: '.product-image-slider',
    //     dots: false,
    //     focusOnSelect: true,

    //     prevArrow: '<button type="button" class="slick-prev"><i class="fi-rs-arrow-small-left"></i></button>',
    //     nextArrow: '<button type="button" class="slick-next"><i class="fi-rs-arrow-small-right"></i></button>'
    // });

    // // Remove active class from all thumbnail slides
    // $('.slider-nav-thumbnails .slick-slide').removeClass('slick-active');

    // // Set active class to first thumbnail slides
    // $('.slider-nav-thumbnails .slick-slide').eq(0).addClass('slick-active');

    // // On before slide change match active thumbnail to current slide
    // $('.product-image-slider').on('beforeChange', function (event, slick, currentSlide, nextSlide) {
    //     var mySlideNumber = nextSlide;
    //     $('.slider-nav-thumbnails .slick-slide').removeClass('slick-active');
    //     $('.slider-nav-thumbnails .slick-slide').eq(mySlideNumber).addClass('slick-active');
    // });

    // $('.product-image-slider').on('beforeChange', function (event, slick, currentSlide, nextSlide) {
    //     var img = $(slick.$slides[nextSlide]).find("img");
    //     $('.zoomWindowContainer,.zoomContainer').remove();
    //     $(img).elevateZoom({
    //         zoomType: "inner",
    //         cursor: "crosshair",
    //         zoomWindowFadeIn: 500,
    //         zoomWindowFadeOut: 750
    //     });
    // });
    // //Elevate Zoom
    // if ($(".product-image-slider").length) {
    //     $('.product-image-slider .slick-active img').elevateZoom({
    //         zoomType: "inner",
    //         cursor: "crosshair",
    //         zoomWindowFadeIn: 500,
    //         zoomWindowFadeOut: 750
    //     });
    // }

    // $('.dropdown-menu .cart_list').on('click', function (event) {
    //     event.stopPropagation();
    // });

        /*-------------------------------------
        Product details big image slider
    ---------------------------------------*/
    $(".pro-dec-big-img-slider").slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        arrows: false,
        draggable: false,
        fade: false,
        asNavFor: ".product-dec-slider-small , .product-dec-slider-small-2"
    });

    /*---------------------------------------
        Product details small image slider
    -----------------------------------------*/
    $(".product-dec-slider-small").slick({
        slidesToShow: 4,
        slidesToScroll: 1,
        asNavFor: ".pro-dec-big-img-slider",
        dots: false,
        focusOnSelect: true,
        fade: false,
        arrows: false,
        responsive: [
            {
                breakpoint: 991,
                settings: {
                    slidesToShow: 3
                }
            },
            {
                breakpoint: 767,
                settings: {
                    slidesToShow: 4
                }
            },
            {
                breakpoint: 575,
                settings: {
                    slidesToShow: 2
                }
            }
        ]
    });


});

</script>
    
<template>
    <ShopLayout>
        <div class="page-header breadcrumb-wrap">
            <div class="container">
                <div class="breadcrumb">
                    <Link href="/" rel="nofollow"><i class="fi-rs-home mr-5"></i>Home</Link>
                    <span></span>
                    <Link href="/products">{{ product.product_category.name }}</Link> <span></span>
                    {{ product.name }}
                </div>
            </div>
        </div>
        <div class="container mb-30" style="transform: none;">
            <div class="row" style="transform: none;">
                <div class="col-xl-11 col-lg-12 m-auto" style="transform: none;">
                    <div class="row" style="transform: none;">
                        <div class="col-xl-9">
                            <div class="product-detail accordion-detail">
                                <div class="row mb-50 mt-30">
                                    <div class="col-md-6 col-sm-12 col-xs-12 mb-md-0 mb-sm-5">
                                        <div class="detail-gallery">
                                            <span class="zoom-icon"><i class="fi-rs-search"></i></span>
                                            <!-- MAIN SLIDES -->
                                            <div class="product-image-slider">
                                                <figure v-for="image in product.images" :key="image.id"
                                                    class="border-radius-10">
                                                    <img class="lazy" src="../../../assets/shop/imgs/theme/img_loading.gif" :data-src="'/storage/' + image.url" alt="product image">
                                                </figure>
                                            </div>
                                        </div>
                                        <!-- End Gallery -->
                                    </div>
                                    <div class="col-md-6 col-sm-12 col-xs-12">
                                        <div class="detail-info pr-30 pl-30">
                                            <span class="stock-status out-stock" v-if="product.discounts.length"> -{{ product.discounts[0].percentage }}%</span>
                                            <h2 class="title-detail">{{ product.name }}</h2>
                                            <div class="clearfix product-price-cover">
                                                <div class="product-price primary-color float-left">
                                                    <span class="current-price text-brand">ksh.{{
                                                            product.discounts.length ? (((100 - (product.discounts[0].percentage)) / 100) * selectedOption.selling_price) * qty : selectedOption.selling_price * qty
                                                    }}</span>
                                                    <span v-if="product.discounts.length">
                                                        <span class="save-price font-md color3 ml-15">{{ product.discounts[0].percentage }}% Off</span>
                                                        <span class="old-price font-md ml-15">ksh.{{ selectedOption.selling_price * qty }}</span>
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="short-desc mb-30">
                                                <p class="font-lg" v-html="product.description"></p>
                                            </div>


                                            <div class="attr-detail attr-size mb-30">
                                                <strong class="mr-10">Size / Weight: </strong>
                                                <ul class="list-filter size-filter font-small">
                                                    <li v-for="option in product.product_options" :key="option.id"
                                                        :class="{ active: isActive(option) }">
                                                        <a href="#" @click.prevent="changeSelection(option)">{{
                                                                option.variation
                                                        }}</a>
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="detail-extralink mb-50">
                                                <div class="detail-qty border radius">
                                                    <a href="#" @click.prevent="changeQty(0)" class="qty-down"><i
                                                            class="fi-rs-angle-small-down"></i></a>
                                                    <input type="text" name="quantity" class="qty-val" :value="qty"
                                                        min="1">
                                                    <a href="#" class="qty-up" @click.prevent="changeQty(1)"><i
                                                            class="fi-rs-angle-small-up"></i></a>
                                                </div>
                                                <div class="product-extra-link2">
                                                    <button @click.prevent="addToCart" id="addBtn" type="button"
                                                        class="button button-add-to-cart"><i
                                                            class="fi-rs-shopping-cart"></i>{{existsInCart ? 'Remove from ' : 'Add to '}}cart</button>
                                                </div>
                                            </div>
                                            <div class="font-xs">
                                                <ul class="mr-50 float-start">
                                                    <li class="mb-5">Ingredients: <span class="text-brand">{{ product.ingredients  }}</span></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <!-- Detail Info -->
                                    </div>
                                </div>
                                <div class="row mt-60" v-if="related.length">
                                    <div class="col-12">
                                        <h2 class="section-title style-1 mb-30">Related products</h2>
                                    </div>
                                    <div class="col-12">
                                        <div class="row related-products">
                                            <div v-for="product_related in related" :key="product_related.id"
                                                class="col-lg-3 col-md-4 col-12 col-sm-6">
                                                <div class="product-cart-wrap hover-up">
                                                    <div class="product-img-action-wrap">
                                                        <div class="product-img product-img-zoom">
                                                            <Link :href="'/products/' + product_related.slug"
                                                                tabindex="0">
                                                            <img class="default-img"
                                                                :src="'/storage/' + product_related.images[0].url"
                                                                alt="">
                                                            <img class="hover-img"
                                                                :src="'/storage/' + product_related.images[1].url"
                                                                alt="">
                                                            </Link>
                                                        </div>
                                                        <div class="product-action-1">
                                                            <a aria-label="Quick view" class="action-btn small hover-up"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#quickViewModal"><i
                                                                    class="fi-rs-search"></i></a>
                                                            <a aria-label="Add To Wishlist"
                                                                class="action-btn small hover-up"
                                                                href="shop-wishlist.html" tabindex="0"><i
                                                                    class="fi-rs-heart"></i></a>
                                                            <a aria-label="Compare" class="action-btn small hover-up"
                                                                href="shop-compare.html" tabindex="0"><i
                                                                    class="fi-rs-shuffle"></i></a>
                                                        </div>
                                                        <div
                                                            class="product-badges product-badges-position product-badges-mrg">
                                                            <span class="hot">Hot</span>
                                                        </div>
                                                    </div>
                                                    <div class="product-content-wrap">
                                                        <h2><a href="shop-product-right.html" tabindex="0">{{
                                                                product_related.name
                                                        }}</a></h2>
                                                        <div class="rating-result" title="90%">
                                                            <span> </span>
                                                        </div>
                                                        <div class="product-price">
                                                            <span>ksh.{{
                                                                    product_related.product_options[0].selling_price
                                                            }}</span>
                                                            <span class="old-price">$245.8</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 primary-sidebar sticky-sidebar mt-30"
                            style="position: relative; overflow: visible; box-sizing: border-box; min-height: 1px;">

                            <!-- Fillter By Price -->

                            <!-- Product sidebar Widget -->
                            <div class="theiaStickySidebar"
                                style="padding-top: 0px; padding-bottom: 1px; position: static; transform: none;">
                                <div class="sidebar-widget widget-category-2 mb-30">
                                    <h5 class="section-title style-1 mb-30">Category</h5>
                                    <ul>
                                        <li v-for="category in categories" :key="category.id">
                                            <Link href="/products"> <img :src="'/storage/' + category.image.url"
                                                    alt="">{{ category.name }}</Link>
                                            <span class="count">{{ category.products_count }}</span>
                                        </li>
                                    </ul>
                                </div>
                                <div class="banner-img wow fadeIn mb-lg-0 animated d-lg-block d-none"
                                    style="visibility: hidden; animation-name: none;">
                                    <img src="/assets/imgs/banner/banner-11.png" alt="">
                                    <div class="banner-text">
                                        <span>Oganic</span>
                                        <h4>
                                            Save 17% <br>
                                            on <span class="text-brand">Oganic</span><br>
                                            Juice
                                        </h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </ShopLayout>
</template>
<style>

</style>