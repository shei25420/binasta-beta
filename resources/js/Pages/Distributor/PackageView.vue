<script setup>
import GenericLayout from '@/Layouts/GenericLayout.vue';
import { onMounted, ref } from 'vue';
import { useStorage } from '@vueuse/core';

const props = defineProps({
    distributor_package: Object
});

const qty = ref(1);
let existsInCart = ref(false);
const cart = useStorage("cart", []);

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
        cart.value = cart.value.filter(item => item.distributor_package.id !== props.distributor_package.id);
        existsInCart.value = false;
    } else {
        if(cart.value.some(item => parseInt(item.distributor_package.id) === parseInt(props.distributor_package.id))) return;
        
        //New Cart Item -> { distributor_package, qty }
        cart.value.push({distributor_package: props.distributor_package, qty: qty.value});
        existsInCart.value = true;
    }    
};

const changeQty = (e) => {
    qty.value = e.target.value;

    if(existsInCart.value) {
        cart.value.forEach(item => {
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
                                <img src='/shop/imgs/theme/img_loading.gif' :data-src="'/storage/' + distributor_package.image_path" class="lazy w-100 rounded" alt="image">
                            </div>
                        </div>
                        <div class="col-md-7">
                            <div class="d-flex justify-content-between align-items-start mt-4 mt-md-0">
                                <div>
                                    <div class="small text-muted mb-2">Distributor Packages</div>
                                    <h2>{{  distributor_package.name  }}</h2>
                                    <p>
                                        <span class="badge bg-success">In stock</span>
                                    </p>
                                    <p v-html="distributor_package.description"></p>
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
                                            <del>ksh.{{  calculatePackagePrice(distributor_package.product_options)[0] * qty }}</del>
                                        </h4>
                                        <h4 class="mb-0">ksh.{{ calculatePackagePrice(distributor_package.product_options)[1] * qty }}</h4>
                                    </div>
                                    <div class="row row-cols-lg-auto">
                                        <form @submit.prevent="addToCart">
                                            <div class="col-12">
                                                <div class="input-group">
                                                    <input type="number" class="form-control" min="1" @change.prevent="changeQty" :value="1">
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
