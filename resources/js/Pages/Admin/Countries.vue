<script setup>
import { useForm } from '@inertiajs/inertia-vue3';
import { onMounted, ref } from 'vue';

import DataTable from 'datatables.net-vue3'
import DataTablesLib from 'datatables.net';
import 'datatables.net-bs5';

import GenericLayout from '@/Layouts/GenericLayout.vue';
import ModalComponent from '@/Components/GenericDashboard/ModalComponent.vue';

DataTable.use(DataTablesLib);

const form = useForm({
    name: '',
    code: ''
});

const props = defineProps({
    countries: Array
});

const selectedCountry = ref(null);
const updateForm = ref(false);

const storeCountry = (update = false) => {
    form.clearErrors();

    //Check validations
    if(form.name.trim() === null && form.name.trim() == "") {
        form.setError('name', 'name field is required');
    } else if (!form.code && parseInt(form.code) === NaN) {
        form.setError('code', 'country code field is required')
    }

    if(form.errors && Object.keys(form.errors).length) return;

    const btn = document.getElementById("submitBtn");
    if(update) {
        btn.innerText = "Updating...";
        form.put(`/countries/${selectedCountry.value.id}`, {
            onSuccess(data) {
                selectedCountry.value = null;
                updateForm.value = false;
                btn.innerText = "Save";
                form.reset();
            },
            onError(err) {
                btn.innerText = "Update";
            }
        })
    } else {
        btn.innerText = "Saving...";
        form.post('/countries', {
            onSuccess(data) {
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

        const country_id = e.target.getAttribute("data-id");
        const type = e.target.getAttribute("data-type");

        if(type === "del") {
            if(confirm("Are you sure you want to delete this country?")) {
                form.delete(`/countries/${country_id}`);
            }
        } else if (type === "edit") {
            selectedCountry.value = props.countries.filter(({ id }) => id == country_id)[0];
            form.name = selectedCountry.value.name;
            form.code = selectedCountry.value.code;
            updateForm.value = true;
            $("#modalBtn").click();   
        }
    });

    $('#exampleModal').on('hide.bs.modal', function () {
        if(updateForm.value) {
            updateForm.value = false;
            selectedCountry.value = null;
        }
    });
});

</script>
    
<template>
    <GenericLayout>
        <div class="card">
            <div class="card-header">
                <h5>Countries</h5>
                <button type="button" id="modalBtn" data-bs-toggle="modal" data-bs-target="#exampleModal"
                        class="btn btn-icon btn-primary">
                        <i class="bi bi-plus-circle"></i> Add Country
                </button>
            </div>
            <div class="card-body">
                <DataTable :data="countries" :columns="[{ data: 'name' }, { data: 'code' }, {
                    data: 'created_at', render: (data) => {
                        return new Date(data).toDateString();
                    }
                }, { data: null, render: (data) => {
                    return `<button data-type=edit data-id=${data.id} class='btn btn-sm btn-secondary mr-3'>Edit</button> <button data-type=del data-id=${data.id} class='btn btn-sm btn-danger'>Delete</button>`;
                } }]" class="table table-responsive display" id="dt">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Code</th>
                            <th>Created At</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                </DataTable>
            </div>
        </div>

        <modal-component :title="updateForm ? 'Update Country' : 'Add Country'">
            <form @submit.prevent="storeCountry">
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <label for="category name">Country Name</label>
                            <input type="text" v-model="form.name" class="form-control">
                            <div class="invalid-feedback" v-if="form.errors.name">{{ form.errors.name }}</div>
                        </div>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col">
                        <div class="form-group">
                            <label for="category image">Country Code</label>
                            <input type="number" v-model="form.code" class="form-control">
                            <div class="invalid-feedback" v-if="form.errors.code">{{ form.errors.code }}</div>
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