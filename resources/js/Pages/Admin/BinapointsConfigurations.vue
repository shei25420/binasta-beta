<script setup>
import { ref, onMounted } from 'vue'; 
import { useForm } from '@inertiajs/inertia-vue3';

import DataTable from 'datatables.net-vue3'
import DataTablesLib from 'datatables.net';
import 'datatables.net-bs5';
import 'datatables.net-responsive-dt';

import ModalComponent from '@/Components/GenericDashboard/ModalComponent.vue';
import GenericLayout from '@/Layouts/GenericLayout.vue';

DataTable.use(DataTablesLib);

const props = defineProps({
    configurations: Array
});

const form = useForm({
    awarded: 0,
    value: 0
});

const updateForm = ref(false);
const selectedConfig = ref(null);

const storeConfiguration = () => {
    form.clearErrors();
    if(!form.awarded && parseFloat(form.awarded) == NaN) {
        form.setError('awarded', 'Awarded field is required');
    }

    if(!form.value && parseFloat(form.value) == NaN) {
        form.setError('value', 'Value field is required');
    }

    if(form.errors && Object.keys(form.errors).length) return;

    const btn = document.getElementById("submitBtn");
    if(updateForm.value) {
        btn.innerText = "Updating...";
        form.put(`/configurations/${selectedConfig.value.id}`, {
            onSuccess() {
                updateForm.value = false;
                selectedConfig.value = null;
                form.reset();
                btn.innerText = "Save";
            },
            onError () {
                btn.innerText = "Update";
            }
        })
    } else {
        btn.innerText = "Saving...";
        form.post('/configurations', {
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

        const config_id = e.target.getAttribute("data-id");
        const type = e.target.getAttribute("data-type");

        if(type === "del") {
            if(confirm("Are you sure you want to delete this config?")) {
                form.delete(`/configurations/${config_id}`);
            }
        } else if (type === "edit") {
            selectedConfig.value = props.configurations.filter(({ id }) => id == config_id)[0];
            form.awarded = selectedConfig.value.awarded;
            form.value = selectedConfig.value.value;
            updateForm.value = true;
            $("#modalBtn").click();   
        }
    });

    $('#exampleModal').on('hide.bs.modal', function () {
        if(updateForm.value) {
            updateForm.value = false;
            selectedConfig.value = null;
            form.awarded = 0;
            form.value = 0;
        }
    });
});

</script>
    
<template>
    <GenericLayout>
        <div class="card">
            <div class="card-header">
                <h5>Binapoints Configurations</h5>
                <button type="button" id="modalBtn" data-bs-toggle="modal" data-bs-target="#exampleModal"
                        class="btn btn-icon btn-primary">
                        <i class="bi bi-plus-circle"></i> Add Config
                </button>
            </div>
            <div class="card-body">
                <DataTable id="dt" class="display table table-responsive" :options="{responsive: true}" :data="configurations" :columns="[
                    { data: 'awarded' },
                    { data: 'value' },
                    { data: 'created_at', render: (data) => {
                        return new Date(data).toDateString()
                    }},
                    { data: null, render: (data) => {
                        return `<button class='btn btn-sm btn-secondary mr-3' data-type='edit' data-id='${data.id}'>Edit</button> <button class='btn btn-sm btn-danger' data-type='del' data-id='${data.id}'>Delete</button>`
                    }}
                ]">
                    <thead>
                        <tr>
                            <th>Awarded Points</th>
                            <th>Points Value</th>
                            <th>Created At</th>
                            <th>Actions</th>
                        </tr>
                    </thead>

                </DataTable>
            </div>
        </div>
        <modal-component :title="updateForm ? 'Update Configuration' : 'Add Configuration'">
            <form @submit.prevent="storeConfiguration">
                <div class="form-group">
                    <label>Awarded Points</label>
                    <input type="number" class="form-control" v-model="form.awarded">
                    <div class="invalid-feedback" v-if="form.errors.awarded">{{ form.errors.awarded }}</div>
                </div>
                <div class="form-group mt-3">
                    <label>Points Value (optional)</label>
                    <input type="number" v-model="form.value" class="form-control">
                    <div class="invalid-feedback" v-if="form.errors.value">{{ form.errors.value }}</div>
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