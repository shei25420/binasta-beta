<script setup>
import { onMounted, ref } from 'vue';
import { useForm } from '@inertiajs/inertia-vue3';

import DataTable from 'datatables.net-vue3'
import DataTablesLib from 'datatables.net';
import 'datatables.net-bs5';
import 'datatables.net-responsive-dt';

import GenericLayout from '@/Layouts/GenericLayout.vue';
import ModalComponent from '@/Components/GenericDashboard/ModalComponent.vue';

DataTable.use(DataTablesLib);

const props = defineProps({
    product: Object
});

const form = useForm({
    variation: '',
    buying_price: 0,
    selling_price: 0,
    wholesale_price: 0,
    wholesale_min: 1,
    stock: 0,
    product_id: props.product.id
});

const updateForm = ref(false);
const selectedOption = ref(null);

const addProductOption = () => {
    form.clearErrors();
    if (!form.variation || form.variation.trim() == "") {
        form.setError('variation', 'variation field is required');
    }

    if (!form.buying_price || parseFloat(form.buying_price) === NaN) {
        form.setError('buying_price', 'buying price field is requried');
    }

    if (!form.selling_price || parseFloat(form.selling_price) === NaN) {
        form.setError('selling_price', 'selling price field is required');
    }

    if (!form.wholesale_price || parseFloat(form.wholesale_price) === NaN) {
        form.setError('wholesale_price', 'whole sale price is required');
    }

    if (!form.wholesale_min || parseInt(form.wholesale_min) === NaN) {
        form.setError('wholesale minimum field is required');
    }

    if (!form.stock || parseInt(form.stock) === NaN) {
        form.setError('stock', 'stock field is required');
    }

    if (!form.product_id || parseInt(form.product_id) === NaN) {
        form.setError('product_id', 'product field is required');
    }

    if (form.errors && Object.keys(form.errors).length) return;

    const btn = document.getElementById("submitBtn");
    if (updateForm.value) {
        btn.innerText = "Updating...";
        form.put(`/product_options/${selectedOption.value.id}`, {
            onSuccess() {
                updateForm.value = false;
                selectedOption.value = null;
                form.reset();
                btn.innerText = "Save";
            },
            onError() {
                btn.innerText = "Update";
            }
        });
    } else {
        btn.innerText = "Saving...";
        form.post('/product_options', {
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
        if (e.target.nodeName !== "BUTTON") return;

        const option_id = parseInt(e.target.getAttribute("data-id"));
        const type = e.target.getAttribute("data-type");

        if (type === "del") {
            if (confirm("Are you sure you want to delete this product variation?")) {
                form.delete(`/product_options/${option_id}`);
            }
        } else if (type === "edit") {
            selectedOption.value = props.product.product_options.filter(({ id }) => id == option_id)[0];
            form.variation = selectedOption.value.variation;
            form.buying_price = parseFloat(selectedOption.value.buying_price);
            form.selling_price = parseFloat(selectedOption.value.selling_price);
            form.wholesale_price = parseFloat(selectedOption.value.wholesale_price);
            form.wholesale_min = parseInt(selectedOption.value.wholesale_min);
            form.stock = parseInt(selectedOption.value.stock);
            form.product_id = parseInt(selectedOption.value.product_id);
            updateForm.value = true;
            $("#modalBtn").click();
        }
    });

    $('#exampleModal').on('hide.bs.modal', function () {
        if (updateForm.value) {
            form.reset();
            updateForm.value = false;
            selectedOption.value = null;
        }
    });
});
</script>

