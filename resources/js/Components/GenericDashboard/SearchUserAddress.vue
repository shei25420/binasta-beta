<script setup>
import { ref } from 'vue';

const emit = defineEmits(['selectAddress']);
const props = defineProps(['user_id']);

const query = ref("");
const searchResults = ref([]);

let handler;
const searchAddress = () => {
    if(!query.value || query.value == "") return;
    
    clearTimeout(handler);
    handler = setTimeout(() => {
        fetch('/user_addresses/' + query.value + '?id=' + props.user_id)
        .then(res => res.json())
        .then(data => searchResults.value = data)
        .catch(err => console.log("select address err", err));
    }, 2000);
};

const selectAddress = (address) => {
    query.value = address.location;
    searchResults.value = [];
    emit('selectAddress', address);
};

</script>
    
<template>
    <div class="row">
        <div class="col">
            <div class="form-group">
                <label for="search address">Search Address</label>
                <input type="text" @keyup.prevent="searchAddress" v-model="query" class="form-control">
            </div>
            <ul v-if="searchResults.length" class="list-group list-group-flush">
                <li v-for="result in searchResults" :key="result.id" @click="selectAddress(result)" class="list-group-item">{{ result.location }}</li>
            </ul>
        </div>
    </div>
</template>
<style scoped>
    .list-group-item {
        list-style: none;
        position: relative;
        display: block;
        padding: 0.75rem 1.5rem;
        text-decoration: none;
        background-color: #fff;
        border: 1px solid rgba(0,0,0,.125);
    }
    .list-group-item:hover {
        background-color: rgba(255, 255, 255, 0.315);
        cursor: pointer;
    }
</style>