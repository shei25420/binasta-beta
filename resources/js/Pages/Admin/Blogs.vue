<script setup>
import { onMounted } from 'vue';
import { Link } from '@inertiajs/inertia-vue3';
import { Inertia } from '@inertiajs/inertia';
import DataTable from 'datatables.net-vue3'
import DataTablesLib from 'datatables.net';
import 'datatables.net-bs5';
import 'datatables.net-responsive-dt';

import GenericLayout from '@/Layouts/GenericLayout.vue';

DataTable.use(DataTablesLib);

const props = defineProps({
    blogs: Array
});

onMounted(() => {
    document.getElementById('dt').addEventListener('click', function (e) {
        if(e.target.nodeName !== "BUTTON") return;
        
        const blogId = e.target.getAttribute('data-id');
        const type = e.target.getAttribute('data-type');

        if(type === 'edit') {
            Inertia.get(`/blogs/update/${blogId}`);
        } else if (type === 'del') {
            if(confirm('Are you sure you want to delete this post??')) {
                Inertia.delete(`/blogs/${blogId}`);
            }
        }
    });
});

</script>

<template>
    <GenericLayout>
        <div class="card">
            <div class="card-header">
                <h5>Blog Posts</h5>
                <Link href="/blogs/create" class="btn btn-icon btn-primary">
                        <i class="bi bi-plus-circle"></i> Add Post
                </Link>
            </div>
            <div class="card-body">
                <DataTable id="dt" class="display table table-responsive" :options="{responsive: true}" :data="blogs" :columns="[{ data: 'title' }, { data: 'description' }, {
                    data: 'image_path', render: (data) => {
                        return `<img class='img img-fluid lazy' width='200' height='200' src='/shop/imgs/theme/img_loading.gif' data-src='/storage/${data}' />`;
                    }
                }, { data: 'type', render: (data) => {
                    switch(parseInt(data)) {
                        case 0:
                            return `<span class='badge bg-primary'>Normal Post</span>`;
                        case 1:
                            return `<span class='badge bg-primary'>Quote Post</span>`;
                        case 2:
                            return `<span class='badge bg-primary'>Video Post</span>`;    
                    }
                } }, {
                    data: 'created_at', render: (data) => {
                        return new Date(data).toDateString();
                    }
                }, {data: null, render: (data) => {
                    return `<button class='btn btn-sm btn-secondary mr-3' data-type='edit' data-id='${data.id}'>Edit</button> <button class='btn btn-sm btn-danger' data-type='del' data-id='${data.id}'>Delete</button>`
                }}]">
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Description</th>
                            <th>Feature Image</th>
                            <th>Post Type</th>
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

</style>