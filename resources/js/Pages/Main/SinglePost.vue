<script setup>
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
                    
                    {!! post.post  !!}
                </article>
                <hr><!-- end articel section -->
                <div class="comments-section">
                    <h3 class="section-title xs2">3 comments</h3>
                    <br>
                    <div class="media single-comments">
                        <a class="mr-4" href="#">
                            <img class=" rounded-circle img-thumbnail" src="assets/images/all-img/comments1.jpg" alt=""></a>
                        <div class="media-body">
                            <h5 class="mt-0">Tonmoy Khan <span>25 Nov, 2018 at 10.30 am</span></h5>
                            <p>If your delts are a weakness, or you find it’s a muscle group you have seds a hard time connecting with, this workout will help.</p>
                            <ul class="likeunlikeBox">
                                <li><a href="#"><i class="icofont">thumbs_up</i>10</a></li>
                                <li><a href="#"><i class="icofont">thumbs_down</i>12</a></li>
                                <li><a href="#"><i class="icofont">reply</i></a></li>
                            </ul>

                            <div class="media mt-5">
                                <a class="pr-4" href="#">
                                    <img src="assets/images/all-img/comments2.jpg" alt="" class="rounded-circle img-thumbnail">
                                </a>
                                <div class="media-body">
                                    <h5 class="mt-0">priya khan <span>25 Nov, 2018 at 10.30 am</span></h5>
                                    <p>f your delts are a weakness, or you find it’s a muscle group you have seds a hard time connecting with, this workout will help</p>
                                    <ul class="likeunlikeBox">
                                        <li><a href="#"><i class="icofont">thumbs_up</i>10</a></li>
                                        <li><a href="#"><i class="icofont">thumbs_down</i>12</a></li>
                                        <li><a href="#"><i class="icofont">reply</i></a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div><!-- end single comments -->
                    <div class="media single-comments mt-5">
                        <a class="mr-4" href="#">
                            <img class=" rounded-circle img-thumbnail" src="assets/images/all-img/comments1.jpg" alt=""></a>
                        <div class="media-body">
                            <h5 class="mt-0">Tonmoy Khan <span>25 Nov, 2018 at 10.30 am</span></h5>
                            <p>If your delts are a weakness, or you find it’s a muscle group you have seds a hard time connecting with, this workout will help.</p>
                            <ul class="likeunlikeBox">
                                <li><a href="#"><i class="icofont">thumbs_up</i>10</a></li>
                                <li><a href="#"><i class="icofont">thumbs_down</i>12</a></li>
                                <li><a href="#"><i class="icofont">reply</i></a></li>
                            </ul>
                        </div>
                    </div><!-- end single comments -->
                    <div class="spacer-extra"></div><!-- end extra spacer -->
                    <form class="site-contactform">
                        <h3 class="section-title xs2">leave a comments</h3>
                        <div class="form-row">
                            <div class="col-md-6">
                                <input type="text" class="form-control" placeholder="Type Your Name">
                            </div>
                            <div class="col-md-6">
                                <input type="email" class="form-control" placeholder="Email">
                            </div>

                            <div class="col-md-12">
                                <textarea class="form-control" placeholder="write your message"></textarea>
                            </div>
                        </div>
                        <div class="text-right">
                            <button type="submit" class="btn-mr th-primary pill">SEND</button>
                        </div>
                    </form>
                </div>
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
                            <img class="mr-3" :src="'/storage/' + new_post.image_path" alt="">
                            <div class="media-body align-self-center">
                                <h5><Link :href="'/blog/' + new_post.slug">A small river named Duden flows</Link></h5>
                                <span><Link :href="'/blog/' + new_post.slug">22 May 2018</Link></span>
                            </div>
                        </div>
                    </div><!-- end single sidebar -->
                </aside>
            </div>
        </div>
    </div>
</div>

</template>