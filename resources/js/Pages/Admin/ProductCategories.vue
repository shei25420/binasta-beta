<script setup>
import { onMounted, ref } from 'vue';
import { useForm } from '@inertiajs/inertia-vue3';

import GenericLayout from '@/Layouts/GenericLayout.vue';
import ModalComponent from '@/Components/GenericDashboard/ModalComponent.vue';

import DataTable from 'datatables.net-vue3'
import DataTablesLib from 'datatables.net';
import 'datatables.net-bs5';

DataTable.use(DataTablesLib);

const props = defineProps({
    categories: Array
});

const update = ref(false);
const selectedCategory = ref(null);

const form = useForm({
    name: '',
    image_path: null
});

const validateForm = (validateImage = true) => {
    if(form.name.trim() === null || form.name.trim() === "") {
        form.setError('name', 'name field is required');
    }
    
    console.log(form.image_path);
    if(validateImage && form.image_path === null || form.image_path === undefined) {
        form.setError('image_path', 'image field is required');
    }
    
    console.log(form.errors, Object.keys(form.errors).length, Object.getPrototypeOf(form.errors) === Object.prototype);
    if(form.errors && Object.keys(form.errors).length) return false;
    return true;
};

const categoryFormAction = () => {
    const btn = document.getElementById("submitBtn");
    form.clearErrors();

    if(update.value) {
        btn.innerText = "Updating.....";

        //Check Validation
        if(!validateForm(false)) {
            btn.innerText = "Update";
            return;
        }

        //Send Request (Using Post for image purpose)
        form.post('/product_categories/update/' + selectedCategory.value.id, {
            onSuccess(data) {
                form.reset();
                update = false;
                selectedCategory = null;
                btn.innerText = "Save";
            },
            onError(data) {
                btn.innerText = "Update";
            }
        });
    } 
    else{
        btn.innerText = "Saving....";
        
        //Check Validations
        if(!validateForm()) {
            btn.innerText = "Save";
            return;
        }

        form.post('/product_categories', {
            onSuccess(data) {
                form.reset();   
            },
            onFinish(data) {
                btn.innerText = "Save";
            }
        })
    }
};

onMounted(() => {
    document.getElementById("dt").addEventListener('click', function (e) {
        if(e.target.nodeName !== 'BUTTON') return;

        const action = e.target.getAttribute("data-type");
        const p_id = e.target.getAttribute("data-id");
        if(action === 'del') {
            form.delete('/product_categories/' + p_id);
        } else if (action === 'edit') {
            update.value = true;
            selectedCategory.value = props.categories.filter(({ id }) => p_id == id )[0];
            form.name = selectedCategory.value.name;
            $("#modalBtn").click();
        }
    });

    $('#exampleModal').on('hide.bs.modal', function () {
        if(update.value) {
            update.value = false;
            selectedConfig.value = null;
            form.name = "";
            form.image_path = "";
        }
    });
});
</script>
    
<template>
    <GenericLayout>
        <div class="card">
            <div class="card-header">
                <h5>Product Categories</h5>
                <button type="button" id="modalBtn" data-bs-toggle="modal" data-bs-target="#exampleModal"
                        class="btn btn-icon btn-primary">
                        <i class="bi bi-plus-circle"></i> Add Category
                </button>
            </div>
            <div class="card-body">
                <DataTable id="dt" :data="categories" :columns="[{data: 'name'}, {data: 'image', render: (data) => {
                    return `<img class='img img-fluid' src=/storage/${data.url} />`
                }}, {data: 'products_count'}, {data: 'created_at', render: (data) => {
                    return new Date(data).toDateString();
                }}, {data: null, render: (data) => {
                    return `<button data-type=edit data-id=${data.id} class='btn btn-sm btn-secondary mr-3'>Edit</button> <button data-type=del data-id=${data.id} class='btn btn-sm btn-danger'>Delete</button>`
                }}]" class="display table table-responsive">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Image</th>
                            <th>No.Of Products</th>
                            <th>Created At</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                </DataTable>
            </div>
        </div>
        <modal-component :title="update ? 'Update Category' : 'Add Category'">
            <form @submit.prevent="categoryFormAction">
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <label for="category name">Category Name</label>
                            <input type="text" v-model="form.name" class="form-control">
                            <div class="invalid-feedback" v-if="form.errors.name">{{ form.errors.name }}</div>
                        </div>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col">
                        <div class="form-group">
                            <label for="category image">Feature Image</label>
                            <input type="file" @input="form.image_path = $event.target.files[0]" class="form-control">
                            <div class="invalid-feedback" v-if="form.errors.image_path">{{ form.errors.image_path }}</div>
                        </div>
                        <img v-if="selectedCategory" class="img img-fluid mt-3" width="200" :src="('/storage/' + selectedCategory.image.url)" />
                    </div>
                </div>
                
                <div class="form-group mt-4">
                    <button type="button" class="btn btn-danger" style="margin-right: 10px;" data-bs-dismiss="modal">Close</button>
                    <button id="submitBtn" type="submit" class="btn btn-primary"> {{ update ? 'Update' : 'Save' }}</button>
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