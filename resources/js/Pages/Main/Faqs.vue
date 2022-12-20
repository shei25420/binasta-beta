<script setup>
import PageBanner from '@/Components/Main/PageBanner.vue';
import MainLayout from '@/Layouts/MainLayout.vue';


</script>

<template>
    <MainLayout>
        <PageBanner header="FAQs" />
        <div class="page-content">
            <div class="container">
                <div class="spacer-extra"></div><!-- end extra space -->
                <div class="row">
                    <div class="col-12">
                        <h3>Frequently Asked Questions</h3>
                        <div id="accordion">
                            <div class="card">
                                <div class="card-header card-primary" id="headingOne">
                                    <h5 class="mb-0"><button class="btn btn-link" data-toggle="collapse"
                                            data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                            How long will I spend per day running my business? </button></h5>
                                </div>
                                <div id="collapseOne" class="collapse show" aria-labelledby="headingOne"
                                    data-parent="#accordion">
                                    <div class="card-body"> As you embark on the journey to building your business and
                                        changing your life, you are encouraged to set your on targets on what you want
                                        to achieve and within a defined time frame. <br> You can decide to put in extra
                                        hours depending on your targets.so whether you want to put in more than 40 hours
                                        per week or less or more, it will all be determined by what you aim to achieve.
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header card-primary" id="headingTwo">
                                    <h5 class="mb-0"><button class="btn btn-link collapsed" data-toggle="collapse"
                                            data-target="#collapseTwo" aria-expanded="false"
                                            aria-controls="collapseTwo"> How much will I earn from my business?
                                        </button></h5>
                                </div>
                                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo"
                                    data-parent="#accordion">
                                    <div class="card-body"> Your earnings at any given time will always be dependent on
                                        how your set your targets and if you achieve them. You can always come up with a
                                        revenue projection statement and work hard to achieve it. <br> You can always
                                        device new way of hitting your targets and expanding your income through your
                                        own innovation. </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header card-primary" id="headingThree">
                                    <h5 class="mb-0"><button class="btn btn-link collapsed" data-toggle="collapse"
                                            data-target="#collapseThree" aria-expanded="false"
                                            aria-controls="collapseThree"> How do I benefit from being a member of the
                                            Binasta community? </button></h5>
                                </div>
                                <div id="collapseThree" class="collapse" aria-labelledby="headingThree"
                                    data-parent="#accordion">
                                    <div class="card-body"> The main benefit of your membership is in being in a team of
                                        high achievers. <br> You enjoy the synergy of working in a group with a common
                                        goal of creating wealth. You also get to benefit from the companies business
                                        incubation strategy of supporting each member individually with their unique
                                        business needs. <br> You are able to flexibly plan your schedules without the
                                        stress and pressure that come from formal employment. <br> You gain a lot of
                                        self-improvement skills and business skills during our free trainings, seminars
                                        and extravaganzas. <br> The company rewards you for being innovative and
                                        proactive in growing and expanding your business. </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="spacer-extra"></div><!-- end extra space -->
                <div class="row">
                    <div class="col-md-4">
                        <h3>Our Vision</h3>
                        <p>leveraging on team work to achieve success with a smile.</p>
                    </div>
                    <div class="col-md-4">
                        <h3>Our Mission</h3>
                        <p>Changing people’s lives by providing nature’s best health and dietary products.</p>
                    </div>
                    <div class="col-md-4">
                        <h3>Our Vision</h3>
                        <p>We uphold high integrity, honesty and ethical conduct.</p>
                    </div>
                </div>
                <div class="spacer-extra"></div>
            </div>
        </div>
    </MainLayout>
</template>