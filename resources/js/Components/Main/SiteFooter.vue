<script setup>
import { ref } from 'vue';
import { useForm } from '@inertiajs/inertia-vue3';

const contactMessage = ref("");

const form = ref({
    email: ''
});

const subscribe = () => {
    const btn = document.getElementById("submitBtn");
    btn.innerText = "Submitting....";
    btn.setAttribute("disabled", true);

    fetch('/subscribe', {
        method: 'POST',
        headers: {
            'Accept': 'application/json',
            'Content-Type': 'application/json',
            'X-XSRF-TOKEN': decodeURIComponent(document.cookie.split(";").filter(cookie => cookie.startsWith("XSRF-TOKEN="))[0].split("=")[1])
        },
        body: JSON.stringify({ email: form.email })
    })
    .then(res => res.json())
    .then(data => {
        form.value.email = "";
        btn.innerText = "Submit";
        btn.removeAttribute("disabled");
        contactMessage.value = "Thank you for subscribing to our newsletters.";
    })
    .catch(err => {
        console.log("subscribe err: ", err);
    });
};

</script>

<template>
    <footer class="site-footer">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-4 col-md-6">
                    <div class="single-footer">
                        <a href="#" class="footer-logo"><img src="../../../assets/main/images/logo/flogo.png" alt=""></a>
                        <h3 class="footer-titil">ABOUT RATIONS</h3>
                        <p>Lorem ipsum dolor sit amet,consetetur sadipscing elitr, sed diam nonumy eirmod tempor
                            invidunt ut labore et dolore magna aliquyam erat.
                        </p>
                        <br>
                        <address>
                            CALL NOW FOR SERVICE! <br>
                            <strong>123 4567 89012</strong>
                        </address>

                    </div>
                </div><!-- end single footer -->
                <div class="col-lg-4 col-md-6">
                    <div class="single-footer">
                        <h3 class="footer-titil">RECENT POST</h3>
                        <ul class="post-link">
                            <li><a href="#">5 Simple & Healthy Gluten Free Cookie</a></li>
                            <li><a href="#">How Much do you Really Need in a day?</a></li>
                            <li><a href="#">6 Tip to Make Paleo Eating Easy</a></li>
                            <li><a href="#">How Much do you Really Need in a day?</a></li>
                            <li><a href="#">How Much do you Really Need in a day?</a></li>
                        </ul>
                    </div>
                </div><!-- end single footer -->
                <div class="col-lg-4 col-md-6">
                    <div class="single-footer">
                        <h3 class="footer-titil">NEWS LETTER</h3>
                        <form @submit="subscribe">
                            <div class="input-group">
                                <input v-model="form.email" type="email" class="form-control" placeholder=" enter your email">
                                <div class="input-group-prepend">
                                    <button class="btn" type="button" id="submitBtn">Button</button>
                                </div>
                            </div>
                            <div v-if="contactMessage" class="alert alert-success alert-dismissible fade show">{{ contactMessage }}</div>
                        </form>
                        <ul class="footer-social">
                            <li><a href="#"><i class="icofont">facebook</i></a></li>
                            <li><a href="#"><i class="icofont">twitter</i></a></li>
                            <li><a href="#"><i class="icofont">google_plus</i></a></li>
                            <li><a href="#"><i class="icofont">linkedin</i></a></li>
                        </ul>
                    </div>
                </div><!-- end single footer -->
                <div class="col-12 text-center">
                    <div class="copy-right">
                        <p>2018 &copy; RATIONS, ALL RIGHTS RESERVED</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer-decoration">
            <div class="fbox-1"></div>
            <div class="fbox-2"></div>
        </div><!-- end footer decoration -->
    </footer>
</template>