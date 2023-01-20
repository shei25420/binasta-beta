<script setup>
import { ref, onMounted } from 'vue';
import { Link, useForm, usePage } from '@inertiajs/inertia-vue3';

const props = defineProps({
    order: Object
});

let totalAmount = ref(0);
let mpesaResponse = ref(null);
props.order.product_options.forEach(option => {
    totalAmount.value += parseInt(option.selling_price) * option.pivot.quantity;
});

const captureForm = useForm({
    order_ref: props.order.ref
});
const paymentForm = useForm({
    phone_number: '',
    payment_type: 'mpesa',
    order_ref: props.order.ref
});

const makePayment = () => {
    paymentForm.clearErrors();
    mpesaResponse.value = null;
    if (!paymentForm.phone_number || paymentForm.phone_number.trim() == "") {
        paymentForm.setError('phone_number', "Phone number is required");
    } else if (paymentForm.phone_number.length > 9) {
        paymentForm.setError('phone_number', 'Phone number is invalid. (Hint) Don\'t start with 0');
    }

    if (!paymentForm.payment_type || paymentForm.payment_type.trim() == "") {
        paymentForm.setError('payment_type', 'payment type is required');
    }

    if (!paymentForm.order_ref || paymentForm.order_ref.trim() == "") {
        paymentForm.setError('order_ref', 'Order ref is requireed');
    }

    if (paymentForm.errors && Object.keys(paymentForm.errors).length) return;

    const btn = document.getElementById("submitBtn");
    btn.innerText = "Making payment....";
    btn.setAttribute("disabled", true);

    fetch(`/make_payment`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-XSRF-TOKEN': decodeURIComponent(document.cookie.split(";").filter(cookie => cookie.startsWith("XSRF-TOKEN="))[0].split("=")[1])
        },
        body: JSON.stringify({ phone_number: paymentForm.phone_number, payment_type: paymentForm.payment_type, order_ref: paymentForm.order_ref })
    })
        .then(res => res.json())
        .then(data => console.log(data))
        .catch(err => console.log(err));
};

onMounted(() => {
    let paypalScript = document.createElement('script');
    paypalScript.setAttribute('src', 'https://www.paypal.com/sdk/js?client-id=AaYT0UqlwWovXoGEp6qqBalZR32nG5gDXRVU546jy4_Gv_JrpRAF6fB8xp3gJ7cOTNmHJ-NVhAO4DxIC');
    document.head.appendChild(paypalScript);

    paypalScript.addEventListener("load", () => {
        paypal.Buttons({
            createOrder: (data, actions) => {
                return fetch(`/make_payment`, {
                    method: "POST",
                    headers: {
                        "Accept": "application/json",
                        "Content-Type": "application/json",
                        "X-XSRF-TOKEN": decodeURIComponent(document.cookie.split(";").filter(cookie => cookie.startsWith("XSRF-TOKEN"))[0].split("=")[1])
                    },
                    body: JSON.stringify({ payment_type: paymentForm.payment_type, order_ref: paymentForm.order_ref })
                })
                    .then(res => res.json())
                    .then(data => data.orderId)
                    .catch(err => console.log("make payment paypal err", err));
            },
            onApprove: (pData, actions) => {
                console.log(pData);
                captureForm.transform((data) => (
                    { ...data, ref: pData.orderID }
                )).post('/capture/paypal', {
                    onError: (err) => {
                        console.log("paypal capture err", err);
                    }
                })
            }
        }).render('#paypalContainer');
    });

    window.Echo.private(`payments.${usePage().props.value.auth.user.id}`)
        .listen('MpesaPaymentCaptured', e => {
            mpesaResponse.value = { message: e.message };
            if (parseInt(e.status) === 0) {
                mpesaResponse.value.class = "primary";
                window.location.href = "https://dashboard.binasta.co.ke/orders";
            } else {
                mpesaResponse.value.class = "danger";
                const btn = document.getElementById("submitBtn");
                btn.removeAttribute("disabled");
                btn.innerText = "Make payment";
            }
        });
});
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
                                                <Link href="/"><img width="200"
                                                    src="../../../assets/shop/imgs/theme/flogo.png" alt="logo"></Link>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="invoice-numb">
                                            <h6 class="text-end mb-10 mt-20">{{
                                                new
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
                                                <td class="text-right">ksh.{{
                                                    option.pivot.quantity *
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
                                    <div class="col-sm-6" v-if="order.status == 0">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div>
                                                    <h3 class="invoice-title-1">Payment Method</h3>
                                                    <form action="">
                                                        <div class="form-check">
                                                            <input class="form-check-input"
                                                                v-model="paymentForm.payment_type" type="radio"
                                                                :value="'mpesa'" id="flexRadioDefault1">
                                                            <label class="form-check-label" for="flexRadioDefault1">
                                                                Mpesa
                                                            </label>
                                                        </div>
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="radio"
                                                                :value="'paypal'" v-model="paymentForm.payment_type"
                                                                id="flexRadioDefault2">
                                                            <label class="form-check-label" for="flexRadioDefault2">
                                                                Paypal / Credit Card
                                                            </label>
                                                        </div>

                                                    </form>
                                                </div>
                                            </div>
                                            <div class="col-sm-12" v-show="paymentForm.payment_type == 'mpesa'">
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                        <span style="padding: 11px" class="input-group-text"
                                                            id="basic-addon1"><strong>+254</strong></span>
                                                    </div>
                                                    <input type="text" v-model="paymentForm.phone_number"
                                                        placeholder="Enter phone number" class="form-control">
                                                </div>
                                                <div class="invalid-feedback" v-if="paymentForm.errors.phone_number">{{
                                                    paymentForm.errors.phone_number
                                                }}</div>
                                                <div v-if="mpesaResponse" :class="`alert alert-${mpesaResponse.class}`"
                                                    role="alert">
                                                    <strong>{{ mpesaResponse.message }}</strong>
                                                </div>
                                                <div class="form-group">
                                                    <button @click.prevent="makePayment" id="submitBtn"
                                                        class="btn btn-lg btn-custom btn-download hover-up">Make
                                                        Payment</button>
                                                </div>
                                            </div>
                                            <div id="paypalContainer" class="col-sm-12"
                                                v-show="paymentForm.payment_type == 'paypal'">

                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-offsite">
                                        <div class="text-end">
                                            <p class="mb-0 text-13">Thank you for your business</p>
                                            <p><strong>Binasta Limited</strong></p>
                                            <div class="mobile-social-icon mt-50 print-hide">
                                                <h6>Follow Us</h6>
                                                <a href="#"><img
                                                        src="../../../assets/shop/imgs/theme/icons/icon-facebook-white.svg"
                                                        alt=""></a>
                                                <a href="#"><img
                                                        src="../../../assets/shop/imgs/theme/icons/icon-twitter-white.svg"
                                                        alt=""></a>
                                                <a href="#"><img
                                                        src="../../../assets/shop/imgs/theme/icons/icon-instagram-white.svg"
                                                        alt=""></a>
                                                <a href="#"><img
                                                        src="../../../assets/shop/imgs/theme/icons/icon-pinterest-white.svg"
                                                        alt=""></a>
                                                <a href="#"><img
                                                        src="../../../assets/shop/imgs/theme/icons/icon-youtube-white.svg"
                                                        alt=""></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<style scoped>
@import '../../../css/shop/main17e6.css';

.invalid-feedback {
    display: block;
}

.invoice-1 .invoice-header {
    background: rgba(0, 0, 0, 0.04) url(../../../assets/shop/imgs/invoice/header-bg-1.png) top left repeat !important;
}
</style>
