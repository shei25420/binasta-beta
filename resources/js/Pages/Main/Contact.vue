<script setup>
import { ref } from 'vue';
import PageBanner from '@/Components/Main/PageBanner.vue';
import MainLayout from '@/Layouts/MainLayout.vue';

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
</script>

<template>
    <MainLayout>
        <PageBanner header="Contact Us" />
        <section class="page-content">
            <div class="container">
                <div class="row">
                    <div class="col-lg-4">
                        <div class="single-contact-innfo d-flex flex-column justify-content-center align-items-center">
                            <div class="boxicon mr-3"><i class="icofont">location_pin</i></div>
                            <h3>Our Location</h3>
                            <p>A26BT5 Building, SilverC Street, London England</p>
                        </div>
                    </div><!-- end single contact info -->

                    <div class="col-lg-4">
                        <div class="single-contact-innfo d-flex flex-column justify-content-center align-items-center">
                            <div class="boxicon mr-3"><i class="icofont">ui_call</i></div>
                            <h3>Call Us Now</h3>
                            <p>+123 65487954 <br>
                                +123 98765426</p>
                        </div>
                    </div><!-- end single contact info -->
                    <div class="col-lg-4">
                        <div class="single-contact-innfo d-flex flex-column justify-content-center align-items-center">
                            <div class="boxicon mr-3"><i class="icofont">ui_message</i></div>
                            <h3>Write Us Now</h3>
                            <p>
                                <a href="mailto:inforations@.com">inforations@.com
                                    Supportrations@.com</a> <br>
                                <a href="mailto:inforations@.com">inforations@.com
                                    Supportrations@.com</a>
                            </p>
                        </div>
                    </div><!-- end single contact info -->
                </div>
                <div class="spacer-extra2"></div><!-- end extra spacer -->
                <div class="row">
                    <div class="col-lg-6">
                        <form @submit.prevent="sendContactMessage" class="site-contactform">
                            <h3 class="section-title xs2">Contact Us</h3>
                            <div class="form-row">
                                <div class="col-12">
                                    <input v-model="contactForm.name" type="text" class="form-control" placeholder="Type Your Name">
                                </div>
                                <div class="col-12">
                                    <input v-model="contactForm.email" type="email" class="form-control" placeholder="Email">
                                </div>
                                <div class="col-12">
                                    <input v-model="contactForm.phone_number" type="text" class="form-control" placeholder="Phone Number (Optional)">
                                </div>
                                <div class="col-12">
                                    <textarea v-model="contactForm.message" class="form-control" placeholder="write your message"></textarea>
                                </div>
                            </div>

                            <button id="submitBtn" type="submit" class="btn-mr th-primary pill">SEND</button>

                        </form>
                        <div v-if="contactMessage" class="alert alert-success alert-dismissible fade show">{{ contactMessage }}</div>
                    </div>
                    <div class="col-lg-6">
                        <div class="promo-add">
                            <img class="lazy" src="../../../assets/shop/imgs/theme/img_loading.gif" data-src="/main/images/all-img/conimg.jpg" alt="">
                            <div class="promo-text">
                                <span>Need Help For Any</span>
                                <h4>Health Information </h4>
                                <h3>+123 6547896</h3>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="spacer-extra2"></div><!-- end spacer -->
                <div class="row">
                    <div class="col-12">
                        <div id="googleMap" style="position: relative; overflow: hidden;">
                            
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </MainLayout>
</template>