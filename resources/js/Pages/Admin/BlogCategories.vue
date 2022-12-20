<script setup>
import { ref, onMounted } from 'vue';
import { useForm } from '@inertiajs/inertia-vue3';

import DataTable from 'datatables.net-vue3'
import DataTablesLib from 'datatables.net';
import 'datatables.net-bs5';

import ModalComponent from '@/Components/GenericDashboard/ModalComponent.vue';
import GenericLayout from '@/Layouts/GenericLayout.vue';

DataTable.use(DataTablesLib);

const props = defineProps({
    categories: Array
});

const updateForm = ref(false);
const selectedCategory = ref(null);

const form = useForm({
    name: ''
});

const storeCategory = () => {
    if(!form.name || form.name.trim() == "") {
        form.setError('name', 'category name is required');
        return;
    }

    const btn = document.getElementById('submitBtn');
    if(updateForm.value) {
        btn.innerText = "Updating...";
        form.put(`/blog_categories/${selectedCategory.value.id}`, {
            onSuccess() {
                form.reset();
                updateForm.value = false;
                selectedCategory.value = null;
                btn.innerText = "Save";
            },
            onError() {
                btn.innerText = "Update";
            }
        });
    } else {
        btn.innerText = "Saving...";
        form.post('/blog_categories', {
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

        const category_id = parseInt(e.target.getAttribute("data-id"));
        const type = e.target.getAttribute("data-type");

        if(type === "del") {
            if(confirm("Are you sure you want to delete this category?")) {
                form.delete(`/blog_categories/${category_id}`);
            }
        } else if (type === "edit") {
            selectedCategory.value = props.categories.filter(({ id }) => id == category_id)[0];
            form.name = selectedCategory.value.name;
            updateForm.value = true;
            $("#modalBtn").click();   
        }
    });

    $('#exampleModal').on('hide.bs.modal', function () {
        if(updateForm.value) {
            updateForm.value = false;
            selectedCategory.value = null;
        }
    });
});

</script>
<template>
    <GenericLayout>
        <div class="card">
            <div class="card-header">
                <h5>Blog Categories</h5>
                <button type="button" id="modalBtn" data-bs-toggle="modal" data-bs-target="#exampleModal"
                        class="btn btn-icon btn-primary">
                        <i class="bi bi-plus-circle"></i> Add Category
                </button>
            </div>
            <div class="card-body">
                <DataTable id="dt" class="display table table-responsive" :data="categories" :columns="[
                    { data: 'name' },
                    {
                        data: 'created_at', render: (data) => {
                            return new Date(data).toDateString()
                        }
                    },
                    {
                        data: null, render: (data) => {
                            return `<button class='btn btn-sm btn-secondary mr-3' data-type='edit' data-id='${data.id}'>Edit</button><button class='btn btn-sm btn-danger' data-type='del' data-id='${data.id}'>Delete</button>`;
                        }
                    }
                ]">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Created At</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                </DataTable>
            </div>
        </div>
        <modal-component :title="updateForm ? 'Update Category' : 'Add Category'">
            <form @submit.prevent="storeCategory">
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <label for="category name">Category Name</label>
                            <input type="text" v-model="form.name" class="form-control">
                            <div class="invalid-feedback" v-if="form.errors.name">{{ form.errors.name }}</div>
                        </div>
                    </div>
                </div>
                <div class="form-group mt-4">
                    <button type="button" class="btn btn-danger" style="margin-right: 10px;"
                        data-bs-dismiss="modal">Close</button>
                    <button id="submitBtn" type="submit" class="btn btn-primary">{{ updateForm ? 'Update' : 'Save' }}</button>
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