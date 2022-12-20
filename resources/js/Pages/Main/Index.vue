<script setup>
import { ref } from 'vue';
import { onMounted } from 'vue';
import { Link } from '@inertiajs/inertia-vue3';
import imagesLoaded from 'imagesloaded';
import isotope from 'isotope-layout';

import MainLayout from '@/Layouts/MainLayout.vue';

defineProps({
    posts: Array
});

const contactForm = ref({
    name: "",
    email: "",
    phone_number: "",
    message: ""
});

const contactMessage = ref("");

const sendContactMessage = () => {
    const btn = document.getElementById("submitBtn");
    btn.innerText = "Submitting....";
    btn.setAttribute("disabled", true);

    fetch('/contact', {
        method: 'POST',
        headers: {
            'Accept': 'application/json',
            'Content-Type': 'application/json',
            'X-XSRF-TOKEN': decodeURIComponent(document.cookie.split(";").filter(cookie => cookie.startsWith("XSRF-TOKEN="))[0].split("=")[1])
        },
        body: JSON.stringify({...contactForm.value})
    })
    .then(res => res.json())
    .then(data => {
        btn.innerText = "send";
        btn.removeAttribute("disabled");
        contactForm.value = {
            name: "",
            email: "",
            phone_number: "",
            message: ""
        };

        contactMessage.value = "Message sent successfully. You will receive an email in the 24-48 hrs";
    })
    .catch(err => console.log("send contact err"));
};

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
        <!--
Site Slider Area
 -->
        <section class="site-slider bg-1">
            <div class="text-slide-active">
                <div class="single-slide">
                    <div class="container">
                        <div class="row bn_height align-items-center">
                            <div class="col-lg-7">
                                <div class="slide-content">
                                    <h1>It is time to balance your life & <span>Nourish your Soul!</span></h1>
                                    <p>Lorem ipsum dolor sit amet Lorem ipsum dolor sit amet, no sea takimata sanctus
                                        est
                                        Lorem ipsum dolor sit amet no sea takimata sanctus.
                                    </p>
                                    <a href="#" class="btn-mr th-gradient pill">Read More</a>
                                    <a href="#" class="btn-mr th-gradient2 pill">Contacts Us</a>
                                </div><!-- end slider content -->
                            </div>
                        </div>
                    </div>
                </div><!-- end single slider -->
            </div>
        </section>

        <!-- health guide section -->

        <section class="health-guide">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 offset-lg-2 section-wrapper text-center">
                        <h3 class="section-title">Start Your Own Business</h3>
                        <p>Start making extra money today! Begin with a simple registration process, and build and grow
                            your business at your own pace. We will be with you every step of the way, providing
                            extraordinary support and quality products.</p><a href="business.binasta.test"
                            class="btn-mr th-gradient pill">Get Started</a>
                    </div><!-- end section titile -->
                </div>
                <div class="row grid">
                    <div class="col-lg-4 col-md-6 text-center grid-item">
                        <div class="single-health-block d-flex flex-column align-items-center justify-content-center">
                            <div class="icon-box"><i class="icofont">money-bag</i></div>
                            <h4>Low Startup Costs</h4>
                            <p>Getting access to amazing products and resources to build and manage a full fledged
                                enterprise has never been simpler!</p>
                        </div>
                    </div><!-- end single health blog -->
                    <div class="col-lg-4 col-md-6 grid-item">
                        <div class="single-health-block-big text-center"><img src="assets/images/all-img/health_add.png"
                                alt=""></div>
                    </div><!-- end single health blog -->
                    <div class="col-lg-4 col-md-6 text-center grid-item">
                        <div class="single-health-block d-flex flex-column align-items-center justify-content-center">
                            <div class="icon-box"><i class="icofont">eye</i></div>
                            <h4>Full Transparency</h4>
                            <p>We are committed to openness and straightforwardness through our binapoints system,
                                allowing for a very fair and rewarding system!</p>
                        </div>
                    </div><!-- end single health blog -->
                    <div class="col-lg-4 col-md-6 text-center grid-item">
                        <div class="single-health-block d-flex flex-column align-items-center justify-content-center">
                            <div class="icon-box"><i class="icofont">live_support</i></div>
                            <h4>24/7 Individual Support</h4>
                            <p>We provide you with the products, information, tools and resources to ensure you are
                                fully equipped to take advantage of this amazing opportunity!</p>
                        </div>
                    </div><!-- end single health blog -->
                    <div class="col-lg-4 col-md-6 text-center grid-item">
                        <div class="single-health-block d-flex flex-column align-items-center justify-content-center">
                            <div class="icon-box"><i class="icofont">sale_discount</i></div>
                            <h4>Amazing Discounts</h4>
                            <p>Discover unbelievable discounts with Binasta! We take care of our partners by giving the
                                most competitive prices in the market.</p>
                        </div>
                    </div><!-- end single health blog -->
                    <div class="col-lg-4 col-md-6 text-center grid-item">
                        <div class="single-health-block d-flex flex-column align-items-center justify-content-center">
                            <div class="icon-box"><i class="icofont">chart_bar_graph</i></div>
                            <h4>Track your Progress</h4>
                            <p>Track your Progress: Our Platform offers powerful reports on an informative and intuitive
                                dashboard to give you real time and insightful data to keep track of your business.</p>
                        </div>
                    </div><!-- end single health blog -->
                </div>
            </div>
        </section>

        <!-- Appoinment
