<script setup>
import { Link } from '@inertiajs/inertia-vue3';    
</script>
    
<template>
    <div class="menu">
    <div class="menu-header">
        <Link href="/" class="menu-header-logo">
            <img src="../../../assets/generic_dashboard/flogo.png" alt="logo">
        </Link>
        <a href="index.html" class="btn btn-sm menu-close-btn">
            <i class="bi bi-x"></i>
        </a>
    </div>
    <div class="menu-body" tabindex="2" style="overflow: scroll; outline: none;">
        <div v-if="$page.component.startsWith('Distributor')" class="dropdown">
            <div href="#" class="d-flex align-items-center" aria-expanded="false">
                <div>
                    <div class="fw-bold mb-1">{{  $page.props.auth.user.first_name  }} {{  $page.props.auth.user.last_name  }}</div>
                    <small class="text-muted mb-1" v-if="!$page.props.auth.user.verified"><b>Visit Site: </b>{{  $page.props.auth.user.domain  }}.binasta.co.ke (verification needed)</small>
                    <small class="text-muted mb-1" v-else><b>Visit Site: </b><a :href="`${$page.props.auth.user.domain}.binasta.co.ke`" target="_blank">{{  $page.props.auth.user.domain  }}.binasta.co.ke</a></small>
                    <br />
                    <span class="badge" :class="$page.props.auth.user.verified == 1 ? 'bg-success' : 'bg-secondary'">{{ $page.props.auth.user.verified == 1 ? `Verfied` : `Unverified` }}</span>
                </div>
            </div>
        </div>
        <ul>
            <li class="menu-divider">Overview</li>
            <li>
                <Link :class="{'active' : $page.url == '/'}" href="/">
                    <span class="nav-link-icon">
                        <i class="bi bi-house"></i>
                    </span>
                    <span>Dashboard</span>
                </Link>
            </li>
            <li v-if="$page.component.startsWith('Admin')">
                <Link :class="{'active' : $page.url == '/countries'}" href="/countries">
                    <span class="nav-link-icon">
                        <i class="bi bi-globe"></i>
                    </span>
                    <span>Countries</span>
                </Link>
            </li>
            <li v-if="$page.component.startsWith('Admin')">
                <Link :class="{'active' : $page.url == '/configurations'}" href="/configurations">
                    <span class="nav-link-icon">
                        <i class="bi bi-gear"></i>
                    </span>
                    <span>Configurations</span>
                </Link>
            </li>
            <li class="menu-divider">Products Section</li>
            <li v-if="$page.component.startsWith('Admin')">
                <Link :class="{'active' : $page.url == '/product_categories'}" href="/product_categories">
                    <span class="nav-link-icon">
                        <i class="bi bi-card-list"></i>
                    </span>
                    <span>Product Categories</span>
                </Link>
            </li>
            <li v-if="$page.component.startsWith('Admin') || $page.component.startsWith('Distributor')">
                <Link :class="{'active' : $page.url == '/products'}" href="/products">
                    <span class="nav-link-icon">
                        <i class="bi bi-box"></i>
                    </span>
                    <span>Products</span>
                </Link>
            </li>
            <li v-if="$page.component.startsWith('Admin') || $page.component.startsWith('Distributor')">
                <Link :class="{'active' : $page.url == '/discounts'}" href="/discounts">
                    <span class="nav-link-icon">
                        <i class="bi bi-percent"></i>
                    </span>
                    <span>Discounts</span>
                </Link>
            </li>
            <li class="menu-divider" v-if="$page.component.startsWith('Admin')">Distributors Section</li>
            <li v-if="$page.component.startsWith('Admin')">
                <Link  :class="{'active' : $page.url == '/distributors'}" href="/distributors">
                    <span class="nav-link-icon">
                        <i class="bi bi-truck"></i>
                    </span>
                    <span>Distributors</span>
                </Link>
            </li>
            <li v-if="$page.component.startsWith('Admin')">
                <Link :class="{'active' : $page.url == '/distributor_packages'}" href="/distributor_packages">
                    <span class="nav-link-icon">
                        <i class="bi bi-diagram-2"></i>
                    </span>
                    <span>Distributor Packages</span>
                </Link>
            </li>
            <li v-if="$page.component.startsWith('Admin')">
                <Link :class="{'active' : $page.url == '/distributor_orders'}" href="/distributor_orders">
                    <span class="nav-link-icon">
                        <i class="bi bi-cart4"></i>
                    </span>
                    <span>Distributor Orders</span>
                </Link>
            </li>
            <li v-if="$page.component.startsWith('Admin')">
                <Link :class="{'active' : $page.url == '/distributor_discounts'}" href="/distributor_discounts">
                    <span class="nav-link-icon">
                        <i class="bi bi-percent"></i>
                    </span>
                    <span>Distributor Discounts</span>
                </Link>
            </li>
            <li v-if="$page.component.startsWith('Admin') || $page.component.startsWith('Distributor')" class="menu-divider">Customers Section</li>
            <li v-if="$page.component.startsWith('Admin') || $page.component.startsWith('Distributor')">
                <Link :class="{'active' : $page.url == '/users'}" href="/users">
                    <span class="nav-link-icon">
                        <i class="bi bi-people"></i>
                    </span>
                    <span>Customers</span>
                </Link>
            </li>
            <li v-if="$page.component.startsWith('Admin') || $page.component.startsWith('Distributor')">
                <Link :class="{'active' : $page.url == '/orders'}" href="/orders">
                    <span class="nav-link-icon">
                        <i class="bi bi-cart4"></i>
                    </span>
                    <span>Customer Orders</span>
                </Link>
            </li>
            <li class="menu-divider" v-if="$page.component.startsWith('Admin')">Blog Section</li>
            <li v-if="$page.component.startsWith('Admin')">
                <Link :class="{'active' : $page.url == '/blog_categories'}" href="/blog_categories">
                    <span class="nav-link-icon">
                        <i class="bi bi-card-list"></i>
                    </span>
                    <span>Blog Categories</span>
                </Link>
            </li>
            <li v-if="$page.component.startsWith('Admin')">
                <Link :class="{'active' : $page.url == '/blogs/create'}" href="/blogs/create">
                    <span class="nav-link-icon">
                        <i class="bi bi-vector-pen"></i>
                    </span>
                    <span>Create Post</span>
                </Link>
            </li>
            <li v-if="$page.component.startsWith('Admin')">
                <Link :class="{'active' : $page.url == '/blogs'}" href="/blogs">
                    <span class="nav-link-icon">
                        <i class="bi bi-newspaper"></i>
                    </span>
                    <span>Blog Posts</span>
                </Link>
            </li>

            <!-- Distributor Only Routes -->
            <li class="menu-divider">Shop Section</li>
            <li v-if="$page.component.startsWith('Distributor')">
                <Link :class="{'active' : $page.url == '/my_orders'}" href="/my_orders">
                    <span class="nav-link-icon">
                        <i class="bi bi-cart4"></i>
                    </span>
                    <span>My Orders</span>
                </Link>
            </li>
            <li v-if="$page.component.startsWith('Distributor')">
                <Link :class="{'active' : $page.url == '/my_invoices'}" href="/my_invoices">
                    <span class="nav-link-icon">
                        <i class="bi bi-cart4"></i>
                    </span>
                    <span>My Invoices</span>
                </Link>
            </li>

            <li>
                <Link href="/logout" method="post" as="button">
                    <span class="nav-link-icon">
                        <i class="bi bi-door-open"></i>
                    </span>
                    <span>Logout</span>
                </Link>
            </li>
        </ul>
    </div>
