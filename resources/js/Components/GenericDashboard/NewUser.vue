<script setup>
import { useForm } from '@inertiajs/inertia-vue3';

import General from '@/Helpers/General';

const props = defineProps(['res']);
const emit = defineEmits(['createdUser']);

const form = useForm({
    email: ''
});


const storeUser = () => {
    const path = props.res ? '/users?res=json' : '/users'
    if(!props.res) {
        form
        .transform((data) => ({ ...data, password: General.generatePassword() }))
        .post(path);
    } else {
        const body = JSON.stringify({email: form.email, _token: $('meta[name="csrf-token"]').attr('content')});
        console.log(body);
        fetch(path, {
            method: 'POST',
            headers: {
                'Content-Type' : 'application/json'
            },
            body 
        })
        .then(res => res.json())
        .then(data => emit('createdUser', data))
        .catch(err => console.log("Created User", err))
    }
}

</script>
<template>
    <form @submit.prevent="storeUser">
        <div class="form-group">
            <label for="email">Email</label>
            <input type="text" v-model="form.email" class="form-control">
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