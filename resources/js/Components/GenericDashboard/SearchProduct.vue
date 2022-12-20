<script setup>
import { ref } from 'vue';

const emit = defineEmits(['selectedProduct']);
const query = ref("");

let handler;
const searchResults = ref([]);
const searchProduct = () => {
    if(query.value == "" || !query.value) return;
    
    clearTimeout(handler);
    handler = setTimeout(() => {
        fetch('/products/search/' + query.value)
        .then(res => res.json())
        .then(data => searchResults.value = data)
        .catch(err => console.log("product search err", err));
    }, 200);
};

const selectProduct = (product) => {
    query.value = product.name;
    searchResults.value = [];
    emit('selectedProduct', product);
};

</script>
    
<template>
    <form>
        <div class="form-group">
            <label for="Search Product">Search Product</label>
            <input @keyup.prevent="searchProduct" type="text" v-model="query" class="form-control">
        </div>
        <ul v-if="searchResults.length" class="list-group list-group-flush">
        <li v-for="result in searchResults" :key="result.id" @click="selectProduct(result)" class="list-group-item">{{ result.name }}</li>
    </ul>
    </form>
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