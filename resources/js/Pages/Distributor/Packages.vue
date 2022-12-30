<script setup>
import { Link } from '@inertiajs/inertia-vue3';
import GenericLayout from '@/Layouts/GenericLayout.vue';

defineProps({
    packages: Array
});

const calculatePackagePrice = (distributorPackage) => {
    let totalAmount = 0, normalAmount = 0, discount =  distributorPackage.discounts.length ? ((100 - distributorPackage.discounts[0].percentage) / 100) : 0;
    distributorPackage.product_options.forEach(option => {
        normalAmount += parseFloat(option.price) * parseInt(option.min);
        totalAmount += parseFloat(option.price) * parseInt(option.min);
        console.log(normalAmount);
    });
    totalAmount = discount ? discount * totalAmount : totalAmount;
    return [totalAmount, normalAmount];
};

</script>

<template>
    <GenericLayout>
        <div class="content ">
        
        <div class="mb-4">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="#">
                            <i class="bi bi-globe2 small me-2"></i> Dashboard
                        </a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Products</li>
                </ol>
            </nav>
        </div>
    
        <div class="row">
            <div class="col-md-8">
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="d-md-flex gap-4 align-items-center">
                            <div class="d-none d-md-flex">All Products</div>
                        </div>
                    </div>
                </div>
                <div class="row g-4">
                    <div v-for="d_package in packages" :key="d_package.id" class="col-lg-4 col-md-6 col-sm-12">
                        <div class="card card-hover">
                            <Link :href="'/distributor_packages/' + d_package.slug">
                                <img :src="'/storage/' + d_package.product_options[0].product.images[0].url" class="card-img-top" :alt="d_package.name">
                            </Link>
                            <div class="card-body">
                                <Link :href="'/distributor_packages/' + d_package.slug">
                                    <h5 class="card-title mb-3">{{ d_package.name  }}</h5>
                                </Link>
                                <div class="d-flex gap-3 mb-3 align-items-center">
                                    <del v-if="d_package.discounts.length" class="text-muted">ksh.{{ calculatePackagePrice(d_package)[1] }}</del>
                                    <h4 class="mb-0">ksh.{{ calculatePackagePrice(d_package)[0] }}</h4>
                                </div>
                                <div class="d-flex">
                                    <Link :href="'/distributor_packages/' + d_package.slug" class="btn btn-primary">View</Link>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <nav class="mt-5" aria-label="Page navigation example">
                    <ul class="pagination justify-content-center">
                        <li class="page-item">
                            <a class="page-link" href="#" aria-label="Previous">
                                <span aria-hidden="true">«</span>
                            </a>
                        </li>
                        <li class="page-item active"><a class="page-link" href="#">1</a></li>
                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                        <li class="page-item">
                            <a class="page-link" href="#" aria-label="Next">
                                <span aria-hidden="true">»</span>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
            <div class="col-md-4">
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center" data-bs-toggle="collapse" aria-expanded="true" data-bs-target="#categoriesCollapseExample" role="button">
                            <div>Categories</div>
                            <div class="bi bi-chevron-down"></div>
                        </div>
                        <div class="collapse show mt-4" id="categoriesCollapseExample">
                            <div class="d-flex flex-column gap-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="categoryCheck1">
                                    <label class="form-check-label" for="categoryCheck1">
                                        All
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="categoryCheck2">
                                    <label class="form-check-label" for="categoryCheck2">
                                        Accessories
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="categoryCheck3">
                                    <label class="form-check-label" for="categoryCheck3">
                                        Phone
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="categoryCheck4">
                                    <label class="form-check-label" for="categoryCheck4">
                                        Headphone
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="categoryCheck5">
                                    <label class="form-check-label" for="categoryCheck5">
                                        Camera
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    
        </div>
    </GenericLayout>
</template>

<style>

</style>