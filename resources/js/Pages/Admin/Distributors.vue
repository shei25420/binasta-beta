<script setup>
import { useForm } from '@inertiajs/inertia-vue3'
import { ref, onMounted, nextTick } from 'vue'

import ApexCharts from "vue3-apexcharts";
import DataTable from 'datatables.net-vue3'
import DataTablesLib from 'datatables.net'
import 'datatables.net-bs5'
import 'datatables.net-responsive-dt';

import ModalComponent from '@/Components/GenericDashboard/ModalComponent.vue'
import GenericLayout from '@/Layouts/GenericLayout.vue'

DataTable.use(DataTablesLib);

const props = defineProps({
    distributors: Array,
    countries: Array
});

const form = useForm({
    first_name: '',
    last_name: '',
    email: '',
    country_id: '',
    gender: '',
    domain: '',
    distributor_id: ''
});

const distributorRef = ref('');
const parent_distributor_id = ref(null);
const selectedDistributor = ref(null);

const series = ref([{
    name: "Distributors",
    data: []
}]);

const xaxis = ref([]);

let options = ref({
    chart: {
        type: 'line',
        offsetX: -15,
        foreColor: '#b8b8b8',
        zoom: {
            enabled: false
        },
        toolbar: {
            show: false
        }
    },
    dataLabels: {
        enabled: false
    },
    theme: {
        mode: $('body').hasClass('dark') ? 'dark' : 'light',
    },
    colors: ["#ff6e40"],
    stroke: {
        width: 4,
        curve: 'smooth'
    },
    legend: {
        show: false
    },
    markers: {
        size: 0,
        hover: {
            sizeOffset: 6
        }
    },
    yaxis: {
        min: 0,
        tickAmount: 1
    },
    xaxis: {
        min: xaxis.value[xaxis.value.length - 1],
        categories: xaxis.value,
    },
    tooltip: {
        y: [
            {
                title: {
                    formatter: function (val) {
                        return val
                    }
                }
            },
            {
                title: {
                    formatter: function (val) {
                        return val
                    }
                }
            },
            {
                title: {
                    formatter: function (val) {
                        return val;
                    }
                }
            }
        ]
    },
    grid: {
        borderColor: '#ededed',
    }
});

let handler;
const fetchDistributorId = () => {
    clearTimeout(handler)

    handler = setTimeout(() => {
        fetch('/distributors/ref/' + distributorRef.value)
            .then(res => res.json())
            .then(data => (parent_distributor_id.value = data.id))
            .catch(err => console.log('fetchDistributorId', err))
    }, 2000)
}

const generatePassword = () => {
    let chars =
        '0123456789abcdefghijklmnopqrstuvwxyz!@#$%^&*()ABCDEFGHIJKLMNOPQRSTUVWXYZ'
    let passwordLength = 12
    let password = ''
    for (let i = 0; i <= passwordLength; i++) {
        let randomNumber = Math.floor(Math.random() * chars.length)
        password += chars.substring(randomNumber, randomNumber + 1)
    }
    return password
}

const storeDistributor = () => {
    form.clearErrors();
    if (!form.first_name || form.first_name.trim() == "") {
        form.setError('first_name', 'first name field is required');
    }

    if (!form.last_name || form.last_name.trim() == "") {
        form.setError('last_name', 'last name field is required');
    }

    if (!form.email || form.email.trim() == "") {
        form.setError('email', 'email field is required');
    }

    if (!form.country_id || parseInt(form.country_id) === NaN) {
        form.setError('country_id', 'country field is required');
    }

    if (!form.gender || parseInt(form.gender) === NaN) {
        form.setError('gender', 'gender field is required');
    }

    if (!form.domain || form.domain.trim() == "") {
        form.setError('domain', 'domain field is required');
    }

    if (form.errors && Object.keys(form.errors).length) return;

    const btn = document.getElementById('submitBtn');
    btn.innerText = "Saving...";
    form.transform(data => ({
        ...data,
        password: generatePassword(),
        parent_distributor_id: parent_distributor_id.value
    })).post('/distributors', {
        onSuccess() {
            form.reset();
            parent_distributor_id.value = "";
        },
        onFinish() {
            btn.innerText = "Save";
        }
    })
}

