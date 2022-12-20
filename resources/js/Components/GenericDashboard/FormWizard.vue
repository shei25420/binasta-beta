<script setup>
import { ref } from 'vue';
import { useForm } from '@inertiajs/inertia-vue3';

import '../../../assets/generic_dashboard/libs/form-wizard/jquery.steps.css';

import SearchUser from "./SearchUser.vue";
import NewUser from "./NewUser.vue";

import SearchUserAddress from './SearchUserAddress.vue';
import NewUserAddress from './NewUserAddress.vue';
import SearchProduct from './SearchProduct.vue';

const formSteps = ref({
    current_step: 1,
    no_steps: 3
});

const form = useForm({
    user_id: '',
    user_address_id: ''
});


const selectedProducts = ref([]);
const selectedUser = ref(null);
const selectedAddress = ref(null);

const selectUser = (user) => {
    selectedUser.value = user;
    form.user_id = user.id;
    ++formSteps.value.current_step;
};

const selectAddress = (location) => {
    form.user_address_id = location.id;
    selectedAddress.value = location;
    ++formSteps.value.current_step;
};

const selectProduct = (product) => {
    selectedProducts.value.push(product);
};

</script>
    
<template>
    <div id="wizard1" role="application" class="wizard clearfix">
        <div class="steps clearfix">
            <ul role="tablist">
                <li role="tab" class="first" :class="[formSteps.current_step === 1 ? 'current' : '']">
                    <a id="wizard1-t-0" href="#">
                        <span class="current-info audible">current step: </span>
                        <span class="wizard-index">1</span>
                        Personal Information
                    </a>
                </li>
                <li role="tab" class="done">
                    <a id="wizard1-t-1" href="#wizard1-h-1">
                        <span class="wizard-index">2</span>
                        Billing Information
                    </a>
                </li>
                <li role="tab" class="last done">
                    <a id="wizard1-t-2" href="#">
                        <span class="wizard-index">3</span>
                        Payment Details
                    </a>
                </li>
            </ul>
        </div>
        <div class="content clearfix">
            <div class="row" v-if="formSteps.current_step === 1">
                <div class="col">
                    <div class="card">
                        <div class="card-body text-center">
                            <div class="avatar avatar-xl mb-3">
                                <img src="../../../assets/images/generic_dashboard/search.png"
                                    class="rounded-circle img-fluid" alt="...">
                            </div>
                            <div class="mb-4">
                                <h5 class="mb-1">Search User</h5>
                            </div>
                            <div class="gap-3">
                                <search-user @select-user="selectUser" />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card">
                        <div class="card-body text-center">
                            <div class="avatar avatar-xl mb-3">
                                <img src="../../../assets/images/generic_dashboard/user-add.png"
                                    class="rounded-circle img-fluid" alt="...">
                            </div>
                            <div class="mb-4">
                                <h5 class="mb-1">Create User</h5>
                            </div>
                            <div class="gap-3">
                                <new-user @created-user="selectUser" res="json" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row" v-if="formSteps.current_step === 2">
                <div class="col">
                    <div class="card">
                        <div class="card-body text-center">
                            <div class="avatar avatar-xl mb-3">
                                <img src="../../../assets/images/generic_dashboard/search-address.png"
                                    class="rounded-circle img-fluid" alt="...">
                            </div>
                            <div class="mb-4">
                                <h5 class="mb-1">Search Address</h5>
                            </div>
                            <div class="gap-3">
                                <search-user-address @select-address="(location) => form.user_address_id = location.id"
                                    :user_id="form.user_id" />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card">
                        <div class="card-body text-center">
                            <div class="avatar avatar-xl mb-3">
                                <img src="../../../assets/images/generic_dashboard/address-add.webp"
                                    class="rounded-circle img-fluid" alt="...">
                            </div>
                            <div class="mb-4">
                                <h5 class="mb-1">Add Address</h5>
                            </div>
                            <div class="gap-3">
                                <new-user-address :user_id="form.user_id" res="json" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row" v-if="formSteps.current_step === 3">
                <div class="col">
                    <div class="card">
                        <div class="card-body">
                            <search-product />

                            <table class="table table-response">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Variation</th>
                                        <th>Sub Total</th>
                                    </tr>
                                </thead>
                                <body>
                                    <tr v-for="product in selectedProducts" :key="product.id">
                                        <td>{{ product.name }}</td>
                                        <td>
                                            <select name="" id="" class="form-control">
                                                <option v-for="(option, index) in product.productOptions" :key="option.id" :value="option.id" :selected="index === 1">
                                                    {{ option.variation }}
                                                </option>
                                            </select>
                                        </td>
                                    </tr>
                                </body>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="actions clearfix">
            <ul role="menu" aria-label="Pagination">
                <li class="disabled" aria-disabled="true"><a class="btn" href="#previous" role="menuitem">Previous</a>
                </li>
                <li aria-hidden="false" aria-disabled="false" class="" style=""><a class="btn" href="#next"
                        role="menuitem">Next</a></li>
                <li aria-hidden="true" style="display: none;"><a class="btn" href="#finish" role="menuitem">Finish</a>
                </li>
            </ul>
        </div>
    </div>
</template>

<style scoped>
.wizard>.steps .current a,
.wizard>.steps .current a:active,
.wizard>.steps .current a:hover {
    background: #ff6e40;
    color: #fff !important;
}
</style>