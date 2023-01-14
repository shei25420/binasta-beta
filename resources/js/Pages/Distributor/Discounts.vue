<script setup>
import { ref, onMounted } from 'vue';
import { useForm } from '@inertiajs/inertia-vue3';

import DataTable from 'datatables.net-vue3'
import DataTablesLib from 'datatables.net';
import 'datatables.net-bs5';
import 'datatables.net-responsive-dt';

import DatePicker from 'vue-datepicker-next';
import 'vue-datepicker-next/index.css';

import GenericLayout from '@/Layouts/GenericLayout.vue';
import ModalComponent from '@/Components/GenericDashboard/ModalComponent.vue';

DataTable.use(DataTablesLib);

const props = defineProps({
    discounts: Array
});

const query = ref('');
const picker = ref('');
const updateForm = ref(false);
const selectedDiscount = ref(null);
const searchResults = ref([]);

const form = useForm({
    product_id: '',
    percentage: '',
});

let handle;
const searchProduct = () => {
    clearTimeout(handle);
    if(!query.value || query.value.trim() == "") {
        searchResults.value = [];
        form.clearErrors('query');
        return;
    }

    handle = setTimeout(function () {
        form.clearErrors('query');
        fetch('/products/search/' + query.value)
            .then(res => res.json())
            .then(data => {
                if(!data.results.length) {
                    form.setError('query', 'searched product not found');
                    return;
                }
                searchResults.value = data.results;
            })
            .catch(err => console.log("product search err: " + err));
    }, 500);
};

const storeDiscount = () => {
    form.clearErrors();
    if(!picker.value.length || !picker.value) {
        form.setError('start_date', 'discount duration is required');
    } else if (!picker.value[0]) {
        form.setError('start_date', 'start date is required');
    } else if (!picker.value[1]) {
        form.setError('end_date', 'end date is required');
    }

    if(!form.product_id || parseInt(form.product_id) === NaN) {
        form.setError('query', 'product field is required');
    }

    if(!form.percentage || parseFloat(form.percentage) === NaN) {
        form.setError('percentage', 'percentage field is required');
    }

    if(form.errors && Object.keys(form.errors).length) return;

    const btn = document.getElementById("submitBtn");

    if(updateForm.value) {
        btn.innerText = "Updating....";
        form.transform((data) => ({
            ...data,
            start_date: picker.value[0],
            end_date: picker.value[1]
        })).put(`/discounts/${selectedDiscount.value.id}`, {
            onSuccess() {
                btn.innerText = "Save";
                updateForm.value = false;
                selectedDiscount.value = null;
                form.reset();
            },
            onError() {
                btn.innerText = "Update";
            }
        });
    } else {
        btn.innerText = "Saving....";
        form.transform((data) => ({
            ...data,
            start_date: picker.value[0],
            end_date: picker.value[1]
        })).post('/discounts', {
            onSuccess() {
                form.reset();
            },
            onFinish() {
                btn.innerText = "Save";
            }
        });
    }
};

const selectProductId = (product) => {
    form.product_id = product.id;
    query.value = product.name;
    searchResults.value = [];
};

onMounted(() => {
    document.getElementById("dt").addEventListener('click', function (e) {
        if(e.target.nodeName !== "BUTTON") return;
        
        const discount_id = e.target.getAttribute("data-id");
        const type = e.target.getAttribute("data-type");
        
        if(type === "del") {
            if(confirm("Are you sure you want to delete this discount?")) {
                form.delete(`/discounts/${discount_id}`);
            }
        } else if (type === "edit") {
            selectedDiscount.value = props.discounts.filter(({ id }) => id == discount_id)[0];
            form.percentage = selectedDiscount.value.percentage;
            form.product_id = selectedDiscount.value.product_id;
            query.value = selectedDiscount.value.product.name;
            picker.value = [selectedDiscount.value.start_date, selectedDiscount.value.end_date];
            updateForm.value = true;
            $("#modalBtn").click();   
        }
    });

    $('#exampleModal').on('hide.bs.modal', function () {
        if(updateForm.value) {
            updateForm.value = false;
            selectedDiscount.value = null;
        }
    });

});

</script>
    
<template>
    <GenericLayout>
        <div class="card">
            <div class="card-header">
                <h5>Discounts</h5>
                <button type="button" id="modalBtn" data-bs-toggle="modal" data-bs-target="#exampleModal"
                        class="btn btn-icon btn-primary">
                        <i class="bi bi-plus-circle"></i> Add Discount
                </button>
            </div>
            <div class="card-body">
                <DataTable id="dt" class="display table table-responsive" :options="{responsive: true}" :data="discounts" :columns="[{ data: 'product', render: (data) => {
                    return data.name;
                } }, { data: 'percentage' }, {data: 'start_date', render: (data) => {
                    return new Date(data).toDateString();
                }}, {data: 'end_date', render: (data) => {
                    return new Date(data).toDateString();
                }}, {
                    data: 'active', render: (data) => {
                        if (data === 1) return `<span class='badge bg-success'>Active</span>`;
                        else if (data === 1) return `<span class='badge bg-success'>Active</span>`;
                    }
                }, {
                    data: 'created_at', render: (data) => {
                        return new Date(data).toDateString();
                    }
                }, { data: null, render: (data) => {
                    return `<button data-type=edit data-id=${data.id} class='btn btn-sm btn-secondary mr-3'>Edit</button> <button data-type=del data-id=${data.id} class='btn btn-sm btn-danger'>Delete</button>`
                } }]">
                    <thead>
                        <tr>
                            <th>Product Name</th>
                            <th>Percentage</th>
                            <th>Start Date</th>
                            <th>End Date</th>
                            <th>Status</th>
                            <th>Created At</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                </DataTable>
            </div>
        </div>
        <modal-component :title="updateForm ? 'Update Discount' : 'Add Discount'">
            <form @submit.prevent="storeDiscount">
                <div class="row mb-3">
                    <div class="col">
                        <div class="form-group">
                            <label class="mb-2" for="product name">Product Name</label>
                            <input type="text" @keyup="searchProduct" v-model="query"
                                placeholder="Search for product...." class="form-control">
                            <div class="invalid-feedback" v-if="form.errors.query">{{ form.errors.query }}</div>
                            </div>
                        <div class="list-group" v-for="result in searchResults" :key="result.id">
                            <a href="#" @click.prevent="selectProductId(result)" class="list-group-item">{{ result.name
                            }}</a>
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col">
                        <div class="form-group">
                            <label class="mb-2" for="discount percentage">Discount Percentage</label>
                            <input type="text" v-model="form.percentage" class="form-control" />
                            <div class="invalid-feedback" v-if="form.errors.percentage">{{ form.errors.percentage }}</div>
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col">
                        <div class="form-group">
                            <label for="" class="mb-2">Discount Duration</label>
                            <br />
                            <date-picker type="datetime" range v-model:value="picker"></date-picker>
                            <div class="invalid-feedback" v-if="form.errors.start_date || form.errors.end_date">{{ form.errors.start_date ? form.errors.start_date : form.errors.end_date }}</div>
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
@import 'datatables.net-responsive-dt';

.invalid-feedback {
    display: block;
}
</style>