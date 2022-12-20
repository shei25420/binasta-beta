<script setup>
import { ref, onMounted } from 'vue';
import { useForm } from '@inertiajs/inertia-vue3';
import Select2 from 'vue3-select2-component';
import DataTable from 'datatables.net-vue3'
import DataTablesLib from 'datatables.net';
import 'datatables.net-bs5';
import 'datatables.net-responsive-dt';

import ModalComponent from '@/Components/GenericDashboard/ModalComponent.vue';
import GenericLayout from '@/Layouts/GenericLayout.vue';

DataTable.use(DataTablesLib);

const props = defineProps({
    packages: Array,
    product_options: Array
});

const form = useForm({
    name: '',
    product_options: []
});

const showForm = ref(true);
const updateForm = ref(false);
const selectedPackage = ref(null);
const selectedOptions = ref([]);

const storePackage = () => {
    form.clearErrors();
    if(!form.name || form.name.trim() == "") {
        form.setError('name', 'name field is required');
    }

    if(!form.product_options || !form.product_options.length) {
        form.setError('product_options', 'product options field is required');
    }

    if(form.errors && Object.keys(form.errors).length) return;

    const btn = document.getElementById('submitBtn');
    if(updateForm.value) {
        btn.innerText = "Updating...";
        form.put(`/distributor_packages/${selectedPackage.value.id}`, {
            onSuccess: () => {
                updateForm.value = false;
                selectedPackage.value = null;
                form.reset();
                $('.select2-example').val(null).trigger('change');
                btn.innerText = "Save";
            },
            onError: () => {
                btn.innerText = "Update";
            }
        });
    } else {
        btn.innerText = "Saving...";
        form.post('/distributor_packages', {
            onSuccess: () => {
                form.reset();
                $('.select2-example').val(null).trigger('change');
            },
            onFinish: () => {
                btn.innerText = "Save";
            }
        });
    }
};

onMounted(() => {
    $('.select2-example').select2({
        placeholder: 'Select',
        dir: $('body').hasClass('rtl') ? 'rtl' : ''
    });

    $('.select2-example').on('select2:select', function (e) {
        form.product_options.push(e.params.data.id);
    });

    $('.select2-example').on('select2:unselect', function (e) {
        form.product_options = form.product_options.filter(id => e.params.data.id != id);
    });

    $('.select2-example').on('select2:clear', function (e) {
        form.product_options = [];
    });

    document.getElementById("dt").addEventListener('click', function (e) {
        if(e.target.nodeName !== "BUTTON") return;

        const distributor_packages_id = e.target.getAttribute("data-id");
        const type = e.target.getAttribute("data-type");

        if(type === "del") {
            if(confirm("Are you sure you want to delete this package?")) {
                form.delete(`/distributor_packages/${distributor_packages_id}`);
            }
        } else if (type === "edit") {
            selectedPackage.value = props.packages.filter(({ id }) => id == distributor_packages_id)[0];
    
            const selectedIds = [];
            selectedPackage.value.product_options.forEach(option => selectedIds.push(option.id));
            
            form.name = selectedPackage.value.name;
            form.product_options = selectedIds;
            $('.select2-example').val(selectedIds);
            $('.select2-example').trigger('change');
            updateForm.value = true;
            $("#modalBtn").click();   
        } else if (type === "view") {
            selectedPackage.value = props.packages.filter(({ id }) => id == distributor_packages_id)[0];
    
            const selectedIds = [];
            selectedPackage.value.product_options.forEach(option => selectedIds.push(option.id));
            selectedOptions.value = props.product_options.filter(option => selectedIds.includes(option.id));
            showForm.value = false;
            $("#modalBtn").click();   

        }
    });

    $('#exampleModal').on('hide.bs.modal', function () {
        if(updateForm.value) {
            updateForm.value = false;
            selectedCountry.value = null;
        }

        if(!showForm.value) showForm.value = true;
    });
});

</script>

<template>
    <GenericLayout>
        <div class="card">
            <div class="card-header">
                <h5>Distributor Packages</h5>
                <button type="button" id="modalBtn" data-bs-toggle="modal" data-bs-target="#exampleModal"
                        class="btn btn-icon btn-primary">
                        <i class="bi bi-plus-circle"></i> Add Package
                </button>
            </div>
            <div class="card-body">
                <DataTable id="dt" class="display table table-responsive" :options="{responsive: true}" :data="packages" :columns="[{ data: 'name' }, { data: 'product_options', render: (data) => {
                    return data.length;
                }}, {
                    data: 'created_at', render: (data) => {
                        return new Date(data).toDateString();
                    }
                }, {data: null, render: (data) => {
                    return `<button data-type=view data-id=${data.id} class='btn btn-sm btn-primary mr-3'>View</button> <button data-type=edit data-id=${data.id} class='btn btn-sm btn-secondary mr-3'>Edit</button> <button data-type=del data-id=${data.id} class='btn btn-sm btn-danger'>Delete</button>`;
                }}]">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>No.Of Products</th>
                            <th>Created At</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                </DataTable>
            </div>
        </div>
        <ModalComponent :title="updateForm ? 'Update Package' : 'Add Package'">
            <form @submit.prevent="storePackage" v-if="showForm">
                <div class="form-group">
                    <label for="Name">Name</label>
                    <input v-model="form.name" type="text" class="form-control">
                    <div class="invalid-feedback" v-if="form.errors.name">{{ form.errors.name }}</div>
                </div>
                <div class="form-group mt-3">
                    <label for="product options">Product Options</label>
                    <select v-model="form.product_options" class="select2-example" multiple>
                        <option>Select</option>
                        <option v-for="product_option in product_options" :key="product_option.id"
                            :value="product_option.id">{{ product_option.product.name + " - " +
                                    product_option.variation
                            }}</option>
                    </select>
                    <div class="invalid-feedback" v-if="form.errors.product_options">{{ form.errors.product_options }}</div>
                </div>
                <div class="form-group mt-4">
                    <button type="button" class="btn btn-danger" style="margin-right: 10px;"
                        data-bs-dismiss="modal">Close</button>
                    <button id="submitBtn" type="submit" class="btn btn-primary">{{ updateForm ? 'Update' : 'Save' }}</button>
                </div>
            </form>
            <DataTable v-else class="display table table-responsive" :options="{responsive: true}" :data="selectedOptions" :columns="[{data: 'product', render: (data) => {
                return data.name;
            }}, {data: 'variation'}, {data: 'wholesale_min'}, {data: 'wholesale_price'}]">
                <thead>
                    <tr>
                        <th>Product</th>
                        <th>Variation</th>
                        <th>Wholesale Min</th>
                        <th>Wholesale Price</th>
                    </tr>
                </thead>
            </DataTable>
        </ModalComponent>
    </GenericLayout>
</template>
<style>
@import '../../vendors/generic_dashboard/select2/css/select2.min.css';
@import 'datatables.net-bs5';
@import 'datatables.net-responsive-dt';

.invalid-feedback {
    display: block;
}

</style>