Section start
-->
        <section class="appoinment-area">
            <div class="container-fluid custom2">
                <div class="row">
                    <div class="col-lg-7 offset-lg-5 appoinment-box col-md-12">
                        <div class="section-wrapper animation animated fadeInUp" data-animation="fadeInUp"
                            data-animation-delay="0.1s" style="animation-delay: 0.1s; visibility: visible;">
                            <h3 class="section-title">Any Questions??</h3>
                            <p>Message / Queries will be replied to your email in 24hrs</p>
                        </div>
                        <div class="appoinmentshpae-1">
                            <div class="innershape"></div>
                        </div><!-- shape1 -->
                        <form @submit.prevent="sendContactMessage" class="frmdesign-1">
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <div class="input-group animation animated fadeInUp" data-animation="fadeInUp"
                                        data-animation-delay="0.2s" style="animation-delay: 0.2s; visibility: visible;">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text"><i class="icofont">man_in_glasses</i></div>
                                        </div>
                                        <input type="text" class="form-control" v-model="contactForm.name" placeholder="name">
                                    </div>
                                </div>
                                <div class="form-group col-md-6 animation animated fadeInUp" data-animation="fadeInUp"
                                    data-animation-delay="0.3s" style="animation-delay: 0.3s; visibility: visible;">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text"><i class="icofont">email</i></div>
                                        </div><input v-model="contactForm.email" type="email" class="form-control" placeholder="email">
                                    </div>
                                </div>
                                <div class="form-group col-md-12">
                                    <div class="input-group animation animated fadeInUp" data-animation="fadeInUp"
                                        data-animation-delay="0.2s" style="animation-delay: 0.2s; visibility: visible;">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text"><i class="icofont">stock_mobile</i></div>
                                        </div><input v-model="contactForm.phone_number" type="tel" class="form-control" placeholder="phone (optional)">
                                    </div>
                                </div>
                                <div class="form-group col-md-12 animation animated fadeInUp" data-animation="fadeInUp"
                                    data-animation-delay="0.5s" style="animation-delay: 0.5s; visibility: visible;">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text"><i class="icofont">ui_message</i></div>
                                        </div><textarea v-model="contactForm.message" class="form-control" placeholder="message"></textarea>
                                    </div>
                                </div>
                            </div><button id="submitBtn" type="submit" class="animation animated fadeInUp" data-animation="fadeInUp"
                                data-animation-delay="0.6s"
                                style="animation-delay: 0.6s; visibility: visible;">Submit</button>
                            <div class="appoinmentshpae-2">
                                <div class="innershape"></div>
                            </div><!-- shape2 -->
                        </form>
                        <div v-if="contactMessage" class="alert alert-success alert-dismissible fade show">{{ contactMessage }}</div>
                    </div><!-- end how its works  -->
                </div>
            </div>
            <div class="videobgplay bg_1"></div>
        </section>


        <!--
 Blog section Start
 -->

        <section class="blog-area">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 offset-lg-2 section-wrapper text-center">
                        <h3 class="section-title">News Articles & Tips</h3>
                        <p>Lorem ipsum dolor sit amet,sed diam voluptua. sed diam nonumy eirmod tempor invidunt ut
                            labore et
                            dolore magna aliquyam erat, consetetur sadipscing elitr, Stet clita kasd gubergren</p>
                    </div><!-- end section titile -->
                </div>
                <div class="row grid">
                    <div v-for="post in posts" :key="post.slug" class="col-md-6 grid-item animation" data-animation="fadeInUp" data-animation-delay="0.1s">
                        <div class="single-blog">
                            <div class="blog-thumb">
                                <img :src="'/storage/' + post.image_path" alt="">
                            </div><!-- end blog thumb -->
                            <div class="blog-text">
                                <ul class="post-meta d-flex justify-content-between">
                                    <li><a href="#"><i class="icofont">ui_calendar</i>{{ new Date(post.created_at).toDateString() }}</a></li>
                                    <li><a href="#"><i class="icofont">user_alt_4</i> Tonmoy Khan</a></li>
                                </ul>
                                <h4><Link :href="'/blog/' + post.slug">{{ post.title }}</Link></h4>
                                <p>{{ post.description }} [...]</p>
                                <Link :href="'/blog/' + post.slug" class="blog-link">Reads More</Link>
                            </div>
                        </div>
                    </div><!-- end single blog -->
                </div>
            </div>
        </section>

        <!--
 call to action start
 -->

        <section class="call-to-action">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-md-7 text-center text-md-left">
                        <h3>The fastest way to loss weight in natural way!</h3>
                        <p>Lorem ipsum dolor sit amet, Lorem ipsum dolor sit amet accusam</p>
                    </div>
                    <div class="col-md-5 text-md-right text-center">
                        <a href="#">GET A FREE CONSULTATION!</a>
                    </div>
                </div>
            </div>
        </section>

        <!--
 Promotion Area Start
 -->

        <section class="promotion-area">
            <div class="appoinmentshpae-1">
                <div class="innershape"></div>
            </div><!-- shape2 -->
            <div class="appoinmentshpae-2">
                <div class="innershape"></div>
            </div><!-- shape2 -->
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-6 section-wrapper no-margin text-md-center">
                        <h3 class="section-title">Over 20 Years of <br>
                            Experience</h3>
                        <p>Lorem ipsum dolor sit amet sed diam voluptua. sed diam nonumy eirmod tempor invidunt ut
                            labore et
                            dolore .</p>
                    </div>
                    <div class="col-lg-6">
                        <div class="row">
                            <div class="col-sm-6 animation" data-animation="fadeInDown" data-animation-delay="0.1s">
                                <div class="media single-cosunter-block">
                                    <img class="mr-3" src="../../../assets/main/images/all-img/counter_icon1.png"
                                        alt="">
                                    <div class="media-body">
                                        <h5 class="mt-0 counter"><strong>5000</strong></h5>
                                        <p>Workout Sessions</p>
                                    </div>
                                </div>
                            </div><!-- end single -->
                            <div class="col-sm-6 animation" data-animation="fadeInDown" data-animation-delay="0.1s">
                                <div class="media single-cosunter-block">
                                    <img class="mr-3" src="../../../assets/main/images/all-img/counter_icon2.png"
                                        alt="">
                                    <div class="media-body">
                                        <h5 class="mt-0 counter"><strong>1200</strong></h5>
                                        <p>Happy Customers</p>
                                    </div>
                                </div>
                            </div><!-- end single -->
                            <div class="col-sm-6 animation" data-animation="fadeInUp" data-animation-delay="0.1s">
                                <div class="media single-cosunter-block">
                                    <img class="mr-3" src="../../../assets/main/images/all-img/counter_icon3.png"
                                        alt="">
                                    <div class="media-body">
                                        <h5 class="mt-0 counter"><strong>3200</strong></h5>
                                        <p>Fat loss diet</p>
                                    </div>
                                </div>
                            </div><!-- end single -->
                            <div class="col-sm-6 animation" data-animation="fadeInUp" data-animation-delay="0.1s">
                                <div class="media single-cosunter-block">
                                    <img class="mr-3" src="../../../assets/main/images/all-img/counter_icon4.png"
                                        alt="">
                                    <div class="media-body">
                                        <h5 class="mt-0 counter"><strong>4520</strong></h5>
                                        <p>Days Of Program</p>
                                    </div>
                                </div>
                            </div><!-- end single -->
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!--
 success story
 -->
        <section class="success-story">
            <div class="container">
                <div class="row align-items-center owl-carousel active-story owl-loaded owl-drag">
                    <!-- end single story -->
                    <!-- end single story -->
                    <!-- end single story -->
                    <div class="owl-stage-outer">
                        <div class="owl-stage"
                            style="transform: translate3d(-4440px, 0px, 0px); transition: all 0s ease 0s; width: 7770px;">
                            <div class="owl-item cloned" style="width: 1110px;">
                                <div class="col-12 single_stroy">
                                    <div class="row">
                                        <div class="col-lg-6 col-md-7">
                                            <h3 class="section-title">Story Of Success</h3>
                                            <p><strong>I was broke and needed a side hustle, my pension was nowhere near
                                                    enough for my big family. With binasta affiliate marketing, I've
                                                    been able to live a comfortable life where money problems are no
                                                    longer an issue. </strong></p>
                                            <h4>Abdulaziz Hassan</h4>
                                        </div><!-- end story text -->
                                        <div class="col-lg-6 col-md-5 align-self-md-center">
                                            <div class="strong-man"><img src="assets/images/all-img/man2.jpg" alt="">
                                            </div>
                                        </div><!-- end story images -->
                                    </div>
                                </div>
                            </div>
                            <div class="owl-item cloned" style="width: 1110px;">
                                <div class="col-12 single_stroy">
                                    <div class="row">
                                        <div class="col-lg-6 col-md-7">
                                            <h3 class="section-title">Story Of Success</h3>
                                            <p><strong>I want the best in life. Binasta Products keeps me healthy and
                                                    flawless. Binasta affiliate marketing program keeps my money flowing
                                                    What else would I wish for in life?</strong></p>
                                            <h4>Mary maya</h4>
                                        </div><!-- end story text -->
                                        <div class="col-lg-6 col-md-5 align-self-md-center">
                                            <div class="strong-man"><img src="assets/images/all-img/man3.jpg" alt="">
                                            </div>
                                        </div><!-- end story images -->
                                    </div>
                                </div>
                            </div>
                            <div class="owl-item" style="width: 1110px;">
                                <div class="col-12 single_stroy">
                                    <div class="row">
                                        <div class="col-lg-6 col-md-7">
                                            <h3 class="section-title">Story Of Success</h3>
                                            <p><strong>Binasta products are God sent for me and my family. We discovered
                                                    the joy of life that comes with good health.</strong></p>
                                            <h4>Molly Nahia</h4>
                                        </div><!-- end story text -->
                                        <div class="col-lg-6 col-md-5 align-self-md-center">
                                            <div class="strong-man"><img src="assets/images/all-img/man1.jpg" alt="">
                                            </div>
                                        </div><!-- end story images -->
                                    </div>
                                </div>
                            </div>
                            <div class="owl-item" style="width: 1110px;">
                                <div class="col-12 single_stroy">
                                    <div class="row">
                                        <div class="col-lg-6 col-md-7">
                                            <h3 class="section-title">Story Of Success</h3>
                                            <p><strong>I was broke and needed a side hustle, my pension was nowhere near
                                                    enough for my big family. With binasta affiliate marketing, I've
                                                    been able to live a comfortable life where money problems are no
                                                    longer an issue. </strong></p>
                                            <h4>Abdulaziz Hassan</h4>
                                        </div><!-- end story text -->
                                        <div class="col-lg-6 col-md-5 align-self-md-center">
                                            <div class="strong-man"><img src="assets/images/all-img/man2.jpg" alt="">
                                            </div>
                                        </div><!-- end story images -->
                                    </div>
                                </div>
                            </div>
                            <div class="owl-item active" style="width: 1110px;">
                                <div class="col-12 single_stroy">
                                    <div class="row">
                                        <div class="col-lg-6 col-md-7">
                                            <h3 class="section-title">Story Of Success</h3>
                                            <p><strong>I want the best in life. Binasta Products keeps me healthy and
                                                    flawless. Binasta affiliate marketing program keeps my money flowing
                                                    What else would I wish for in life?</strong></p>
                                            <h4>Mary maya</h4>
                                        </div><!-- end story text -->
                                        <div class="col-lg-6 col-md-5 align-self-md-center">
                                            <div class="strong-man"><img src="assets/images/all-img/man3.jpg" alt="">
                                            </div>
                                        </div><!-- end story images -->
                                    </div>
                                </div>
                            </div>
                            <div class="owl-item cloned" style="width: 1110px;">
                                <div class="col-12 single_stroy">
                                    <div class="row">
                                        <div class="col-lg-6 col-md-7">
                                            <h3 class="section-title">Story Of Success</h3>
                                            <p><strong>Binasta products are God sent for me and my family. We discovered
                                                    the joy of life that comes with good health.</strong></p>
                                            <h4>Molly Nahia</h4>
                                        </div><!-- end story text -->
                                        <div class="col-lg-6 col-md-5 align-self-md-center">
                                            <div class="strong-man"><img src="assets/images/all-img/man1.jpg" alt="">
                                            </div>
                                        </div><!-- end story images -->
                                    </div>
                                </div>
                            </div>
                            <div class="owl-item cloned" style="width: 1110px;">
                                <div class="col-12 single_stroy">
                                    <div class="row">
                                        <div class="col-lg-6 col-md-7">
                                            <h3 class="section-title">Story Of Success</h3>
                                            <p><strong>I was broke and needed a side hustle, my pension was nowhere near
                                                    enough for my big family. With binasta affiliate marketing, I've
                                                    been able to live a comfortable life where money problems are no
                                                    longer an issue. </strong></p>
                                            <h4>Abdulaziz Hassan</h4>
                                        </div><!-- end story text -->
                                        <div class="col-lg-6 col-md-5 align-self-md-center">
                                            <div class="strong-man"><img src="assets/images/all-img/man2.jpg" alt="">
                                            </div>
                                        </div><!-- end story images -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="owl-nav disabled">
                        <div class="owl-prev">prev</div>
                        <div class="owl-next">next</div>
                    </div>
                    <div class="owl-dots">
                        <div class="owl-dot"><span></span></div>
                        <div class="owl-dot"><span></span></div>
                        <div class="owl-dot active"><span></span></div>
                    </div>
                </div>
            </div>
        </section>

        <!--
 Our Patners Start
 -->
        <section class="partners-area">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 offset-lg-2 section-wrapper text-center">
                        <h3 class="section-title">Our Partners</h3>
                        <p>Lorem ipsum dolor sit amet,sed diam voluptua. sed diam nonumy eirmod tempor invidunt ut
                            labore et
                            dolore magna aliquyam erat, consetetur sadipscing elitr, Stet clita kasd gubergren</p>
                    </div><!-- end section titile -->
                    <div class="col-12">
                        <div class="brands-active owl-carousel">
                            <div class="single-brands">
                                <img src="../../../assets/main/images/all-img/brands-1.png" alt="">
                            </div><!-- end single brands -->
                            <div class="single-brands">
                                <img src="../../../assets/main/images/all-img/brands-3.png" alt="">
                            </div><!-- end single brands -->
                            <div class="single-brands">
                                <img src="../../../assets/main/images/all-img/brands-3.png" alt="">
                            </div><!-- end single brands -->
                            <div class="single-brands">
                                <img src="../../../assets/main/images/all-img/brands-4.png" alt="">
                            </div><!-- end single brands -->
                            <div class="single-brands">
                                <img src="../../../assets/main/images/all-img/brands-4.png" alt="">
                            </div><!-- end single brands -->
                            <div class="single-brands">
                                <img src="../../../assets/main/images/all-img/brands-1.png" alt="">
                            </div><!-- end single brands -->
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </MainLayout>
</template>

<style>

</style>