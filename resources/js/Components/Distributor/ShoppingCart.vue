<script setup>
import { Link } from '@inertiajs/inertia-vue3';
import { useStorage } from '@vueuse/core';

const cartItems = useStorage('cart', []);

const removeCart = (itemToRemove) => {
    cartItems.value = cartItems.value.filter(item => parseInt(item.distributor_package.id) !== parseInt(itemToRemove.distributor_package.id));
};

const calculatePackagePrice = (distributor_package) => {
    let totalAmount = 0, normalAmount = 0, discount = distributor_package.discounts.length ? ((100 - distributor_package.discounts[0].percentage) / 100) : 0;
    distributor_package.product_options.forEach(option => {
        normalAmount += parseFloat(option.price) * parseInt(option.min);
        totalAmount += parseFloat(option.price) * parseInt(option.min);
    });
    totalAmount = discount ? discount * totalAmount : totalAmount                                       ;
    return [totalAmount, normalAmount];
};
</script>

<template>
    <li class="nav-item dropdown">
        <a href="#" class="nav-link nav-link-notify" :data-count="cartItems.length" data-bs-toggle="dropdown">
            <i class="bi bi-cart2 icon-lg"></i>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0">
            <h6 class="m-0 px-4 py-3 border-bottom">Shopping Cart</h6>
            <div class="dropdown-menu-body" tabindex="2" style="overflow: hidden; outline: none;">
                <div v-for="item in cartItems" :key="item.id" class="list-group list-group-flush">
                    <div class="list-group-item d-flex align-items-center">
                        <a href="#" @click="removeCart(item)" class="text-danger me-3" title="Remove">
                            <i class="bi bi-trash"></i>
                        </a>
                        <a href="#" class="me-3 flex-shrink-0 ">
                            <img src='/shop/imgs/theme/img_loading.gif' :data-src="`/storage/${item.distributor_package.image_path}`" class="lazy rounded" width="60" alt="...">
                        </a>
                        <div>
                            <h6>{{ item.distributor_package.name }}</h6>
                            <div>{{ item.qty }} x ksh.{{ calculatePackagePrice(item.distributor_package)[0] * item.qty }}</div>
                        </div>
                    </div>
                </div>
            </div> 
            <h6 class="m-0 px-4 py-3 border-top small"><Link href="/checkout" class="btn btn-sm btn-primary">Checkout</Link></h6>
            <div id="ascrail2001" class="nicescroll-rails nicescroll-rails-vr"
                style="width: 8px; z-index: 1000; cursor: default; position: absolute; top: 0px; left: -8px; height: 0px; display: none;">
                <div class="nicescroll-cursors"
                    style="position: relative; top: 0px; float: right; width: 6px; height: 0px; background-color: rgb(66, 66, 66); border: 1px solid rgb(255, 255, 255); background-clip: padding-box; border-radius: 5px;">
                </div>
            </div>
            <div id="ascrail2001-hr" class="nicescroll-rails nicescroll-rails-hr"
                style="height: 8px; z-index: 1000; top: -8px; left: 0px; position: absolute; cursor: default; display: none;">
                <div class="nicescroll-cursors"
                    style="position: absolute; top: 0px; height: 6px; width: 0px; background-color: rgb(66, 66, 66); border: 1px solid rgb(255, 255, 255); background-clip: padding-box; border-radius: 5px;">
                </div>
            </div>
        </div>
    </li>
</template>