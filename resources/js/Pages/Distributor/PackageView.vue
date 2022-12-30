<script setup>
import GenericLayout from '@/Layouts/GenericLayout.vue';
import { onMounted, ref } from 'vue';
import 'slick-carousel/slick/slick.js'
const props = defineProps({
    distributor_package: Object
});

const qty = ref(1);
let existsInCart = ref(false);

const calculatePackagePrice = (productOptions) => {
    let totalAmount = 0, normalAmount = 0, discount =  props.distributor_package.discounts.length ? ((100 - props.distributor_package.discounts[0].percentage) / 100) : 0;
    productOptions.forEach(option => {
        normalAmount += parseFloat(option.price) * parseInt(option.min);
        totalAmount += parseFloat(option.price) * parseInt(option.min);
    });
    totalAmount = discount ? discount * totalAmount : totalAmount                                       ;
    return [totalAmount, normalAmount];
};

const addToCart = () => {
    if(existsInCart.value) {
        let cart = JSON.parse(localStorage.getItem("cart"));
        cart = cart.filter(item => item.product.id !== props.product.id);
        localStorage.setItem("cart", JSON.stringify(cart));
        existsInCart.value = false;
    } else {
        let cart = localStorage.getItem("cart");
        if(cart) {
            cart = JSON.parse(localStorage.getItem("cart"));
            //Check if item exists in cart already
            if(cart.some(item => parseInt(item.distributor_package.id) === parseInt(props.distributor_package.id))) return;
        } else  cart = [];

        //New Cart Item -> { distributor_packageid, distributor_packagename, price, selectionoption }
        cart.push({distributor_package: props.distributor_package, qty: qty.value});
        localStorage.setItem("cart", JSON.stringify(cart));
        existsInCart.value = true;
    }
};

const changeQty = (type) => {
    if(type) qty.value++;
    else if(qty.value > 1) qty.value--;

    if(existsInCart.value) {
        const cart = JSON.parse(localStorage.getItem("cart"));
        cart.forEach(item => {
            if(parseInt(item.distributor_package.id) === parseInt(props.distributor_package.id)) {
               item.qty = qty.value;
            }
        });

        localStorage.setItem("cart", JSON.stringify(cart));
    }
};

onMounted(() => {
    const cart = localStorage.getItem("cart") ? JSON.parse(localStorage.getItem("cart")) : null;
    if(cart) {
        existsInCart.value = cart.some(item => {
            if(parseInt(item.distributor_package.id) === parseInt(props.distributor_package.id)) {
                qty.value = item.qty;
                return true;
            }
            return false;
        });
    }
    $('.slider-for').slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        arrows: true,
        fade: true,
        asNavFor: '.slider-nav',
        rtl: $('body').hasClass('rtl') ? true : false,
    });

    $('.slider-nav').slick({
        slidesToShow: 3,
        slidesToScroll: 1,
        asNavFor: '.slider-for',
        dots: false,
        centerMode: true,
        centerPadding: '60px',
        focusOnSelect: true,
        rtl: $('body').hasClass('rtl') ? true : false,
    });
});

</script>
<template>
    <GenericLayout>
        <div class="mb-4">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="#">
                            <i class="bi bi-globe2 small me-2"></i> Dashboard
                        </a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Product Detail</li>
                </ol>
            </nav>
        </div>
        <div class="row">
        <div class="col-md-12">

            <div class="card mb-4">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-5">
                            <div class="slider-for mb-3">
                                    <img :src="'/storage/' + distributor_package.product_options[0].product.images[0].url" class="w-100 rounded" alt="image">
                            </div>
                            <div class="slider-nav">
                                <img v-for="option in distributor_package.product_options" :key="option.id" :src="'/storage/' + option.product.images[0].url" class="w-100 rounded" alt="image" />
                            </div>
                        </div>
                        <div class="col-md-7">
                            <div class="d-flex justify-content-between align-items-start mt-4 mt-md-0">
                                <div>
                                    <div class="small text-muted mb-2">Technology Products</div>
                                    <h2>{{  distributor_package.name  }}</h2>
                                    <p>
                                        <span class="badge bg-success">In stock</span>
                                    </p>
                                    <p>Features:</p>
                                    <p>It is a long established fact that a reader will be distracted.
                                        Contrary to popular belief, Lorem Ipsum is not text.
                                        There are many variations of passages of Lorem.</p>
                                    <p>
                                        Package Contents:
                                        <ul>
                                            <li v-for="option in distributor_package.product_options" :key="option.id">
                                                {{  option.product.name   }} - {{ option.variation }}
                                            </li>
                                        </ul>
                                    </p>
                                    <div class="d-flex gap-3 mb-3 align-items-center">
                                        <h4 v-if="distributor_package.discounts.length" class="text-muted mb-0" >
                                            <del>ksh.{{  calculatePackagePrice(distributor_package.product_options)[0]  }}</del>
                                        </h4>
                                        <h4 class="mb-0">ksh.{{ calculatePackagePrice(distributor_package.product_options)[1] }}</h4>
                                    </div>
                                    <div class="row row-cols-lg-auto">
                                        <form @submit.prevent="addToCart">
                                            <div class="col-12">
                                                <div class="input-group">
                                                    <input type="number" class="form-control" min="0" @change.prevent="changeQty" :value="1">
                                                    <input class="btn btn-primary" type="submit" :value="existsInCart ? 'Remove from cart' : 'Add to cart'" />
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </GenericLayout>
</template>
<style>
</style>
