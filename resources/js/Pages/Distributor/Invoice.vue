<script setup>
import { onMounted, ref } from 'vue';
import { useForm } from '@inertiajs/inertia-vue3';
import GenericLayout from '@/Layouts/GenericLayout.vue';

const props = defineProps({
    order: Object
});
const paymentForm = ref({
    payment_type: "paypal",
    order_ref: props.order.ref
});
const captureForm = useForm({
    order_ref: props.order.ref
})

let cumulative = ref(0);

const calculatePrice = (distributor_package) => {
    let totalAmount = 0, normalAmount = 0, discount =  distributor_package.discounts.length ? ((100 - distributor_package.discounts[0].percentage) / 100) : 0;
    distributor_package.product_options.forEach(option => {
        console.log(option);
        normalAmount += parseFloat(option.price) * parseInt(option.min);
        totalAmount += parseFloat(option.price) * parseInt(option.min);
    });
    totalAmount = discount ? discount * totalAmount : totalAmount;
    // cumulative.value += totalAmount * distributor_package.quantity;
    return [totalAmount, normalAmount];
};

onMounted(() => {
    props.order.distributor_packages.forEach(distributor_package => {
        cumulative.value = calculatePrice(distributor_package)[0];
        cumulative.value *= distributor_package.quantity;
    }) ;

    let paypalScript = document.createElement('script');
    paypalScript.setAttribute('src', 'https://www.paypal.com/sdk/js?client-id=AaYT0UqlwWovXoGEp6qqBalZR32nG5gDXRVU546jy4_Gv_JrpRAF6fB8xp3gJ7cOTNmHJ-NVhAO4DxIC');
    document.head.appendChild(paypalScript);

    paypalScript.addEventListener("load", () => {
        paypal.Buttons({
            createOrder: async (data, actions) => {
                return fetch(`/make_payment`, {
                    method: "POST",
                    headers: {
                        "Accept": "application/json",
                        "Content-Type": "application/json",
                        "X-XSRF-TOKEN": decodeURIComponent(document.cookie.split(";").filter(cookie => cookie.startsWith("XSRF-TOKEN"))[0].split("=")[1])
                    },
                    body: JSON.stringify({payment_type: paymentForm.value.payment_type, order_ref: paymentForm.value.order_ref})
                })
                .then(res => res.json())
                .then(data => data.orderId)
                .catch(err => console.log("make payment paypal err", err));
            },
            onApprove: (pData, actions) => {
                captureForm.transform((data) => (
                    {...data, ref: pData.orderID}
                )).post('/capture/paypal', {
                    onError: (err) => {
                        console.log("paypal capture err", err);
                    }
                })
            }
        }).render('#paypalContainer');
    });

});

</script>

<template>
    <GenericLayout>
        <div class="card">
        <div class="card-body">
            <div class="invoice">
                <div class="d-md-flex justify-content-between align-items-center mb-4">
                    <div>Invoice No : #{{ order.ref  }}</div>
                    <div>Date: 	{{ new Date(order.created_at).toDateString()  }}</div>
                </div>
                <div class="d-md-flex justify-content-between align-items-center">
                    <h4>Invoice</h4>
                    <div>
                        <img width="120" src="#" alt="logo">
                    </div>
                </div>
                <hr class="my-4">
                <div class="row">
                    <div class="col-md-6">
                        <p class="text-start">
                            <strong>Bill to</strong>
                        </p>
                        <p class="mb-2">{{ order.distributor.first_name  }}  {{ order.distributor.last_name  }}</p>
                        <p>{{ order.location  }}, <br>{{  order.phone_number }}</p>
                    </div>
                </div>
                <div class="table-responsive" tabindex="1" style="overflow: hidden; outline: none;">
                    <table class="table mb-4 mt-4">
                        <thead class="thead-light">
                        <tr>
                            <th>Package</th>
                            <th class="text-end">Quantity</th>
                            <th class="text-end">Price</th>
                            <th class="text-end">Total</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr class="text-end" v-for="distributor_package in order.distributor_packages" :key="distributor_package.id">
                            <td class="text-start">{{  distributor_package.name }}</td>
                            <td>{{  distributor_package.quantity }}</td>
                            <td>ksh.{{  calculatePrice(distributor_package)[0]  }}</td>
                            <td>ksh.{{ calculatePrice(distributor_package)[1] * distributor_package.quantity }}</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="accordion accordion-with-radio" id="accordionExample">
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingOne">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="paymentFlexRadioDefault" id="paypalFlexRadioDefault">
                                        <label class="form-check-label mb-0" for="paypalFlexRadioDefault">
                                            Pay with Paypal
                                        </label>
                                    </div>
                                </button>
                            </h2>
                            <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <div class="col-md-12">
                                        <img width="50" class="me-3" src="#" alt="...">
                                        <div id="paypalContainer" class="col-sm-12"></div>
                                        You will be redirected to PayPal website to complete your purchase securely.
                                    </div></div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingThree">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="paymentFlexRadioDefault" id="cashOnDeliveryFlexRadioDefault">
                                        <label class="form-check-label mb-0" for="cashOnDeliveryFlexRadioDefault">
                                            Pay with Mpesa
                                        </label>
                                    </div>
                                </button>
                            </h2>
                            <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <div class="d-flex align-items-center">
                                        <img width="50" class="me-3" src="#" alt="...">
                                        Pay with cash when your order is delivered.
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    </div>
                    <div class="col-md-6">
                        <div class="text-end">
                    <p>Sub Total: ksh.{{  cumulative }}</p>
                    <p>Shipping: Free</p>
                    <h4 class="fw-bold">Total: ksh.{{ cumulative }}</h4>
                </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </GenericLayout>
</template>
