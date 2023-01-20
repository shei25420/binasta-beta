<script setup>
import { ref, onMounted, nextTick } from 'vue';
import ApexCharts from "vue3-apexcharts";

import GenericLayout from '@/Layouts/GenericLayout.vue';

const props = defineProps({
    distributors_meta: Object,
    customers_meta: Object,
    distributor_orders_meta: Array,
    customer_orders_meta: Array,
    products_meta: Object,
    product_options_meta: Object,
    blog_meta: Object
});

const selectedMonth = ref(props.distributor_orders_meta.length ? props.distributor_orders_meta[props.distributor_orders_meta.length - 1].month : 0);
console.log(selectedMonth.value);
console.log(props.distributor_orders_meta);
const salesData = ref([]);
const orderData = ref([]);
const chartXaxis = ref([]);
const series = ref([
    {
        name: "sales",
        data: salesData.value
    },
    {
        name: "orders",
        data: orderData.value
    }
]);

const options = ref({
    chart: {
        height: 350,
        type: 'line',
        foreColor: '#b8b8b8',
        zoom: {
            enabled: false
        },
        toolbar: {
            show: false
        }
    },
    dataLabels: {
        enabled: false
    },
    colors: ["#ff6e40", "#05b171"],
    stroke: {
        width: 4,
        curve: 'smooth',
    },
    legend: {
        show: false
    },
    markers: {
        size: 0,
        hover: {
            sizeOffset: 6
        }
    },
    xaxis: {
        min: chartXaxis.value[chartXaxis.value.length - 1],
        categories: chartXaxis.value
    },
    yaxis: {
        min: 0,
        tickAmount: 1
    },
    tooltip: {
        y: [
            {
                title: {
                    formatter: function (val) {
                        return val
                    }
                }
            },
            {
                title: {
                    formatter: function (val) {
                        return val
                    }
                }
            },
            {
                title: {
                    formatter: function (val) {
                        return val;
                    }
                }
            }
        ]
    },
    grid: {
        borderColor: '#ededed',
    }
});

const customerSelectedMonth = ref(0);
const customersSeries = ref([
    {
        name: 'sales',
        data: []
    },
    {
        name: 'orders',
        data: []
    }
]);

const customerOptions = ref({
    chart: {
        height: 350,
        type: 'line',
        foreColor: '#b8b8b8',
        zoom: {
            enabled: false
        },
        toolbar: {
            show: false
        }
    },
    dataLabels: {
        enabled: false
    },
    colors: ["#ff6e40", "#05b171"],
    stroke: {
        width: 4,
        curve: 'smooth',
    },
    legend: {
        show: false
    },
    markers: {
        size: 0,
        hover: {
            sizeOffset: 6
        }
    },
    xaxis: {
        min: 0,
        categories: []
    },
    yaxis: {
        min: 0,
        tickAmount: 1
    },
    tooltip: {
        y: [
            {
                title: {
                    formatter: function (val) {
                        return val
                    }
                }
            },
            {
                title: {
                    formatter: function (val) {
                        return val
                    }
                }
            },
            {
                title: {
                    formatter: function (val) {
                        return val;
                    }
                }
            }
        ]
    },
    grid: {
        borderColor: '#ededed',
    }
});

const calculateGrowth = (order) => {
    if (order.length) return ["0", ""];

    const percentage = order[1] ? (order[0].total_orders - order[1].total_orders) / 100 : 100;
    return percentage < 0 ? [percentage, "danger"] : [percentage, "success"];

}

