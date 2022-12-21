<script setup>
import { ref } from 'vue';
import { Link, useForm } from '@inertiajs/inertia-vue3';

const props = defineProps({
    order: Object
});

let totalAmount = ref(0);
props.order.product_options.forEach(option => {
    totalAmount.value += parseInt(option.selling_price) * option.pivot.quantity;
});

const paymentForm = useForm({
    phone_number: '',
    payment_type: 'mpesa',
    order_ref: props.order.ref
});

const makePayment = () => {
    paymentForm.post('/make_payment', {
        onError: (err) => {
            console.log(err);
        } 
    });
};
</script>

<template>
    <div class="invoice invoice-content invoice-1">
        <div class="back-top-home hover-up mt-30 ml-30">
            <Link class="hover-up" href="/"><i class="fi-rs-home mr-5"></i> Homepage</Link>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="invoice-inner">
                        <div class="invoice-info" id="invoice_wrapper">
                            <div class="invoice-header">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="invoice-name">
                                            <div class="logo">
                                                <a href="index.html"><img src="assets/imgs/theme/logo-light.svg"
                                                        alt="logo"></a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="invoice-numb">
                                            <h6 class="text-end mb-10 mt-20">{{ new
                                                    Date(order.created_at).toDateString()
                                            }}</h6>
                                            <h6 class="text-end invoice-header-1">Invoice No: #{{ order.ref }}</h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="invoice-top">
                                <div class="row">
                                    <div class="col-lg-9 col-md-6">
                                        <div class="invoice-number">
                                            <h4 class="invoice-title-1 mb-10">Invoice To</h4>
                                            <p class="invoice-addr-1">
                                                <strong>{{ order.user.email }}</strong> <br>
                                                {{ order.phone_number }} <br>
                                                {{ order.location }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="invoice-center">
                                <div class="table-responsive">
                                    <table class="table table-striped invoice-table">
                                        <thead class="bg-active">
                                            <tr>
                                                <th>Item name</th>
                                                <th class="text-center">Unit Price</th>
                                                <th class="text-center">Quantity</th>
                                                <th class="text-right">Amount</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr v-for="option in order.product_options" :key="option.id">
                                                <td>
                                                    <div class="item-desc-1">
                                                        <span>{{ option.product.name }}</span>
                                                        <small>REF: {{ order.ref }}</small>
                                                    </div>
                                                </td>
                                                <td class="text-center">ksh.{{ option.selling_price }}</td>
                                                <td class="text-center">{{ option.pivot.quantity }}</td>
                                                <td class="text-right">ksh.{{ option.pivot.quantity *
                                                        option.selling_price
                                                }}</td>
                                            </tr>
                                            <!-- <tr>
                                                <td colspan="3" class="text-end f-w-600">SubTotal</td>
                                                <td class="text-right">$1710.99</td>
                                            </tr>
                                            <tr>
                                                <td colspan="3" class="text-end f-w-600">Tax</td>
                                                <td class="text-right">$85.99</td>
                                            </tr> -->
                                            <tr>
                                                <td colspan="3" class="text-end f-w-600">Grand Total</td>
                                                <td class="text-right f-w-600">ksh.{{ totalAmount }}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="invoice-bottom">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div>
                                                    <h3 class="invoice-title-1">Payment Method</h3>
                                                    <form action="">
                                                        <div class="form-check">
                                                            <input class="form-check-input" v-model="paymentForm.payment_type" type="radio"
                                                             :value="'mpesa'" id="flexRadioDefault1">
                                                            <label class="form-check-label" for="flexRadioDefault1">
                                                                Mpesa
                                                            </label>
                                                        </div>
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="radio"
                                                            :value="'paypal'" id="flexRadioDefault2">
                                                            <label class="form-check-label" for="flexRadioDefault2">
                                                                Paypal / Credit Card
                                                            </label>
                                                        </div>

                                                    </form>
                                                </div>
                                            </div>
                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                    <input type="text" v-model="paymentForm.phone_number" placeholder="Enter phone number" class="form-control">   
                                                </div>
                                                <div class="form-group">
                                                    <button @click.prevent="makePayment" class="btn btn-lg btn-custom btn-download hover-up">Make Payment</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-offsite">
                                        <div class="text-end">
                                            <p class="mb-0 text-13">Thank you for your business</p>
                                            <p><strong>AliThemes JSC</strong></p>
                                            <div class="mobile-social-icon mt-50 print-hide">
                                                <h6>Follow Us</h6>
                                                <a href="#"><img src="assets/imgs/theme/icons/icon-facebook-white.svg"
                                                        alt=""></a>
                                                <a href="#"><img src="assets/imgs/theme/icons/icon-twitter-white.svg"
                                                        alt=""></a>
                                                <a href="#"><img src="assets/imgs/theme/icons/icon-instagram-white.svg"
                                                        alt=""></a>
                                                <a href="#"><img src="assets/imgs/theme/icons/icon-pinterest-white.svg"
                                                        alt=""></a>
                                                <a href="#"><img src="assets/imgs/theme/icons/icon-youtube-white.svg"
                                                        alt=""></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="invoice-btn-section clearfix d-print-none">
                            <a href="javascript:window.print()" class="btn btn-lg btn-custom btn-print hover-up"> <img
                                    src="assets/imgs/theme/icons/icon-print.svg" alt=""> Print </a>
                            <a id="invoice_download_btn" class="btn btn-lg btn-custom btn-download hover-up"> <img
                                    src="assets/imgs/theme/icons/icon-download.svg" alt=""> Download </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<style scoped>
@import '../../../css/shop/main17e6.css';
</style>