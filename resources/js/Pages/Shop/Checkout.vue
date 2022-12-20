<script setup>
import { ref } from 'vue';
import { useForm, usePage, Link } from '@inertiajs/inertia-vue3';

import ShopLayout from '@/Layouts/ShopLayout.vue';

const cart = localStorage.getItem("cart") ? JSON.parse(localStorage.getItem("cart")) : null;

const orderForm = useForm({
    location: '',
    phone_number: '',
    user_address_id: null,
    product_options: []
});

const regForm = useForm({
    email: '',
    password: ''
});

const user = ref(usePage().props.value.auth.user);
;
const makeOrder = () => {
    orderForm.clearErrors();
    regForm.clearErrors();
    if(!user.value) {
        if(!regForm.email || regForm.email.trim() == "") {
            regForm.setError('email', 'email field is required');
        }

        if(!regForm.password || regForm.password.trim() == "") {
            regForm.setError('password', 'password field is required');
        }
    }   
    
    if((!orderForm.location || orderForm.location.trim() == "") && !orderForm.user_address_id) {
        orderForm.setError('location', 'delivery location is required');
    }

    if((!orderForm.phone_number || orderForm.phone_number.trim() == "") && !orderForm.user_address_id) {
        orderForm.setError('phone_number', 'phone number field is required');
    }  

    if((regForm.errors && Object.keys(regForm.errors).length) || (orderForm.errors && Object.keys(orderForm.errors).length)) return;

    const cart = JSON.parse(localStorage.getItem("cart"));    
    cart.forEach(item => {
        orderForm.product_options.push({
            id: item.option.id,
            qty: item.qty
        });    
    });

    const btn = document.getElementById('orderBtn');
    btn.innerText = "Placing Order...";
    if(!user.value) {
        regForm.post('/register', {
            onSuccess: () => {
                orderForm.post('/orders', {
                    onSuccess: () => {
                        localStorage.removeItem("cart");
                    },
                    onError: () => {
                        btn.innerText = "Place Order";
                    }
                });
            },
            onError: (err) => {
                console.log("reg err");
                btn.innerText = "Place Order";
            }
        });
    } else {
        orderForm.post('/orders', {
            onSuccess: () => {
                localStorage.removeItem("cart");
            },
            onError: () => {
                btn.innerText = "Place Order";
            }
        });
    }
};

</script>

<template>
    <ShopLayout>
        <div class="page-header breadcrumb-wrap">
            <div class="container">
                <div class="breadcrumb">
                    <a href="index.html" rel="nofollow"><i class="fi-rs-home mr-5"></i>Home</a>
                    <span></span> Shop
                    <span></span> Checkout
                </div>
            </div>
        </div>
        <div class="container mb-80 mt-50">
            <div class="row">
                <div class="col-lg-8 mb-40">
                    <h1 class="heading-2 mb-10">Checkout</h1>
                    <div class="d-flex justify-content-between">
                        <h6 class="text-body">There are <span class="text-brand">3</span> products in your cart</h6>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-7">
                    <div class="row mb-50" v-if="!user">
                        <div class="col-lg-6 mb-sm-15 mb-lg-0 mb-md-3">
                            <div class="toggle_info">
                                <span><i class="fi-rs-user mr-10"></i><span class="text-muted font-lg">Already have an account?</span> <a href="#loginform" data-bs-toggle="collapse" class="font-lg collapsed" aria-expanded="false">Click here to login</a></span>
                            </div>
                            <div class="panel-collapse login_form collapse" id="loginform" style="">
                                <div class="panel-body">
                                    <p class="mb-30 font-sm">If you have shopped with us before, please enter your details below. If you are a new customer, please proceed to the Billing &amp; Shipping section.</p>
                                    <form method="post">
                                        <div class="form-group">
                                            <input type="text" name="email" placeholder="Username Or Email">
                                        </div>
                                        <div class="form-group">
                                            <input type="password" name="password" placeholder="Password">
                                        </div>
                                        <div class="login_footer form-group">
                                            <div class="chek-form">
                                                <div class="custome-checkbox">
                                                    <input class="form-check-input" type="checkbox" name="checkbox" id="remember" value="">
                                                    <label class="form-check-label" for="remember"><span>Remember me</span></label>
                                                </div>
                                            </div>
                                            <a href="#">Forgot password?</a>
                                        </div>
                                        <div class="form-group">
                                            <button class="btn btn-md" name="login">Log in</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row" v-if="!user">
                        <h4 class="mb-30">Account Details</h4>
                        <form method="post">
                            <div class="row">
                                <div class="form-group col-lg-6">
                                    <input type="email" required="" v-model="regForm.email" placeholder="Email Address *">
                                    <div class="invalid-feedback" v-if="regForm.errors.email">{{ regForm.errors.email }}</div>
                                </div>
                                <div class="form-group col-lg-6">
                                    <input type="password" required="" v-model="regForm.password" placeholder="Password *">
                                    <div class="invalid-feedback" v-if="regForm.errors.password">{{ regForm.errors.password }}</div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="row">
                        <h4 class="mb-30 mt-5">Billing Details</h4>
                        <form method="post">
                            <div class="row">
                                <div class="form-group col-lg-6">
                                    <input type="text" required="" name="fname" v-model="orderForm.phone_number" placeholder="Contact Phone Number *">
                                    <div class="invalid-feedback" v-if="orderForm.errors.phone_number">{{ orderForm.errors.phone_number }}</div>
                                </div>
                                <div class="form-group col-lg-6">
                                    <input type="text" required="" name="lname" v-model="orderForm.location" placeholder="Delivery Location *">
                                    <div class="invalid-feedback" v-if="orderForm.errors.location">{{ orderForm.errors.location }}</div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-lg-5">
                    <div class="border p-40 cart-totals ml-30 mb-50">
                        <div class="d-flex align-items-end justify-content-between mb-30">
                            <h4>Your Order</h4>
                            <h6 class="text-muted">Subtotal</h6>
                        </div>
                        <div class="divider-2 mb-30"></div>
                        <div class="table-responsive order_table checkout">
                            <table class="table no-border">
                                <tbody>
                                    <tr v-for="item in cart" :key="item.product.id">
                                        <td class="image product-thumbnail">
                                            <img :src="'/storage/' + item.product.images[0].url" :alt="item.product.name"></td>
                                        <td>
                                            <h6 class="w-160 mb-5">
                                                <Link :href="'/products/' + item.product.slug" class="text-heading">{{ item.product.name }}</Link>
                                            </h6>
                                            <!-- <div class="product-rate-cover">
                                                <div class="product-rate d-inline-block">
                                                    <div class="product-rating" style="width:90%">
                                                    </div>
                                                </div>
                                                <span class="font-small ml-5 text-muted"> (4.0)</span>
                                            </div> -->
                                        </td>
                                        <td>
                                            <h6 class="text-muted pl-20 pr-20">x {{ item.qty }}</h6>
                                        </td>
                                        <td>
                                            <h4 class="text-brand">ksh.{{ item.option.selling_price }}</h4>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="payment ml-30">
                        <h4 class="mb-30">Payment</h4>
                        <button href="#" @click.prevent="makeOrder" id="orderBtn" class="btn btn-fill-out btn-block mt-30">Place an Order<i class="fi-rs-sign-out ml-15"></i></button>
                    </div>
                </div>
            </div>
        </div>
    </ShopLayout> 
</template>

<style scoped>
.invalid-feedback {
    display: block;
}
</style>