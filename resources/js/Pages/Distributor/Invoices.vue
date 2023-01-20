<script setup>
import DataTable from 'datatables.net-vue3'
import DataTablesLib from 'datatables.net';
import 'datatables.net-bs5';
import 'datatables.net-responsive-dt';

import { Inertia } from '@inertiajs/inertia';
import { onMounted } from 'vue';

import GenericLayout from '@/Layouts/GenericLayout.vue';

defineProps({
    invoices: Array
});

DataTable.use(DataTablesLib);

onMounted(() => {
    document.getElementById("dt").addEventListener('click', function (e) {
        if(e.target.nodeName !== "BUTTON") return;

        const invoice_ref = e.target.getAttribute("data-ref");
        const type = e.target.getAttribute("data-type");

        if (type === "view") {
            Inertia.visit(`/invoice/${invoice_ref}`);
        }
    });

    $('#exampleModal').on('hide.bs.modal', function () {
        if(updateForm.value) {
            updateForm.value = false;
            selectedProduct.value = null;
        }
    });
});
</script>

<template>
    <GenericLayout>
        <div class="card">
            <div class="card-header">
                <h5>My Invoices</h5>
            </div>
            <div class="card-body">
                <DataTable id="dt" class="display table table-responsive" :data="invoices" :columns="[
                    { data: 'ref' },
                    { data: 'payment_type', render: (data) => {
                        return data == 'mpesa' ? `<span class='badge bg-success'>Mpesa</span>` : `<span class='badge bg-secondary'>Paypal</span>`;
                    }},
                    {
                        data: 'created_at', render: (data) => {
                            return new Date(data).toDateString()
                        }
                    },
                    {
                        data: null, render: (data) => {
                            return `<button class='btn btn-sm btn-secondary mr-3' data-type='view' data-ref='${data.ref}'>View</button>`;
                        }
                    }
                ]">
                    <thead>
                        <tr>
                            <th>Ref</th>
                            <th>Payment Type</th>
                            <th>Payment Date</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                </DataTable>
            </div>
        </div>
    </GenericLayout>
</template>

<style>
@import 'datatables.net-bs5';
@import 'datatables.net-responsive-dt';

.invalid-feedback {
    display: block;
}
</style>