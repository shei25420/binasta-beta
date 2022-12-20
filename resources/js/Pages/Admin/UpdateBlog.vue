<script setup>
import { useForm } from '@inertiajs/inertia-vue3';
import GenericLayout from '@/Layouts/GenericLayout.vue';
import ClassicEditor from "@ckeditor/ckeditor5-build-classic";

defineProps({
    post: Object,
    categories: Array
});

const form = useForm({
    blog_category_id: post.blog_category_id,
    title: post.title,
    description: post.description,
    blog_post: post.blog_post,
    link_path: post.type == 2 ?? post.link_path,
    type: post.type,
    image: null,
});

const submitPost = () => {
    form.post('/blogs');
};

</script>

<template>
    <GenericLayout>
        <div class="card">
            <div class="card-header"><h4>Update Post</h4></div>
            <div class="card-body">
                <form @submit.prevent="submitPost">
                    <div class="form-group">
                        <label for="title">Post Title</label>
                        <input v-model="form.title" type="text" class="form-control">
                    </div>
                    <div class="form-group mt-3">
                        <label for="description">Description</label>
                        <textarea class="form-control" v-model="form.description"></textarea>
                    </div>
                    <div class="form-group mt-3">
                        <label for="category">Blog Category</label>
                        <select v-model="form.blog_category_id" class="form-control">
                            <option value="">Select Category</option>
                            <option v-for="category in categories" :key="category.id" :value="category.id">{{
                                    category.name
                            }}</option>
                        </select>
                    </div>
                    <div class="form-group mt-3">
                        <label for="type">Post Type</label>
                        <select v-model="form.type" class="form-control">
                            <option value="0">Normal Post</option>
                            <option value="1">Quote</option>
                            <option value="2">Video Post</option>
                        </select>
                    </div>
                    <div v-if="form.type == 0 || form.type == 1" class="form-group mt-3">
                        <label for="post">Blog Post</label>
                        <ckeditor :editor="ClassicEditor" v-model="form.blog_post" />
                    </div>
                    <div v-if="form.type == 2" class="form-group mt-3">
                        <label for="quote">Video Link (Youtube)</label>
                        <input class="form-control" v-model="form.link_path" />
                    </div>
                    <div v-if="form.type == 0" class="form-group mt-3">
                        <label for="image">Post Feature Image</label>
                        <input type="file" @input="form.image = $event.target.files[0]" class="form-control">
                    </div>
                    <div class="form-group mt-4">
                        <button type="submit" class="btn btn-primary">Create Post</button>
                    </div>
                </form>
            </div>
        </div>
    </GenericLayout>

</template>