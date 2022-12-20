<script setup>
import { useForm } from '@inertiajs/inertia-vue3';
import DataTable from 'datatables.net-vue3'
import DataTablesLib from 'datatables.net';
import 'datatables.net-bs5';
import 'datatables.net-responsive-dt';

import ModalComponent from '@/Components/GenericDashboard/ModalComponent.vue';
import GenericLayout from '@/Layouts/GenericLayout.vue';

DataTable.use(DataTablesLib);

const form = useForm({
    email: '',
});
const props = defineProps({
    users: Array
});

const generatePassword = () => {
    let chars = "0123456789abcdefghijklmnopqrstuvwxyz!@#$%^&*()ABCDEFGHIJKLMNOPQRSTUVWXYZ";
    let passwordLength = 12;
    let password = "";
    for (let i = 0; i <= passwordLength; i++) {
        let randomNumber = Math.floor(Math.random() * chars.length);
        password += chars.substring(randomNumber, randomNumber + 1);
    }
    return password;
};

const storeUser = () => {
    form.clearErrors();
    if(!form.email || form.email.trim() == "") {
        form.setError('email', 'email field is required');
        return;
    }

    const btn = document.getElementById('submitBtn');
    btn.innerText = "Saving...";
    form
        .transform((data) => ({ ...data, password: generatePassword() }))
        .post('/users', {
            onSuccess: () => {
                form.reset();
            },
            onFinish: () => {
                btn.innerText = "Save";
            }
        });
};
</script>
    
<template>
    <GenericLayout>
        <div class="card">
            <div class="card-header">
                <h5>Users</h5>
                <button type="button" id="modalBtn" data-bs-toggle="modal" data-bs-target="#exampleModal"
                        class="btn btn-icon btn-primary">
                        <i class="bi bi-plus-circle"></i> Add User
                </button>
            </div>
            <div class="card-body">
                <DataTable id="dt" class="display table table-responsive" :data="users" :columns="[{ data: 'email' }, {data: 'orders_count'}, {
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
        <modal-component title="Add User">
            <form @submit.prevent="storeUser">
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" v-model="form.email" class="form-control" />
                            <div class="invalid-feedback" v-if="form.errors.email">{{ form.errors.email }}</div>
                        </div>
                    </div>
                </div>
                <div class="form-group mt-4">
                    <button type="button" class="btn btn-danger" style="margin-right: 10px;"
                        data-bs-dismiss="modal">Close</button>
                    <button id="submitBtn" type="submit" class="btn btn-primary">Save</button>
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