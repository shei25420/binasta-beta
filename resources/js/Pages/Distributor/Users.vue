<script setup>
import DataTable from 'datatables.net-vue3'
import DataTablesLib from 'datatables.net';
import 'datatables.net-bs5';
import 'datatables.net-responsive-dt';

import GenericLayout from '@/Layouts/GenericLayout.vue';

DataTable.use(DataTablesLib);

const props = defineProps({
    users: Array
});

</script>
    
<template>
    <GenericLayout>
        <div class="card">
            <div class="card-header">
                <h5>Users</h5>
            </div>
            <div class="card-body">
                <DataTable id="dt" class="display table table-responsive" :options="{responsive: true}" :data="users" :columns="[{ data: 'email' }, {data: 'orders_count'}, {
                    data: 'created_at', render: (data) => {
                        return new Date(data).toDateString();
                    }
                }]">
                    <thead>
                        <tr>
                            <th>Email</th>
                            <th>No.Of Orders</th>
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

.invalid-feedback {
    display: block;
}
</style>