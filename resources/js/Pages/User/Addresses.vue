<script setup>
import GenericLayout from '@/Layouts/GenericLayout.vue';

const props = defineProps('locations');
</script>
    
<template>
    <GenericLayout>
        <div class="buyer-profile-cover bg-image mb-4" style="background: url(&quot;../../assets/images/profile-bg.jpg&quot;);">
        <div class="container d-flex align-items-center justify-content-center h-100 flex-column flex-md-row text-center text-md-start">
            <div class="my-4 my-md-0">
                <a href="settings.html" class="btn btn-primary btn-lg btn-icon">
                    <i class="bi bi-pencil small"></i> Add Address
                </a>
            </div>
        </div>
    </div>
        <div class="row g-4 mb-4">
            <div v-for="location in props.locations" :key="location.id" class="col-md-6 col-sm-12">
                <div class="card">
                    <div class="card-body d-flex flex-column gap-3">
                        <div class="d-flex justify-content-between align-items-center">
                            <h5 class="mb-0">Home</h5>
                            <a href="#">Edit</a>
                        </div>
                        <div>{{ location.name }}</div>
                        <div>
                            <i class="bi bi-telephone me-2"></i> {{ location.phone_number }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </GenericLayout>
</template>
<style>

</style>