const totalDistributors = ref(0);
onMounted(() => {
    document.getElementById("dt").addEventListener('click', function (e) {
        if (e.target.nodeName !== "BUTTON") return;

        const distributor_id = e.target.getAttribute("data-id");
        const type = e.target.getAttribute("data-type");

        if (type === "del") {
            if (confirm("Are you sure you want to delete this distributor?")) {
                form.delete(`/distributors/${distributor_id}`);
            }
        } else if (type === "suspend") {
            if (confirm("Are you sure you want to suspend this distributor?")) {
                selectedDistributor.value = props.distributors.filter(({ id }) => id == distributor_id)[0];
                form.distributor_id = selectedDistributor.value.id;
                form.post('/distributors/suspend');
            }
        } else if (type === "verify") {
            if (confirm("Are you sure you want to verify this distributor?")) {
                selectedDistributor.value = props.distributors.filter(({ id }) => id == distributor_id)[0];
                form.distributor_id = selectedDistributor.value.id;
                form.post('/distributors/verify');
            }
        }
    });
    props.distributors.forEach(distributor => {
        if (series.value[0].data.length < 10) {
            const date = new Date(distributor.created_at);
            if (!options.value.xaxis.categories.includes(`${date.getDay()} ${date.toLocaleDateString("en-us", { month: "short" })}`)) options.value.xaxis.categories.push(`${date.getDay()} ${date.toLocaleDateString("en-us", { month: "short" })}`)
            series.value[0].data.push(distributor.total);
        }
        totalDistributors.value++;
    });

    series.value[0].data.reverse();
    options.value.xaxis.categories.reverse();
    options.value.xaxis.min = options.value.xaxis.categories[0];
    nextTick(() => {
        window.dispatchEvent(new Event('resize'));
    });
});

</script>

