<script setup>
import { ref } from 'vue';

const emit = defineEmits(['selectUser']);

const query = ref('');
const searchResults = ref([]);

let handler;
const searchUser = () => {
    clearTimeout(handler);
    if (!query.value || query.value == "") {
        searchResults.value = [];
        return;
    }

    handler = setTimeout(() => {
        fetch('/users/search/' + query.value)
            .then(res => res.json())
            .then(data => searchResults.value = data)
            .catch(err => console.log("user search err", err))
    }, 200)
};

const selectUser = (user) => {
    query.value = user.email;
    searchResults.value = [];
    emit('selectUser', user);
};

</script>
    
<template>
    <form>
        <div class="form-group">
            <label for="search user">Search User</label>
            <input @keyup.prevent="searchUser" type="text" class="form-control" v-model="query" />
        </div>
    </form>
    <ul v-if="searchResults.length" class="list-group list-group-flush">
        <li v-for="result in searchResults" :key="result.id" @click="selectUser(result)" class="list-group-item">{{ result.email }}</li>
    </ul>
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