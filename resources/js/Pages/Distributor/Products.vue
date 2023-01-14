<script setup>
import DataTable from 'datatables.net-vue3'
import DataTablesLib from 'datatables.net';
import 'datatables.net-bs5';
import 'datatables.net-responsive-dt';

import ClassicEditor from '@ckeditor/ckeditor5-build-classic';

import GenericLayout from '@/Layouts/GenericLayout.vue';

DataTable.use(DataTablesLib);

const props = defineProps({
    products: Array,
});
</script>
    
<template>
    <GenericLayout>
        <div class="card">
            <div class="card-header">
                <h4>Products</h4>
            </div>
            <div class="card-body">
                <DataTable :options="{responsive: true}" :columns="[{ data: 'name' }, {data: 'product_category', render: (data) => {
                    return data.name;
                }}, {data: 'images', render: (data) => {
                    return `<img class='img img-fluid' src='/storage/${data[0].url}' width=150/>`
                }}, {data: 'product_options_count', render: (data) => {
                    return data ? `<span class='badge bg-success'>Complete (`+ data +`)</span>` : `<span class='badge bg-danger'>Incomplete</span>`;
                }}, {
                    data: 'created_at', render: (data) => {
                        return new Date(data).toDateString()
                    }
                }, {data: null, render: (data) => {
                    return `<button data-type='view' data-id='${data.id}' class='btn btn-sm btn-primary mr-4'>View</button>`;
                }}]" :data="products" class="table table-responsive display" id="dt">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Category</th>
                            <th>Product Image</th>
                            <th>Product Options</th>
                            <th>Created At</th>
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