<template>
    <GenericLayout>
        <div class="row g-4 mb-4">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body" style="position: relative;">
                        <h6 class="card-title">New Distributors</h6>
                        <div style="max-height: 295px;">
                            <ApexCharts :options="options" :series="series" height="200" width='103%' />
                        </div>
                        <div class="resize-triggers">
                            <div class="expand-trigger">
                                <div style="width: 996px; height: 275px;"></div>
                            </div>
                            <div class="contract-trigger"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <div class="mb-4">
                            <h6 class="card-title mb-0">No.Of Distributors</h6>
                        </div>
                        <div class="text-center">
                            <div class="display-6">
                                <span><i class="bi bi-truck h1" data-v-ca37e4bd=""></i></span>
                            </div>
                            <h4>{{ totalDistributors }}</h4>
                        </div>
                        <div class="text-muted d-flex align-items-center justify-content-center">
                            <span class="text-success me-3 d-block">
                                <i class="bi bi-arrow-up me-1 small"></i>+35
                            </span> Point from last month
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-header">
                <h5>Distributors</h5>
                <button type="button" id="modalBtn" data-bs-toggle="modal" data-bs-target="#exampleModal"
                    class="btn btn-icon btn-primary">
                    <i class="bi bi-plus-circle"></i> Add Distributor
                </button>
            </div>
            <div class="card-body">
                <DataTable id="dt" :options="{ responsive: true }" class="display table table-responsive"
                    :data="distributors" :columns="[
                        { data: 'ref' },
                        { data: 'first_name' },
                        { data: 'last_name' },
                        { data: 'email' },
                        {
                            data: 'gender',
                            render: data => {
                                return data ? 'Female' : 'Male';
                            }
                        },
                        {
                            data: 'country',
                            render: data => {
                                return data.name;
                            }
                        },
                        { data: 'binapoints' },
                        { data: 'balance' },
                        {
                            data: 'patron',
                            render: data => {
                                return data
                                    ? `${data.first_name} ${data.last_name}`
                                    : `<span class='badge bg-primary'>Binasta Ltd.</span>`;
                            }
                        },
                        {
                            data: 'verified',
                            render: data => {
                                return data
                                    ? `<span class='badge bg-success'>Verified</span>`
                                    : `<span class='badge bg-danger'>Unverified</span>`;
                            }
                        },
                        {
                            data: 'suspended',
                            render: data => {
                                return data
                                    ? `<span class='badge bg-danger'>Suspended</span>`
                                    : `<span class='badge bg-success'>Active</span>`;
                            }
                        },
                        {
                            data: 'created_at',
                            render: data => {
                                return new Date(data).toDateString()
                            }
                        },
                        {
                            data: null,
                            render: data => {
                                let actions = '';
                                if (data.suspended) actions += `<button data-id='${data.id}' data-type='suspend' class='btn btn-sm btn-secondary mr-3'>Block</button>`;
                                else `<button data-id='${data.id}' data-type='suspend' class='btn btn-sm btn-secondary mr-3'>Unblock</button>`;
                    
                                if (data.verified == 0) actions += `<button data-id='${data.id}' data-type='verify' class='btn btn-sm btn-success mr-3'>Verify</button> `;
                                actions += `<button data-id='${data.id}' data-type='del' class='btn btn-sm btn-danger'>Delete</button>`;
                                return actions;
                            }
                        }
                    ]">
                    <thead>
                        <tr>
                            <th>Ref No.</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Email</th>
                            <th>Gender</th>
                            <th>Country</th>
                            <th>Binapoints</th>
                            <th>Balance</th>
                            <th>Parent</th>
                            <th>Verified</th>
                            <th>Suspended</th>
                            <th>Created At</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                </DataTable>
            </div>
        </div>
        <modal-component title="Add Distributor">
            <form @submit.prevent="storeDistributor">
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <label>First Name</label>
                            <input type="text" v-model="form.first_name" class="form-control" />
                            <div class="invalid-feedback" v-if="form.errors.first_name">{{ form.errors.first_name }}
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label>Last Name</label>
                            <input type="text" v-model="form.last_name" class="form-control" />
                            <div class="invalid-feedback" v-if="form.errors.last_name">{{ form.errors.last_name }}</div>
                        </div>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col">
                        <div class="form-group">
                            <label>Email</label>
                            <input type="text" v-model="form.email" class="form-control" />
                            <div class="invalid-feedback" v-if="form.errors.email">{{ form.errors.email }}</div>
                        </div>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col">
                        <div class="form-group">
                            <label for="gender">Gender</label>
                            <select v-model="form.gender" class="form-control">
                                <option value="">Select Gender</option>
                                <option value="0">Male</option>
                                <option value="1">Female</option>
                            </select>
                            <div class="invalid-feedback" v-if="form.errors.gender">{{ form.errors.gender }}</div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label for="country">Country</label>
                            <select v-model="form.country_id" class="form-control">
                                <option value="">Select Country</option>
                                <option v-for="country in countries" :key="country.id" :value="country.id">
                                    {{ country.name }}
                                </option>
                            </select>
                            <div class="invalid-feedback" v-if="form.errors.country_id">{{ form.errors.country_id }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col">
                        <label for="domain">Prefered Domain Name</label>
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" v-model="form.domain" />
                            <span class="input-group-text" id="basic-addon2">.binasta.co.ke</span>
                        </div>
                        <div class="invalid-feedback" v-if="form.errors.domain">{{ form.errors.domain }}</div>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col">
                        <label for="parent_id">Parent Ref No.</label>
                        <input type="text" @keyup="fetchDistributorId" v-model="distributorRef" class="form-control" />
                        <div class="invalid-feedback" v-if="form.errors.parent_distributor_id">{{
                            form.errors.parent_distributor_id
                        }}</div>
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col">
                        <div class="form-group">
                            <button type="button" class="btn btn-danger" style="margin-right: 10px"
                                data-bs-dismiss="modal">
                                Close
                            </button>
                            <button id="submitBtn" type="submit" class="btn btn-primary">
                                Save
                            </button>
                        </div>
                    </div>
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