<div id="ascrail2001" class="nicescroll-rails nicescroll-rails-vr" style="width: 8px; z-index: 998; cursor: default; position: absolute; top: 98px; left: 342px; height: 356px; opacity: 0; display: block;"><div class="nicescroll-cursors" style="position: relative; top: 0px; float: right; width: 6px; height: 397px; background-color: rgb(66, 66, 66); border: 1px solid rgb(255, 255, 255); background-clip: padding-box; border-radius: 5px;"></div></div><div id="ascrail2001-hr" class="nicescroll-rails nicescroll-rails-hr" style="height: 8px; z-index: 998; top: 446px; left: 0px; position: absolute; cursor: default; display: none; width: 342px; opacity: 0;"><div class="nicescroll-cursors" style="position: absolute; top: 0px; height: 6px; width: 350px; background-color: rgb(66, 66, 66); border: 1px solid rgb(255, 255, 255); background-clip: padding-box; border-radius: 5px; left: 0px;"></div></div></div>
</template>
<style scoped>
.menu-body ul li > button {
    background: none;
    display: flex;
    align-items: center;
    padding: 10px 20px;
    color: #000;
    font-size: 15px;
    transition: background .2s,color .2s;
    /* border-radius: 5rem;
    border-right: 4px solid transparent;
    border-left: 4px solid transparent; */
    border: none;
}

.menu-body ul li> button:hover {
    color: #ff6e40;
}

.menu-body ul li> button .nav-link-icon {
    margin-right: 12px;
    font-size: 22px;
    line-height: 18px;
    width: 35px;
    height: 35px;
    transition: transform .2s;
}

.menu-body ul li> button .badge.rounded-circle, .menu-body ul li>a .nav-link-icon {
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 50%;
}
</style>