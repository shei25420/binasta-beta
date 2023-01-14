<script setup>
import DataTable from 'datatables.net-vue3'
import DataTablesLib from 'datatables.net';
import 'datatables.net-bs5';
import 'datatables.net-responsive-dt';
import 'bootstrap/dist/js/bootstrap.js'

import GenericLayout from '@/Layouts/GenericLayout.vue';
import ModalComponent from '@/Components/GenericDashboard/ModalComponent.vue';
import { onMounted, ref } from '@vue/runtime-core';

DataTable.use(DataTablesLib);

defineProps({
    orders: Array
});

const productOptions = ref([]);

onMounted(() => {
    document.getElementById("dt").addEventListener("click", function (e) {
        if(e.target.nodeName !== "BUTTON") return;

        const btn = e.target;
        const ref = btn.getAttribute("data-ref");

        btn.setAttribute("disabled", true)
        fetch(`/orders/${ref}`, {
            headers: {
                "Accept": "application/json",
                "X-XSRF-TOKEN": decodeURIComponent(document.cookie.split(";").filter(cookie => cookie.startsWith("XSRF-TOKEN"))[0].split("=")[1])
            }
        })
        .then(res => res.json())
        .then(data => {
            productOptions.value = data.productOptions;
            $("#modalBtn").click();
            btn.removeAttribute("disabled");
        })
        .catch(err => {
            btn.removeAttribute("disabled");
            console.log("error fetching order products", err)
        });
    });

    $('#exampleModal').on('hide.bs.modal', function () {
        console.log("fuckshit");
        productOptions.value = [];
    });
});

</script>

<template>
    <GenericLayout>
        <div class="card">
            <div class="card-header">
                <h5>Customer Orders</h5>
                <button type="button" id="modalBtn" data-bs-toggle="modal" data-bs-target="#exampleModal"
                        class="hidden" style="display: none;">
                </button>
            </div>
            <div class="card-body">
                <DataTable id="dt" class="display table table-responsive" :options="{responsive: true}" :data="orders" :columns="[
                    {data: 'ref'},
                    {data: null, render: data => data.user_address ? data.user_address.location : data.location},
                    {data: null, render: data => data.user_address ? data.user_address.phone_number : data.phone_number},
                    {data: 'status', render: data => data ? `<span class='badge bg-success'>Paid</span>` : `<span class='badge bg-warning'>Pending Payment</span>`},
                    {data: 'created_at', render: data => new Date(data).toDateString()},
                    {data: null, render: data => {
                        return data.status ? `<button class='btn btn-primary btn-sm mr-3' data-ref='${data.ref}' data-type='view'>View</button>` : `<button class='btn btn-primary btn-sm mr-3' data-ref='${data.ref}' data-type='view'>View</button> <button class='btn btn-primary btn-sm' data-id='${data.ref}' data-type='pay'>Make Payment</button>`
                    }}
                ]">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Delivery Location</th>
                            <th>Contact Number</th>
                            <th>Status</th>
                            <th>Created At</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                </DataTable>
            </div>
        </div>
        <ModalComponent title="Purchased Products">
            <DataTable class="display table table-responsive" :data="productOptions" :columns="[
                {data: null, render: data => `${data.product.name} - ${data.variation}`},
                {data: 'pivot.quantity'},
                {data: 'selling_price'},
                {data: null, render: data => `${data.selling_price * data.pivot.quantity}`}
            ]">
                <thead>
                    <tr>
                        <th>Product</th>
                        <th>Qty</th>
                        <th>Unit Price</th>
                        <th>Total</th>
                    </tr>
                </thead>
            </DataTable>
        </ModalComponent>
    </GenericLayout>
</template>

<style>
@import 'datatables.net-bs5';
@import 'datatables.net-responsive-dt';
</style>
