<script setup>
import { Link } from '@inertiajs/inertia-vue3';
import { ref } from 'vue';

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
                        <Link href="/" class="footer-logo"><img src="../../../assets/shop/imgs/theme/flogo.png" style="width:140px !important;" alt=""></Link>
                        <h3 class="footer-titil">Binasta Limited</h3>
                        <p>Binasta is a modern affiliate marketing company that markets and sells nutritional supplements, weight management, personal care products, and health shakes.
                        </p>
                        <br>
                        <address>
                            CALL NOW FOR SERVICE! <br>
                            <strong>254 4567 89012</strong>
                        </address>

                    </div>
                </div><!-- end single footer -->
                <div class="col-lg-4 col-md-6">
                    <div class="single-footer">
                        <h3 class="footer-titil">Quick Links</h3>
                        <ul class="post-link">
                            <li><a href="https://shop.binasta.co.ke">Shop</a></li>
                            <li><a href="https://business.binasta.co.ke">Become A Distributor</a></li>
                            <li><Link href="/terms">Terms &amp; Conditions</Link></li>
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
                        <p>2023 &copy; Binasta Limited, ALL RIGHTS RESERVED</p>
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