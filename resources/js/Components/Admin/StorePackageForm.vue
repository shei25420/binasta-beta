<script setup>
import { onMounted } from 'vue';
import ClassicEditor from "@ckeditor/ckeditor5-build-classic";

defineProps({
    selectedPackage: Object
});

const form = useForm({
    name: '',
    description: '',
    image: null,
    product_options: []
});

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
});

</script>

<template>
    <form @submit.prevent="storePackage">
        <div class="form-group">
            <label for="Name">Name</label>
            <input v-model="form.name" type="text" class="form-control">
            <div class="invalid-feedback" v-if="form.errors.name">{{ form.errors.name }}</div>
        </div>
        <div class="form-group">
            <label for="Name">Description</label>
            <ckeditor :editor="ClassicEditor" v-model="form.description" />
            <div class="invalid-feedback" v-if="form.errors.description">{{ form.errors.description }}</div>
        </div>
        <div class="form-group mt-3">
            <label for="product options">Product Options</label>
            <select v-model="form.product_options" class="select2-example" multiple>
                <option>Select</option>
                <option v-for="product_option in product_options" :key="product_option.id" :value="product_option.id">{{
                    product_option.product.name + " - " +
                        product_option.variation
                }}</option>
            </select>
            <div class="invalid-feedback" v-if="form.errors.product_options">{{ form.errors.product_options }}</div>
        </div>
        <div class="form-group mt-3">
            <label for="package image">Feature Images</label>
            <input type="file" @change="(e) => form.image = e.target.files[0]" class="form-control">
            <div class="invalid-feedback" v-if="form.errors.product_options">{{ form.errors.product_options }}</div>
        </div>
        <div class="form-group mt-4">
            <button type="button" class="btn btn-danger" style="margin-right: 10px;"
                data-bs-dismiss="modal">Close</button>
            <button id="submitBtn" type="submit" class="btn btn-primary">{{ updateForm? 'Update': 'Save' }}</button>
        </div>
    </form>

</template>