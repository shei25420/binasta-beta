<script setup>
import { Link } from '@inertiajs/inertia-vue3';
import PageBanner from '@/Components/Main/PageBanner.vue';

defineProps({
    post: Object,
    categories: Array,
    new_posts: Array
});
</script>

<template>
    <PageBanner :header="post.title" />
    <div class="page-content minus-padding">
    <div class="container">
        <div class="row">

            <div class="col-lg-9">
                <article class="single-blog-detials">
                    <img :src="'/storage/' + post.image_path" alt="">
                    <ul class="post-meta  d-flex justify-content-between">
                        <li><a href="#"><i class="icofont">ui_calendar</i> {{ new Date(post.created_at).toDateString() }}</a></li>
                        <li><a href="#"><i class="icofont">comment</i>30</a></li>
                        <li><a href="#"><i class="icofont">user_alt_4</i> Tonmoy Khan</a></li>
                    </ul>
                    <h2>{{ post.title }}</h2>
                    
                    <div v-html="post.post"></div>
                </article>
                <hr><!-- end articel section -->
                
            </div><!-- end single blog conetent -->

            <div class="col-lg-3">
                <aside class="sidebar-wrapper">
                    <div class="single-sidebar">
                        <div class="sideabrHeader">
                            <span> CATEGORIES</span>
                        </div>
                        <ul>
                            <li v-for="category in categories"><a href="#">{{ category.name }}</a></li>
                        </ul>
                    </div><!-- end single sidebar -->
                    <div class="single-sidebar">
                        <div class="sideabrHeader">
                            <span>RECENT POST</span>
                        </div>
                        <div  v-for="new_post in new_posts" :key="new_post.slug" class="media mt-5">
                            <Link :href="'/blog/' + new_post.slug"><img class="mr-3" :src="'/storage/' + new_post.image_path" alt="" /></Link>
                            <div class="media-body align-self-center">
                                <h5><Link :href="'/blog/' + new_post.slug">{{ new_post.post }}</Link></h5>
                                <span><Link :href="'/blog/' + new_post.slug">{{ new Date(new_post.created_at).toDateString() }}</Link></span>
                            </div>
                        </div>
                    </div><!-- end single sidebar -->
                </aside>
            </div>
        </div>
    </div>
</div>

</template>