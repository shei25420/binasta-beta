<script setup>
import DataTable from 'datatables.net-vue3'
import DataTablesLib from 'datatables.net';
import 'datatables.net-bs5';
import 'datatables.net-responsive-dt';

import GenericLayout from '@/Layouts/GenericLayout.vue';

DataTable.use(DataTablesLib);

const props = defineProps({
    orders: Array
});
</script>
<template>
    <GenericLayout>
        <div class="card">
            <div class="card-header">
                <h5>User Orders</h5>
            </div>
            <div class="card-body">
                <DataTable id="dt" class="display table table-responsive" :options="{responsive: true}" :data="orders" :columns="[
                    {data: 'user', render: data => data.email},
                    {data: null, render: data => data.user_address ? data.user_address.location : data.location},
                    {data: null, render: data => data.user_address ? data.user_address.phone_number : data.phone_number},
                    {data: 'status', render: data => data ? `<span class='badge bg-warning'>Pending</span>` : `<span class='badge bg-success'>Paid</span>`},
                    {data: 'created_at', render: data => new Date(data).toDateString()}
                ]">
                    <thead>
                        <tr>
                            <th>Client Email</th>
                            <th>Delivery Location</th>
                            <th>Contact Number</th>
                            <th>Status</th>
                            <th>Created At</th>
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
</style>