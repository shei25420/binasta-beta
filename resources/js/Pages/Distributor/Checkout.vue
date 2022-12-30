<script setup>
import { ref } from 'vue';
import { useForm } from '@inertiajs/inertia-vue3';
import GenericLayout from '@/Layouts/GenericLayout.vue';

import { onMounted } from 'vue';

const cart = localStorage.getItem("cart") ? JSON.parse(localStorage.getItem("cart")) : null;

const orderForm = useForm({
    location: '',
    phone_number: '',
    distributor_address_id: null,
    distributor_packages: []
});

let cumulative = ref(0);

const calculatePrice = (distributor_package) => {
    let totalAmount = 0, normalAmount = 0, discount =  distributor_package.discounts.length ? ((100 - distributor_package.discounts[0].percentage) / 100) : 0;
    distributor_package.product_options.forEach(option => {
        normalAmount += parseFloat(option.price);
        totalAmount += parseFloat(option.price);
    });
    totalAmount = discount ? discount * totalAmount : totalAmount                                       ;
    return [totalAmount, normalAmount];
};

const storeOrder = () => {
    orderForm.clearErrors();
    if((!orderForm.location || orderForm.location.trim() == "") && !orderForm.distributor_address_id) {
        orderForm.setError('location', 'delivery location is required');
    }

    if((!orderForm.phone_number || orderForm.phone_number.trim() == "") && !orderForm.distributor_address_id) {
        orderForm.setError('phone_number', 'phone number field is required');
    }

    if((orderForm.errors && Object.keys(orderForm.errors).length)) return;

    const btn = document.getElementById("submitBtn");
    btn.innerText = "Checking out...";
    btn.setAttribute("disabled", true);
    orderForm.post('/orders', {
        onSuccess: () => {
            localStorage.removeItem("cart");
        },
        onError: () => {
            btn.innerText = "Place Order";
        },
        onFinish: () => {
            btn.innerText = "Checking out...";
            btn.removeAttribute("disabled");
        }
    });
};

onMounted(() => {
    if(cart) {
        cart.forEach(item => {
            cumulative.value += calculatePrice(item.distributor_package)[0] * parseInt(item.qty);
            orderForm.distributor_packages.push({id: item.distributor_package.id, qty: item.qty});
        });
    }

    let googleScript = document.createElement('script');
    googleScript.setAttribute('src', "https://maps.googleapis.com/maps/api/js?key=AIzaSyBoR-KFcg8yHE4-x5xw4ixAQxYhkPbM4Tc&libraries=places");
    document.head.appendChild(googleScript);

    googleScript.addEventListener('load', function () {
        const autocomplete = new google.maps.places.Autocomplete(
                  /** @type {HTMLInputElement} */(document.getElementById('autocomplete')),
                  { componentRestrictions: { country: 'ke' } });
        google.maps.event.addListener(autocomplete, 'place_changed', function(data) {
            orderForm.location = `${autocomplete.getPlace()["name"]} ${autocomplete.getPlace()["formatted_address"]}`;
        });
    });
});

</script>
<template>
    <GenericLayout>
        <div class="mb-4">
        <nav  aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="#">
                        <i class="bi bi-globe2 small me-2"></i> Dashboard
                    </a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">Checkout</li>
            </ol>
        </nav>
    </div>
    <div class="row">
        <div class="col-md-8">
            <h3 id="checkout-form-wizard-h-0" class="title current">Billing</h3>
            <section class="card card-body mb-0 body current">
                <div class="mb-4">
                    <div class="text-muted">Enter your billing information</div>
                </div>
                <div class="row g-4 mb-3">
                    <div class="col-md-6">
                        <label class="form-label">Contact Phone</label>
                        <input type="text" class="form-control" v-model="orderForm.phone_number">
                        <div class="invalid-feedback" v-if="orderForm.errors.phone_number"> {{  orderForm.errors.phone_number }} </div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Delivery Location</label>
                        <input id="autocomplete" type="text" class="form-control" v-model="orderForm.location">
                        <div class="invalid-feedback" v-if="orderForm.errors.location">{{  orderForm.errors.location  }}</div>
                    </div>
                </div>
            </section>
        </div>
        <div class="col-md-4">
            <h5 class="mb-4">Order Summary</h5>
            <div class="card mb-4">
                <div class="card-body">
                    <h6 class="card-title mb-4">Products</h6>
                    <div class="list-group list-group-flush">
                        <div v-for="item in cart" :key="item.distributor_package.id" class="list-group-item d-flex px-0">
                            <a href="#" class="me-3">
                                <img src="#" class="rounded" width="60" alt="...">
                            </a>
                            <div>
                                <h6>{{  item.distributor_package.name  }}</h6>
                                <div>{{  item.qty }} x ksh.{{ calculatePrice(item.distributor_package)[0]  }}</div>
                            </div>
                            <div class="text-end ms-auto">ksh.{{ calculatePrice(item.distributor_package)[0] * item.qty }}</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card mb-4">
                <div class="card-body">
                    <h6 class="card-title mb-4">Price</h6>
                    <div class="row justify-content-center mb-3">
                        <div class="col-4 text-end">Sub Total :</div>
                        <div class="col-4">ksh.{{  cumulative  }}</div>
                    </div>
                    <div class="row justify-content-center mb-3">
                        <div class="col-4 text-end">Shipping :</div>
                        <div class="col-4">Free</div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-4 text-end">
                            <strong>Total :</strong>
                        </div>
                        <div class="col-4">
                            <strong>ksh.{{  cumulative  }}</strong>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <button @click="storeOrder" id='submitBtn' class="btn btn-outline-primary btn-icon">
                        Checkout
                    </button>
                </div>
            </div>
        </div>
    </div>
    </GenericLayout>
</template>
<style scoped>
.invalid-feedback {
    display: block;
}
</style>