onMounted(() => {
    props.distributor_orders_meta.forEach(order => {
        if (selectedMonth.value == order.month) {
            const date = new Date(order.created_at);
            if(!chartXaxis.value.includes(`${date.getDay()} ${date.toLocaleDateString("en-us", { month: "short" })}`)) chartXaxis.value.push(`${date.getDay()} ${date.toLocaleDateString("en-us", { month: "short" })}`);

            salesData.value.push(parseInt(order.total_paid));
            orderData.value.push(parseInt(order.total_orders));
        }
    }); 

    if(props.customer_orders_meta.length) {
        customerSelectedMonth.value = props.customer_orders_meta[props.customer_orders_meta.length - 1].month;
        props.customer_orders_meta.forEach(order => {
            if(customerSelectedMonth.value == order.month) {
                const date = new Date(order.created_at);
                if(!customerOptions.value.xaxis.categories.includes(`${date.getDay()} ${date.toLocaleDateString("en-us", { month: "short" })}`)) customerOptions.value.xaxis.categories.push(`${date.getDay()} ${date.toLocaleDateString("en-us", { month: "short" })}`)
                
                customersSeries.value[0].data.push(parseInt(order.total_paid));
                customersSeries.value[1].data.push(parseInt(order.total_orders));
            }
        });

        customerOptions.value.xaxis.min = customerOptions.value.xaxis.categories[customerOptions.value.xaxis.categories.length - 1];
    }

    nextTick(() => {
        window.dispatchEvent(new Event('resize'));
    });
});
</script>

