<script setup>
import { ref, onMounted } from 'vue';
import { useForm } from '@inertiajs/inertia-vue3';

import DataTable from 'datatables.net-vue3'
import DataTablesLib from 'datatables.net';
import 'datatables.net-bs5';

import ClassicEditor from '@ckeditor/ckeditor5-build-classic';

import GenericLayout from '@/Layouts/GenericLayout.vue';
import ModalComponent from '@/Components/GenericDashboard/ModalComponent.vue';

DataTable.use(DataTablesLib);

const props = defineProps({
    products: Array,
    categories: Array
});

const form = useForm({
    name: '',
    product_category_id: '',
    description: '',
    ingredients: '',
    images: null
});

const updateForm = ref(false);
const selectedProduct = ref(null);

const storeProduct = () => {
    form.clearErrors();

    if(!form.name || form.name.trim() == "") {
        form.setError('name', 'name is required');
    }

    if(!form.product_category_id || parseInt(form.product_category_id) == NaN) {
        form.setError('product_category_id', 'product category is required');
    }

    if(!form.description || form.description.trim() == "") {
        form.setError('description', 'description is required');
    }

    if(!form.ingredients || form.ingredients.trim() == "") {
        form.setError('ingredients', 'ingredients is required');
    }

    if(!updateForm.value && (!form.images || form.images.length != 2)) {
        form.setError('images', '2 images are required (front & back)');
    }

    if(form.errors && Object.keys(form.errors).length) return;

    const btn = document.getElementById('submitBtn');
    if(updateForm.value) {
        btn.innerText = "Updating...";
        form.post(`/products/update/${selectedProduct.value.id}`, {
            onSuccess() {
                form.reset();
                updateForm.value = false;
                selectedProduct.value = null;
                btn.innerText = "Save";
            },
            onError() {
                btn.innerText = "Update";
            }
        })
    } else {
        btn.innerText = "Saving....";
        form.post('/products', {
        onSuccess() {
            form.reset();
        },
        onFinish() {
            btn.innerText = "Save";
        }
    });
    }
};

onMounted(() => {
    document.getElementById("dt").addEventListener('click', function (e) {
        if(e.target.nodeName !== "BUTTON") return;

        const product_id = e.target.getAttribute("data-id");
        const type = e.target.getAttribute("data-type");

        if(type === "del") {
            if(confirm("Are you sure you want to delete this product?")) {
                form.delete(`/products/${product_id}`);
            }
        } else if (type === "edit") {
            selectedProduct.value = props.products.filter(({ id }) => id == product_id)[0];
            form.name = selectedProduct.value.name;
            form.product_category_id = selectedProduct.value.product_category_id;
            form.description = selectedProduct.value.description;
            form.ingredients = selectedProduct.value.ingredients;
            form.images = selectedProduct.value.images;
            updateForm.value = true;
            $("#modalBtn").click();   
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
                <h4>Products</h4>
                <button id="modalBtn" type="button" data-bs-toggle="modal" data-bs-target="#exampleModal"
                        class="btn btn-icon btn-primary">
                        <i class="bi bi-plus-circle"></i> Add Product
                </button>
            </div>
            <div class="card-body">
                <DataTable :columns="[{ data: 'name' }, {data: 'product_category', render: (data) => {
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
                    return `<button data-type='view' data-id='${data.id}' class='btn btn-sm btn-primary mr-4'>View</button><button data-type='edit' data-id='${data.id}' class='btn btn-sm btn-secondary mr-3'>Edit</button> <button class='btn btn-sm btn-danger' data-type='del' data-id='${data.id}'>Delete</button>`;
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

        <modal-component :title="updateForm ? 'Update Product' : 'Add Product'">
            <form @submit.prevent="storeProduct">
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <label for="Product Name">Product Name</label>
                            <input type="text" v-model="form.name" class="form-control">
                            <div class="invalid-feedback" v-if="form.errors.name">{{ form.errors.name }}</div>
                        </div>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col">
                        <div class="form-group">
                            <label for="Product Category">Product Category</label>
                            <select class="form-control" v-model="form.product_category_id">
                                <option value="">Select Category</option>
                                <option v-for="category in categories" :value="category.id" :key="category.id">
                                    {{ category.name }}
                                </option>
                            </select>
                            <div class="invalid-feedback" v-if="form.errors.product_category_id">{{ form.errors.product_category_id }}</div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <label for="Ingredients">Ingredients</label>
                            <input type="text" v-model="form.ingredients" class="form-control">
                            <div class="invalid-feedback" v-if="form.errors.ingredients">{{ form.errors.ingredients }}</div>
                        </div>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col">
                        <div class="form-group">
                            <label for="Description">Description</label>
                            <ckeditor :editor="ClassicEditor" v-model="form.description"></ckeditor>
                            <div class="invalid-feedback" v-if="form.errors.description">{{ form.errors.description }}</div>
                        </div>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col">
                        <div class="form-group">
                            <label for="Feature Images">Feature Images</label>
                            <input type="file" @input="form.images = $event.target.files" class="form-control" multiple>
                            <div class="invalid-feedback" v-if="form.errors.images">{{ form.errors.images }}</div>
                        </div>
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col">
                        <button type="button" class="btn btn-danger" style="margin-right: 10px;"
                            data-bs-dismiss="modal">Close</button>
                        <button id="submitBtn" type="submit" class="btn btn-primary">{{updateForm ? 'Update' : 'Save'}}</button>
                    </div>
                </div>
            </form>
        </modal-component>
    </GenericLayout>
</template>
<style>
@import 'datatables.net-bs5';

.invalid-feedback {
    display: block;
}
</style>