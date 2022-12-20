<script setup>
import { useForm } from '@inertiajs/inertia-vue3';

const emit = defineEmits(['storedAddress']);
const props = defineProps(['res', 'user_id']);
const form = useForm({
    location: '',
    phone_number: '',
    user_id: props.user_id
});

const storeAddress = () => {
    if (!props.res) {
        form.post('/user_addresses');
    } else {
        fetch('/user_addresses', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                'Accept': 'application/json'
            },
            credentials: "same-origin",
            body: JSON.stringify({ 
                location: form.location, 
                phone_number: form.phone_number, 
                user_id: form.user_id
            })
        })
            .then(res => res.json())
            .then(data => emit('storedAddress', data))
            .catch(err => console.log("store user address", err));
    }
};

</script>
    
<template>
    <form @submit.prevent="storeAddress">
        <div class="form-group">
            <label for="location">Location</label>
            <input v-model="form.location" type="text" class="form-control">
        </div>
        <div class="form-group mt-3">
            <label for="phone number">Phone Number</label>
            <input type="text" v-model="form.phone_number" class="form-control">
        </div>
        <div class="form-group mt-4">
            <button type="button" class="btn btn-danger" style="margin-right: 10px;"
                data-bs-dismiss="modal">Close</button>
            <button id="submitBtn" type="submit" class="btn btn-primary">Save</button>
        </div>

    </form>
</template>
<style>

</style>