<template>
    <GenericLayout>
        <div class="content ">
            <div class="row row-cols-1 row-cols-md-3 g-4">
                <div class="col-lg-4 col-md-12">
                    <div class="card h-100">
                        <div class="card-body">
                            <div class="d-flex mb-3">
                                <div class="display-7">
                                    <i class="bi bi-basket"></i>
                                </div>
                                <div class="dropdown ms-auto">
                                    <a href="#" data-bs-toggle="dropdown" class="btn btn-sm" aria-haspopup="true"
                                        aria-expanded="false">
                                        <i class="bi bi-three-dots"></i>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-end">
                                        <a href="#" class="dropdown-item">View Detail</a>
                                        <a href="#" class="dropdown-item">Download</a>
                                    </div>
                                </div>
                            </div>
                            <h4 class="mb-3">Total Distributor Orders</h4>
                            <div class="d-flex mb-3" style="position: relative;">
                                <div class="display-7">{{ distributor_orders_meta.length }}</div>
                            </div>
                            <div class="text-{{ calculateGrowth(distributor_orders_meta)[1] }}">
                                Over last month {{ calculateGrowth(distributor_orders_meta)[0] }}% <i
                                    class="small bi bi-arrow-up"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-12">
                    <div class="card h-100">
                        <div class="card-body">
                            <div class="d-flex mb-3">
                                <div class="display-7">
                                    <i class="bi bi-basket"></i>
                                </div>
                                <div class="dropdown ms-auto">
                                    <a href="#" data-bs-toggle="dropdown" class="btn btn-sm" aria-haspopup="true"
                                        aria-expanded="false">
                                        <i class="bi bi-three-dots"></i>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-end">
                                        <a href="#" class="dropdown-item">View Detail</a>
                                        <a href="#" class="dropdown-item">Download</a>
                                    </div>
                                </div>
                            </div>
                            <h4 class="mb-3">Total Customer Orders</h4>
                            <div class="d-flex mb-3" style="position: relative;">
                                <div class="display-7">{{ customer_orders_meta.length }}</div>
                            </div>
                            <div class="text-{{ calculateGrowth(customer_orders_meta)[1] }}">
                                Over last month {{ calculateGrowth(customer_orders_meta)[0] }}% <i
                                    class="small bi bi-arrow-up"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-12">
                    <div class="card h-100">
                        <div class="card-body">
                            <div class="d-flex mb-3">
                                <div class="display-7">
                                    <i class="bi bi-basket"></i>
                                </div>
                                <div class="dropdown ms-auto">
                                    <a href="#" data-bs-toggle="dropdown" class="btn btn-sm" aria-haspopup="true"
                                        aria-expanded="false">
                                        <i class="bi bi-three-dots"></i>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-end">
                                        <a href="#" class="dropdown-item">View Detail</a>
                                        <a href="#" class="dropdown-item">Download</a>
                                    </div>
                                </div>
                            </div>
                            <h4 class="mb-3">Total Distributors</h4>
                            <div class="d-flex mb-3" style="position: relative;">
                                <div class="display-7">{{ distributors_meta.distributors_count }}</div>
                            </div>
                            <div class="text-success">
                                Over last month 1.4% <i class="small bi bi-arrow-up"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-12">
                    <div class="card widget h-100">
                        <div class="card-header d-flex">
                            <h6 class="card-title">
                                Distributor Sales Chart
                                <a href="#" class="bi bi-question-circle ms-1 small" data-bs-toggle="tooltip" title=""
                                    data-bs-original-title="Daily orders and sales"
                                    aria-label="Daily orders and sales"></a>
                            </h6>
                            <div class="d-flex gap-3 align-items-center ms-auto">
                                <div class="dropdown">
                                    <a href="#" data-bs-toggle="dropdown" class="btn btn-sm" aria-haspopup="true"
                                        aria-expanded="false">
                                        <i class="bi bi-three-dots"></i>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-end">
                                        <a href="#" class="dropdown-item">View Detail</a>
                                        <a href="#" class="dropdown-item">Download</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body" style="position: relative;">
                            <div class="d-md-flex align-items-center mb-3">
                                <div class="d-flex align-items-center">
                                    <div class="display-7 me-3">
                                        <i class="bi bi-bag-check me-2 text-success"></i>Ksh.{{ distributor_orders_meta.length && selectedMonth > 0 ? distributor_orders_meta[selectedMonth].total_amount : 0 }}
                                    </div>
                                </div>
                                <div class="d-flex gap-4 align-items-center ms-auto mt-3 mt-lg-0">
                                    <select class="form-select">
                                        <optgroup label="2020">
                                            <option value="October">October</option>
                                            <option value="November">November</option>
                                            <option value="December">December</option>
                                        </optgroup>
                                        <optgroup label="2021">
                                            <option value="January">January</option>
                                            <option value="February">February</option>
                                            <option value="March">March</option>
                                            <option value="April">April</option>
                                            <option value="May" selected="">May</option>
                                            <option value="June">June</option>
                                            <option value="July">July</option>
                                            <option value="August">August</option>
                                            <option value="September">September</option>
                                            <option value="October">October</option>
                                            <option value="November">November</option>
                                            <option value="December">December</option>
                                        </optgroup>
                                    </select>
                                </div>
                            </div>
                            <div id="sales-chart">
                                <ApexCharts :options="options" :series="series" />
                            </div>
                            <div class="d-flex justify-content-center gap-4 align-items-center ms-auto mt-3 mt-lg-0">
                                <div>
                                    <i class="bi bi-circle-fill mr-2 text-primary me-1 small"></i>
                                    <span>Sales</span>
                                </div>
                                <div>
                                    <i class="bi bi-circle-fill mr-2 text-success me-1 small"></i>
                                    <span>Order</span>
                                </div>
                            </div>
                            <div class="resize-triggers">
                                <div class="expand-trigger">
                                    <div style="width: 869px; height: 496px;"></div>
                                </div>
                                <div class="contract-trigger"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-12">
                    <div class="card widget h-100">
                        <div class="card-header d-flex">
                            <h6 class="card-title">
                                Customer Sales Chart
                                <a href="#" class="bi bi-question-circle ms-1 small" data-bs-toggle="tooltip" title=""
                                    data-bs-original-title="Daily orders and sales"
                                    aria-label="Daily orders and sales"></a>
                            </h6>
                            <div class="d-flex gap-3 align-items-center ms-auto">
                                <div class="dropdown">
                                    <a href="#" data-bs-toggle="dropdown" class="btn btn-sm" aria-haspopup="true"
                                        aria-expanded="false">
                                        <i class="bi bi-three-dots"></i>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-end">
                                        <a href="#" class="dropdown-item">View Detail</a>
                                        <a href="#" class="dropdown-item">Download</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body" style="position: relative;">
                            <div class="d-md-flex align-items-center mb-3">
                                <div class="d-flex align-items-center">
                                    <div class="display-7 me-3">
                                        <i class="bi bi-bag-check me-2 text-success"></i>Ksh.{{ customer_orders_meta.length ? customer_orders_meta[selectedMonth].total_amount : 0 }}
                                    </div>
                                </div>
                                <div class="d-flex gap-4 align-items-center ms-auto mt-3 mt-lg-0">
                                    <select class="form-select">
                                        <optgroup label="2020">
                                            <option value="October">October</option>
                                            <option value="November">November</option>
                                            <option value="December">December</option>
                                        </optgroup>
                                        <optgroup label="2021">
                                            <option value="January">January</option>
                                            <option value="February">February</option>
                                            <option value="March">March</option>
                                            <option value="April">April</option>
                                            <option value="May" selected="">May</option>
                                            <option value="June">June</option>
                                            <option value="July">July</option>
                                            <option value="August">August</option>
                                            <option value="September">September</option>
                                            <option value="October">October</option>
                                            <option value="November">November</option>
                                            <option value="December">December</option>
                                        </optgroup>
                                    </select>
                                </div>
                            </div>
                            <div id="sales-chart">
                                <ApexCharts :options="customerOptions" :series="customersSeries" />
                            </div>
                            <div class="d-flex justify-content-center gap-4 align-items-center ms-auto mt-3 mt-lg-0">
                                <div>
                                    <i class="bi bi-circle-fill mr-2 text-primary me-1 small"></i>
                                    <span>Sales</span>
                                </div>
                                <div>
                                    <i class="bi bi-circle-fill mr-2 text-success me-1 small"></i>
                                    <span>Order</span>
                                </div>
                            </div>
                            <div class="resize-triggers">
                                <div class="expand-trigger">
                                    <div style="width: 869px; height: 496px;"></div>
                                </div>
                                <div class="contract-trigger"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-5 col-md-12">
                    <div class="card widget">
                        <div class="card-header">
                            <h5 class="card-title">Site Overview</h5>
                        </div>
                        <div class="row g-4">
                            <div class="col-md-6">
                                <div class="card border-0">
                                    <div class="card-body text-center">
                                        <div class="display-5">
                                            <i class="bi bi-box text-secondary"></i>
                                        </div>
                                        <h5 class="my-3">Total Products</h5>
                                        <div class="text-muted">{{  products_meta.products_count  }} Product</div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card border-0">
                                    <div class="card-body text-center">
                                        <div class="display-5">
                                            <i class="bi bi-receipt text-warning"></i>
                                        </div>
                                        <h5 class="my-3">Total Sold</h5>
                                        <div class="text-muted">{{  product_options_meta.total_sold  }} Sold</div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card border-0">
                                    <div class="card-body text-center">
                                        <div class="display-5">
                                            <i class="bi bi-eye text-info"></i>
                                        </div>
                                        <h5 class="my-3">Product Views</h5>
                                        <div class="text-muted">{{  products_meta.product_views  }} Views</div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card border-0">
                                    <div class="card-body text-center">
                                        <div class="display-5">
                                            <i class="bi bi-newspaper text-success"></i>
                                        </div>
                                        <h5 class="my-3">Total Blog Posts</h5>
                                        <div class="text-muted">{{  blog_meta.total_blogs  }} Blog Posts</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-7 col-md-12">
                    <div class="card widget">
                        <div class="card-header d-flex align-items-center justify-content-between">
                            <h5 class="card-title">Recent Products</h5>
                            <div class="dropdown ms-auto">
                                <a href="#" data-bs-toggle="dropdown" class="btn btn-sm btn-floating"
                                    aria-haspopup="true" aria-expanded="false">
                                    <i class="bi bi-three-dots"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-end">
                                    <a href="#" class="dropdown-item">Action</a>
                                    <a href="#" class="dropdown-item">Another action</a>
                                    <a href="#" class="dropdown-item">Something else here</a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <p class="text-muted">Products added today. Click <a href="#">here</a> for more details</p>
                            <div class="table-responsive">
                                <table class="table table-custom mb-0" id="recent-products">
                                    <thead>
                                        <tr>
                                            <th>
                                                <input class="form-check-input select-all" type="checkbox"
                                                    data-select-all-target="#recent-products" id="defaultCheck1">
                                            </th>
                                            <th>Photo</th>
                                            <th>Name</th>
                                            <th>Stock</th>
                                            <th>Price</th>
                                            <th class="text-end">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <input class="form-check-input" type="checkbox">
                                            </td>
                                            <td>
                                                <a href="#">
                                                    <img src="#" class="rounded" width="40" alt="...">
                                                </a>
                                            </td>
                                            <td>Cookie</td>
                                            <td>
                                                <span class="text-danger">Out of Stock</span>
                                            </td>
                                            <td>$10,50</td>
                                            <td class="text-end">
                                                <div class="d-flex">
                                                    <div class="dropdown ms-auto">
                                                        <a href="#" data-bs-toggle="dropdown" class="btn btn-floating"
                                                            aria-haspopup="true" aria-expanded="false">
                                                            <i class="bi bi-three-dots"></i>
                                                        </a>
                                                        <div class="dropdown-menu dropdown-menu-end">
                                                            <a href="#" class="dropdown-item">Action</a>
                                                            <a href="#" class="dropdown-item">Another action</a>
                                                            <a href="#" class="dropdown-item">Something else here</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <input class="form-check-input" type="checkbox">
                                            </td>
                                            <td>
                                                <a href="#">
                                                    <img src="#" class="rounded" width="40" alt="...">
                                                </a>
                                            </td>
                                            <td>Glass</td>
                                            <td>
                                                <span class="text-success">In Stock</span>
                                            </td>
                                            <td>$70,20</td>
                                            <td class="text-end">
                                                <div class="d-flex">
                                                    <div class="dropdown ms-auto">
                                                        <a href="#" data-bs-toggle="dropdown" class="btn btn-floating"
                                                            aria-haspopup="true" aria-expanded="false">
                                                            <i class="bi bi-three-dots"></i>
                                                        </a>
                                                        <div class="dropdown-menu dropdown-menu-end">
                                                            <a href="#" class="dropdown-item">Action</a>
                                                            <a href="#" class="dropdown-item">Another action</a>
                                                            <a href="#" class="dropdown-item">Something else here</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <input class="form-check-input" type="checkbox">
                                            </td>
                                            <td>
                                                <a href="#">
                                                    <img src="#" class="rounded" width="40" alt="...">
                                                </a>
                                            </td>
                                            <td>Headphone</td>
                                            <td>
                                                <span class="text-success">In Stock</span>
                                            </td>
                                            <td>$870,50</td>
                                            <td class="text-end">
                                                <div class="d-flex">
                                                    <div class="dropdown ms-auto">
                                                        <a href="#" data-bs-toggle="dropdown" class="btn btn-floating"
                                                            aria-haspopup="true" aria-expanded="false">
                                                            <i class="bi bi-three-dots"></i>
                                                        </a>
                                                        <div class="dropdown-menu dropdown-menu-end">
                                                            <a href="#" class="dropdown-item">Action</a>
                                                            <a href="#" class="dropdown-item">Another action</a>
                                                            <a href="#" class="dropdown-item">Something else here</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <input class="form-check-input" type="checkbox">
                                            </td>
                                            <td>
                                                <a href="#">
                                                    <img src="#" class="rounded" width="40" alt="...">
                                                </a>
                                            </td>
                                            <td>Perfume</td>
                                            <td>
                                                <span class="text-success">In Stock</span>
                                            </td>
                                            <td>$170,50</td>
                                            <td class="text-end">
                                                <div class="d-flex">
                                                    <div class="dropdown ms-auto">
                                                        <a href="#" data-bs-toggle="dropdown" class="btn btn-floating"
                                                            aria-haspopup="true" aria-expanded="false">
                                                            <i class="bi bi-three-dots"></i>
                                                        </a>
                                                        <div class="dropdown-menu dropdown-menu-end">
                                                            <a href="#" class="dropdown-item">Action</a>
                                                            <a href="#" class="dropdown-item">Another action</a>
                                                            <a href="#" class="dropdown-item">Something else here</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </GenericLayout>
</template>