<template>
    <GenericLayout>
        <div class="row">
            <div class="col-md-12">
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-5">
                                <div v-for="image in product.images" :key="image.id" class="slider mb-3">
                                    <img :src="'/storage/' + image.url" class="w-100 rounded" alt="image" />
                                </div>
                            </div>
                            <div class="col-md-7">
                                <div class="d-flex justify-content-between align-items-start mt-4 mt-md-0">
                                    <div>
                                        <div class="small text-muted mb-2">{{ product.category_name }}</div>
                                        <h2>{{ product.name }}</h2>
                                        <p>
                                            <span v-if="product.stock" class="badge bg-success">In stock</span>
                                            <span v-else class="badge badge-danger">Out Of Stock</span>
                                        </p>
                                        <p v-html="product.description"></p>

                                        <div class="card">
                                            <div class="card-header">
                                                <ul class="nav nav-pills" role="tablist">
                                                    <li class="nav-item">
                                                        <a class="nav-link active" id="description-tab"
                                                            data-bs-toggle="tab" href="#description" role="tab"
                                                            aria-controls="description" aria-selected="true">Product
                                                            Variations</a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a class="nav-link" id="sss-tab" data-bs-toggle="tab"
                                                            href="#sss" role="tab" aria-controls="sss"
                                                            aria-selected="false">Customer Reviews ({{
                                                                    product.user_reviews.length
                                                            }})</a>
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="card-body">
                                                <div class="tab-content">
                                                    <div class="tab-pane fade show active" id="description"
                                                        role="tabpanel" aria-labelledby="description-tab">
                                                        <button type="button" id="modalBtn" data-bs-toggle="modal"
                                                            data-bs-target="#exampleModal"
                                                            class="btn btn-sm mb-2 btn-icon btn-primary">
                                                            <i class="bi bi-plus-circle"></i> Add Variation
                                                        </button>
                                                        <DataTable id="dt" class="display table table-responsive"
                                                            :options="{responsive: true}"
                                                            :data="product.product_options" :columns="[{ data: 'variation' }, { data: 'buying_price' }, { data: 'selling_price' }, { data: 'wholesale_price' }, { data: 'sold' }, { data: 'stock' }, {
                                                                data: 'created_at', render: (data) => {
                                                                    return new Date(data).toDateString();
                                                                }
                                                            }, {
                                                                data: null, render: (data) => {
                                                                    return `<button data-type=edit data-id=${data.id} class='btn btn-sm btn-secondary mr-3'>Edit</button> <button data-type=del data-id=${data.id} class='btn btn-sm btn-danger'>Delete</button>`;
                                                                }
                                                            }]">
                                                            <thead>
                                                                <tr>
                                                                    <th>Variation</th>
                                                                    <th>Buying Price</th>
                                                                    <th>Selling Price</th>
                                                                    <th>Wholesale Price</th>
                                                                    <th>Sold</th>
                                                                    <th>Stock</th>
                                                                    <th>Created At</th>
                                                                    <th>Actions</th>
                                                                </tr>
                                                            </thead>
                                                        </DataTable>
                                                    </div>
                                                    <div class="tab-pane fade" id="sss" role="tabpanel"
                                                        aria-labelledby="sss-tab">
                                                        <div class="row">
                                                            <div class="col-lg-8">
                                                                <div class="mb-5">
                                                                    <div class="display-6">4.0</div>
                                                                    <div class="d-flex gap-2 my-3">
                                                                        <i
                                                                            class="bi bi-star-fill icon-lg text-warning"></i>
                                                                        <i
                                                                            class="bi bi-star-fill icon-lg text-warning"></i>
                                                                        <i
                                                                            class="bi bi-star-fill icon-lg text-warning"></i>
                                                                        <i
                                                                            class="bi bi-star-fill icon-lg text-warning"></i>
                                                                        <i
                                                                            class="bi bi-star-fill icon-lg text-muted"></i>
                                                                        <span>(3)</span>
                                                                    </div>
                                                                </div>
                                                                <div class="list-group list-group-flush mb-4">
                                                                    <div class="list-group-item d-flex px-0"
                                                                        v-for="review in product.user_reviews"
                                                                        :key="review.id">
                                                                        <div class="avatar flex-shrink-0 me-3">
                                                                            <span
                                                                                class="avatar-text bg-purple rounded-circle">R</span>
                                                                        </div>
                                                                        <div>
                                                                            <h5 class="mb-1">Rodger Stutely</h5>
                                                                            <div class="d-flex gap-2 mb-3">
                                                                                <i
                                                                                    class="bi bi-star-fill text-warning"></i>
                                                                                <i
                                                                                    class="bi bi-star-fill text-warning"></i>
                                                                                <i
                                                                                    class="bi bi-star-fill text-warning"></i>
                                                                                <i
                                                                                    class="bi bi-star-fill text-warning"></i>
                                                                                <i
                                                                                    class="bi bi-star-fill text-muted"></i>
                                                                            </div>
                                                                            <div>
                                                                                {{ review.review }}
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <modal-component :title="updateForm ? 'Update Variation' : 'Add Variation'">
            <form @submit.prevent="addProductOption">
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <label for="Variation">Variation</label>
                            <input v-model="form.variation" type="text" class="form-control">
                            <div class="invalid-feedback" v-if="form.errors.variation">{{ form.errors.variation }}</div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label for="Variation">Stock</label>
                            <input v-model="form.stock" type="text" class="form-control">
                            <div class="invalid-feedback" v-if="form.errors.stock">{{ form.errors.stock }}</div>
                        </div>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col">
                        <div class="form-group">
                            <label for="Buying Price">Buying Price</label>
                            <input type="text" v-model="form.buying_price" class="form-control">
                            <div class="invalid-feedback" v-if="form.errors.buying_price">{{ form.errors.buying_price }}
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label for="Selling Price">Selling Price</label>
                            <input type="text" v-model="form.selling_price" class="form-control">
                            <div class="invalid-feedback" v-if="form.errors.selling_price">{{ form.errors.selling_price
                            }}</div>
                        </div>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col">
                        <div class="form-group">
                            <label for="Selling Price">Wholesale Price</label>
                            <input type="text" v-model="form.wholesale_price" class="form-control">
                            <div class="invalid-feedback" v-if="form.errors.wholesale_price">{{
                                    form.errors.wholesale_price
                            }}</div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label for="Wholesale Mininum">Wholesale Minimum</label>
                            <input type="text" v-model="form.wholesale_min" class="form-control">
                            <div class="invalid-feedback" v-if="form.errors.wholesale_min">{{ form.errors.wholesale_min
                            }}</div>
                        </div>
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col">
                        <button type="button" class="btn btn-danger" style="margin-right: 10px;"
                            data-bs-dismiss="modal">Close</button>
                        <button id="submitBtn" type="submit" class="btn btn-primary">{{ updateForm ? 'Update' : 'Save'
                        }}</button>
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