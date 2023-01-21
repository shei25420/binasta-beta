<script setup>
import { Link } from '@inertiajs/inertia-vue3';
import { onMounted } from 'vue';
import imagesLoaded from 'imagesloaded';
import isotope from 'isotope-layout';
import PageBanner from '@/Components/Main/PageBanner.vue';

import MainLayout from '@/Layouts/MainLayout.vue';
defineProps({
    posts: Array
});

onMounted(() => {
    imagesLoaded('.grid', function () {
        new isotope('.grid', {
            itemSelector: '.grid-item',
            percentPosition: !0,
            masonry: { columnWidth: 1 }
        })
    });
});

</script>

<template>
    <MainLayout>
        <PageBanner header="Blog" />
        <div class="blog-area page-blog">
            <div class="container">
                <div class="row grid">
                    <div v-for="post in posts" :key="post.id" class="col-lg-4 col-md-6 col-12 grid-item">
                        <article v-if="post.type == 0" class="single-blog sticky">
                            <div class="blog-thumb">
                                <img class="lazy" src="../../../assets/shop/imgs/theme/img_loading.gif" :data-src="'/storage/' + post.image_path" alt="">
                                <ul class="post-meta  d-flex justify-content-between">
                                    <li><a href="#"><i class="icofont">ui_calendar</i> {{ new Date(post.created_at).toDateString() }} </a></li>
                                </ul>
                            </div><!-- end blog thumb -->
                            <div class="blog-text">
                                <h4><Link :href="'/blog/' + post.slug">{{ post.title }}</Link></h4>
                                <p>
                                    {{ post.description }}
                                    <Link :href="'/blog/' + post.slug">[...]</Link>
                                </p>
                            </div>
                        </article>
                        <article v-else-if="post.type == 1" class="single-blog qute">
                            <div class="blog-text">
                                <div class="quation"><i class="icofont">quote_right</i></div>
                                <h4 v-html="post.post"></h4>
                                <ul class="post-meta  d-flex justify-content-between">
                                    <li><a href="#"><i class="icofont">ui_calendar</i> {{ new Date(post.created_at).toDateString() }} </a></li>
                                </ul>
                            </div>
                        </article>
                        <article v-else-if="post.type == 2" class="single-blog audio">
                            <iframe width="100%" height="360" scrolling="no" frameborder="no" allow="autoplay"
                                :src="post.link_path"></iframe>
                            <div class="blog-text">
                                <ul class="post-meta  d-flex justify-content-between">
                                    <li><a href="#"><i class="icofont">ui_calendar</i>  {{ new Date(post.created_at).toDateString() }}  </a></li>
                                </ul>
                            </div>
                        </article>
                    </div><!-- end single blog -->
                </div>
            </div>
        </div>
    </MainLayout>
</template>