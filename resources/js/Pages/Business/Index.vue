<script setup>
import { useForm } from '@inertiajs/inertia-vue3';
import { ref } from 'vue';
import BusinessLayout from '@/Layouts/BusinessLayout.vue';

defineProps({
    posts: Array,
    countries: Array
});

const regForm = useForm({
    first_name: "",
    last_name: "",
    email: "",
    phone: "",
    country_id: "",
    domain: "",
    ref: ""
});

const subscriptionForm = ref({
    email: ""
});

const subscribe = () => {
    const btn = document.getElementById("submitBtn");
    btn.innerText = "Subscribing.....";
    btn.setAttribute('disabled', true);
    fetch('/subscribe', {
        method: 'POST',
        headers: {
            'Accept': 'application/json',
            'Content-Type': 'application/json',
            'X-XSRF-TOKEN': decodeURIComponent(document.cookie.split(";").filter(cookie => cookie.startsWith("XSRF-TOKEN"))[0].split("=")[1])
        },
        body: JSON.stringify({email: subscriptionForm.value.email})
    })
    .then(res => res.json())
    .then(data => {
        btn.innerText = "Subscribed";
        // btn.removeAttribute('disabled');
    })
    .catch(err => console.log("subscribe err: ", err));
};

</script>

<template>
    <BusinessLayout>
        <div class="first-screen section-screen-main">
            <div class="section-screen-main__bg"></div>
            <div class="wrapper">
                <div class="screen-main">
                    <div class="section-heading"><span>Guaranteed</span></div>
                    <h1 class="h1 h1-main">Start Your Business Today</h1>
                    <div class="screen-main__text" style="color:white;">Binasta is a nutrition
                        company committed to bringing the goodness of healthy nutrition to the everyday life of your
                        whole family. Our products range from nutritional supplements to sports nutrition to
                        personal care products. </div><a href="https://distributor.binasta.co.ke/auth/register"
                        class="btn btn_learn">Get Started</a>
                </div>
            </div>
        </div>
        <div class="section-services-main" id="services">
            <div class="wrapper">
                <div class="services">
                    <div class="services__item">
                        <div class="services__decor"></div>
                        <div class="services__icon"><img src="../../../assets/business/img/icons-svg/exellence-1.svg"
                                alt="" loading="lazy"></div>
                        <div class="services__title">Start your business and earn Binapoints
                        </div>
                        <div class="services__text">It is easy to start your own business and
                            becoming an affiliate marketer of Binasta nutritional products. Your effort in the
                            business will award you good discounts. You will also earn bina points which are
                            equivalent to loyalty points.</div>
                    </div>
                    <div class="services__item">
                        <div class="services__decor"></div>
                        <div class="services__icon"><img src="../../../assets/business/img/icons-svg/exellence-2.svg"
                                alt="" loading="lazy"></div>
                        <div class="services__title">Stars for you</div>
                        <div class="services__text">Binasta is a nutrition company committed to
                            bringing the goodness of healthy nutrition to the everyday life of your whole family.
                            Our products range from nutritional supplements to sports nutrition to personal care
                            products. Benefit from our affiliate distributors program by starting your own
                            independent business with our market leading products.</div>
                    </div>
                    <div class="services__item">
                        <div class="services__decor"></div>
                        <div class="services__icon"><img src="../../../assets/business/img/icons-svg/exellence-3.svg"
                                alt="" loading="lazy"></div>
                        <div class="services__title">Stars Products</div>
                        <div class="services__text">We aim for the stars. We only deal with the
                            best and nothing less. Our products are guaranteed to provide holistic health and
                            wellbeing. Take a look at our market leading products.</div>
                    </div>
                    <div class="services__item">
                        <div class="services__decor"></div>
                        <div class="services__icon"><img src="../../../assets/business/img/icons-svg/exellence-4.svg"
                                alt="" loading="lazy"></div>
                        <div class="services__title">Get A Free Ecommerce Store</div>
                        <div class="services__text">The internet is the biggest market place in
                            the world. At Binasta you open the doors to your own ecommerce business by getting a
                            free website when you become an affiliate marketer.</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="section-about" id="about">
            <div class="wrapper">
                <div class="about">
                    <div class="about__img">
                        <div class="about__picture"><img alt="" class="js-lazy loaded"
                                src="../../../assets/business/img/way.png" data-was-processed="true"></div>
                    </div>
                    <div class="about__content">
                        <div class="section-heading"><span>the history</span>
                        </div>
                        <div class="h2">Our way to succesful future</div>
                        <div class="section-subtitle">Binasta is an international company
                            bringing together many likeminded business people from many countries in the world.
                        </div>
                        <div class="content-block__text">
                            <p>Your growth is dependent on the people in your team. By leveraging
                                on the power of technology, and the synergy of the Binasta universe, our company
                                will continue to grow and set standards as a market leader. </p>
                        </div><a href="#" class="about__btn play-video js-fancybox"><span class="play-icon"><i
                                    class="icon-play"></i></span>
                            <div class="play-video__text">
                                <div class="play-video__title">about us</div>
                                <div class="play-video__link">Watch our process!</div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="about-details">
                    <div class="about-details__item">
                        <div class="about-details__val">Ksh 35k<span class="about-details__val_plus">+</span></div>
                        <div class="about-details__text">Clients revenue</div>
                        <div class="about-details__decor"></div>
                    </div>
                    <div class="about-details__item">
                        <div class="about-details__val">16k<span class="about-details__val_plus">+</span></div>
                        <div class="about-details__text">Leads for clients</div>
                        <div class="about-details__decor"></div>
                    </div>
                    <div class="about-details__item">
                        <div class="about-details__val">6.7k<span class="about-details__val_plus">+</span></div>
                        <div class="about-details__text">Phone calls</div>
                        <div class="about-details__decor"></div>
                    </div>
                    <div class="about-details__item">
                        <div class="about-details__val">254<span class="about-details__val_plus">+</span></div>
                        <div class="about-details__text">Successful projects</div>
                        <div class="about-details__decor"></div>
                    </div>
                </div>
            </div>
            <div class="about-decor about-decor_1"></div>
            <div class="about-decor about-decor_2"></div>
            <div class="about-decor about-decor_3"></div>
        </div>
        <div class="section-get">
            <div class="wrapper">
                <div class="section-heading h-center"><span>what we do</span>
                </div>
                <div class="h-decor-1">
                    <h2 class="h2 h-center"><span>what you will get with
                            us</span></h2>
                    <div class="section-subtitle h-center">At Binasta we have invested heavily in
                        research and development of our products. This has seen us get great success in meeting our
                        client’s needs. Our goal is to keep our status as a market leader with superior products and
                        an empowered team of affiliate marketers. </div>
                </div>
                <div class="get-list">
                    <div class="get-list__item">
                        <div class="get-list__heading">
                            <div class="get-list__icon"><img src="../../../assets/business/img/icons-svg/get-1.svg"
                                    alt="" loading="lazy">
                            </div>
                            <div class="get-list__title">Low Startup Costs:</div>
                        </div>
                        <div class="get-list__text">Building an ecommerce business requires huge
                            amounts of capital. Building your affiliate marketing business with Binasta gives you
                            the access to all you require to start an online business at very low start up costs.
                            You can then grow your business at your own pace and reap all the benefits of being a
                            business owner.</div>
                    </div>
                    <div class="get-list__item">
                        <div class="get-list__heading">
                            <div class="get-list__icon"><img src="../../../assets/business/img/icons-svg/get-2.svg"
                                    alt="" loading="lazy">
                            </div>
                            <div class="get-list__title">Money-Back Guarantee:</div>
                        </div>
                        <div class="get-list__text">At Binasta we ensure that our products meet
                            the world standards of good manufacturing practices. In a case where the products do not
                            meet the expectations of the client we provide a full refund of the products retail
                            cost.</div>
                    </div>
                    <div class="get-list__item">
                        <div class="get-list__heading">
                            <div class="get-list__icon"><img src="../../../assets/business/img/icons-svg/get-3.svg"
                                    alt="" loading="lazy">
                            </div>
                            <div class="get-list__title">Full Business Transparency</div>
                        </div>
                        <div class="get-list__text">When you join Binasta as an affiliate
                            marketer, we take you through the process of setting up your business. We also provide
                            you with all necessary information on the nature of our products. We believe in the
                            slogan “knowledge is power” so we urge our affiliate marketers to access our free online
                            trainings.</div>
                    </div>
                    <div class="get-list__item">
                        <div class="get-list__heading">
                            <div class="get-list__icon"><img src="../../../assets/business/img/icons-svg/get-4.svg"
                                    alt="" loading="lazy">
                            </div>
                            <div class="get-list__title">Free Business Analytics</div>
                        </div>
                        <div class="get-list__text">Once you are ready to start your own
                            business, we provide you with a website that is customized to your liking. The website
                            provides you with business analytics so that it is easy to monitor your growth and
                            progress.</div>
                    </div>
                    <div class="get-list__item">
                        <div class="get-list__heading">
                            <div class="get-list__icon"><img src="../../../assets/business/img/icons-svg/get-5.svg"
                                    alt="" loading="lazy">
                            </div>
                            <div class="get-list__title">Free Ecommerce Site</div>
                        </div>
                        <div class="get-list__text">Dolor duis voluptate enim exercitation
                            consequat ex. Voluptate in sunt commodo aute do. Dolor enim dolor labore velit nulla sit
                            exercitation irure esse proid.</div>
                    </div>
                    <div class="get-list__item">
                        <div class="get-list__heading">
                            <div class="get-list__icon"><img src="../../../assets/business/img/icons-svg/get-6.svg"
                                    alt="" loading="lazy">
                            </div>
                            <div class="get-list__title">Quality &amp; valid code</div>
                        </div>
                        <div class="get-list__text">Our products are all certified by the food
                            safety authorities and are manufactured in keeping with good manufacturing practices.
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="section-consultation">
            <div class="section-consultation__bg js-lazy">
            </div>
            <div class="wrapper" style="max-height: 594px;">
                <div class="consultation-form-wrap">
                    <div class="consultation-form">
                        <div class="section-heading"><span>get started</span>
                        </div>
                        <h2 class="h2">Register Now</h2>
                        <div class="content-block__text">
                            <p>Do not wait for one more day, this is the best opportunity for you
                                to start your own business and grow as an affiliate marketer. Binasta affiliate
                                marketing business will offer you the time freedom that you cannot get with formal
                                employment.</p>
                        </div>
                    </div>
                    <div class="consultation-img">
                        <div class="consultation-form__form"
                            style="background-color: white; padding: 20px; border: 2px solid white; border-radius: 15px;">
                            <form>
                                <div class="box-fileds">
                                    <div class="box-filed">
                                        <input type="text" placeholder="First name *">
                                    </div>
                                    <div class="box-filed">
                                        <input type="text" placeholder="Last name *">
                                    </div>
                                    <div class="box-filed">
                                        <input type="tel" placeholder="Phone Number *" im-insert="true">
                                    </div>
                                    <div class="box-filed">
                                        <input type="email" placeholder="Email *">
                                    </div>
                                    <div class="box-filed">
                                        <select name="" id="">
                                            <option value="">Select Gender *</option>
                                            <option value="0">Male</option>
                                            <option value="1">Female</option>
                                        </select>
                                    </div>
                                    <div class="box-filed">
                                        <select name="" id="">
                                            <option value="">Select Country *</option>
                                            <option v-for="country in countries" :key="country.id" :value="country.id">{{ country.name }}</option>
                                        </select>
                                    </div>
                                    <div class="box-filed"><input type="text" placeholder="Prefered Domain Name *">
                                    </div>
                                    <div class="box-filed"><input type="text" placeholder="Referal Code"></div>
                                    <div class="box-filed box-field__accept"><label class="checkbox-element"><input
                                                type="checkbox"><span class="checkbox-text">I
                                                accept the <a href="#" target="_blank">Terms and
                                                    Conditions.</a></span></label></div>
                                    <div class="box-filed box-filed_btn"><input type="submit" class="btn"
                                            value="Submit">
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="section-logos">
            <div class="wrapper">
                <div class="logos"><a href="#" target="_blank" class="logos__item">
                        <img alt="" class="js-lazy" src="../../../assets/business/img/examples/logo-1.svg"></a><a
                        href="#" target="_blank" class="logos__item"><img alt="" class="js-lazy"
                            src="../../../assets/business/img/examples/logo-2.svg"></a><a href="#" target="_blank"
                        class="logos__item"><img alt="" class="js-lazy"
                            src="../../../assets/business/img/examples/logo-3.svg"></a><a href="#" target="_blank"
                        class="logos__item"><img alt="" class="js-lazy"
                            src="../../../assets/business/img/examples/logo-4.svg"></a><a href="#" target="_blank"
                        class="logos__item"><img alt="" class="js-lazy"
                            src="../../../assets/business/img/examples/logo-5.svg"></a></div>
            </div>
        </div>
        <div class="section-newsletter">
            <div class="section-newsletter__bg js-lazy">
            </div>
            <div class="wrapper">
                <div class="newsletter">
                    <div class="newsletter__content">
                        <h3 class="h3">Newsletter</h3>
                        <div class="newsletter__text">
                            <p>Stay updated with our regular newsletter. Be sure to get all the
                                updates. Subscribe to our newsletter and get frequent updates straight in your
                                email.</p>
                        </div>
                        <form @submit.prevent="subscribe">
                            <div class="box-fileds-newsletter">
                                <div class="box-filed box-filed_1">
                                    <input v-model="subscriptionForm.email" type="email" placeholder="Enter your email">
                                </div>
                                <div class="box-filed box-filed_submit">
                                    <input type="submit" id="submitBtn" class="btn" value="Subscribe">
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="newsletter__img">
                        <div class="newsletter__picture"><img data-src="../../../assets/business/img/newsletter.svg"
                                alt="" class="js-lazy" src="data:image/gif;base64,R0lGODlhAQABAAAAACw="></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="section-testimonials" id="testimonials">
            <div class="wrapper">
                <div class="testimonials">
                    <div class="testimonials__img">
                        <div class="testimonials__picture"><img data-src="../../../assets/business/img/testimonials.png"
                                alt="" class="js-lazy" src="../../../assets/business/img/testimonials.png"></div>
                    </div>
                    <div class="testimonials__content">
                        <div class="section-heading"><span>they say</span>
                        </div>
                        <div class="h2">Testimonials</div>
                        <div
                            class="swiper-container reviews-slider js-slider-1 swiper-fade swiper-initialized swiper-horizontal swiper-pointer-events">
                            <div class="swiper-wrapper" id="swiper-wrapper-91f722a5d8a31a45" aria-live="off"
                                style="transition-duration: 0ms;">
                                <div class="swiper-slide testimonials-card swiper-slide-prev"
                                    style="width: 410px; opacity: 1; transform: translate3d(0px, 0px, 0px); transition-duration: 0ms;"
                                    role="group" aria-label="1 / 2">
                                    <div class="testimonials-card__text">
                                        <p>“Binasta products are God sent for me and my family.
                                            We discovered the joy of life that comes with good health. ”</p>
                                    </div>
                                    <div class="author"><img class="author__img js-lazy"
                                            data-src="../../../assets/business/img/examples/avatar_1.jpg"
                                            src="data:image/gif;base64,R0lGODlhAQABAAAAACw=" alt="">
                                        <div class="author__details">
                                            <div class="author__title">Molly Nahia</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="swiper-slide testimonials-card swiper-slide-visible swiper-slide-active"
                                    style="width: 410px; opacity: 1; transform: translate3d(-410px, 0px, 0px); transition-duration: 0ms;"
                                    role="group" aria-label="2 / 2">
                                    <div class="testimonials-card__text">
                                        <p>“I was broke and needed a side hustle, my pension was
                                            nowhere near enough for my big family. With binasta affiliate marketing,
                                            I've been able to live a comfortable life where money problems are no
                                            longer an issue.”</p>
                                    </div>
                                    <div class="author"><img class="author__img js-lazy"
                                            data-src="../../../assets/business/img/examples/avatar_1.jpg"
                                            src="data:image/gif;base64,R0lGODlhAQABAAAAACw=" alt="">
                                        <div class="author__details">
                                            <div class="author__title">Abdulaziz Hassan</div>
                                        </div>
                                    </div>
                                </div>
                            </div><span class="swiper-notification" aria-live="assertive" aria-atomic="true"></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="section-main-blog" id="blog">
            <div class="wrapper">
                <div class="section-heading h-center"><span>news</span></div>
                <h2 class="h2 h-center">read our blog</h2>
                <div class="section-subtitle h-center">Dolor duis voluptate enim exercitation
                    consequat ex. </div>
                <div class="blog-more"><a href="blog.html" class="btn">view
                        all</a></div>
                <div class="news">
                    <div v-for="post in posts" :key="post.slug" class="news__item">
                        <a href="article.html" class="news__img">
                            <img alt="" class="js-lazy" :src="'/storage/' + post.image_path"></a>
                        <div class="news__content">
                            <div class="news-header">
                                <div class="news__date">{{ new Date(post.created_at).toDateString() }}</div>
                                <div class="news__author">
                                    <img alt="" class="js-lazy" :src="'/storage/' + post.image_path"><span
                                        class="news__author-title">Annette Black</span></div>
                                        <a href="blog.html" class="news__category">{{ post.blog_category.name }}</a>
                            </div>
                            <div class="news__title">
                                <a href="article.html">
                                    {{ post.title }}
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </BusinessLayout>
</template>

<style scoped>
.section-screen-main__bg {
    background-image: url('../../../assets/business/img/main.jpg')
}

.section-consultation__bg {
    background-image: url("../../../assets/business/img/bg/bg-2.svg");
}

.section-newsletter__bg {
    background-image: url('../../../assets/business/img/bg/bg-3.svg');
}

select {
    background: transparent;
    border: 1px solid #dbdff3;
    border-radius: 5rem;
    color: #646a89;
    font-family: Lato, arial, sans-serif;
    font-size: 1.4rem;
    font-weight: 400;
    height: 6rem;
    padding-left: 2.4rem;
    padding-right: 2.4rem;
    transition: border .3s ease-in;
    width: 100%
}
</style>