<script setup>
import { ref, onMounted, nextTick } from 'vue';
import ApexCharts from "vue3-apexcharts";

import GenericLayout from '@/Layouts/GenericLayout.vue';

const props = defineProps({
    distributors_meta: Object,
    customers_meta: Object,
    distributor_orders_meta: Array,
    customer_orders_meta: Array,
    product_meta: Object,
    product_options_meta: Object
});

const selectedMonth = ref(0);
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
        min: 0
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
    if (props.distributor_orders_meta.length) selectedMonth.value = props.distributor_orders_meta[props.distributor_orders_meta.length - 1].month;
    props.distributor_orders_meta.forEach(order => {
        if (selectedMonth.value == order.month) {
            const date = new Date(order.created_at);
            if(!chartXaxis.value.includes(`${date.getDay()} ${date.toLocaleDateString("en-us", { month: "short" })}`)) chartXaxis.value.push(`${date.getDay()} ${date.toLocaleDateString("en-us", { month: "short" })}`);
            if (order.status) salesData.value.push(parseInt(order.total_orders));
             orderData.value.push(parseInt(order.total_orders));
        }
    });

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
                <div class="col-lg-7 col-md-12">
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
                                        <i class="bi bi-bag-check me-2 text-success"></i>KSH 10.552,40
                                    </div>
                                    <span class="text-success">
                                        <i class="bi bi-arrow-up me-1 small"></i>8.30%
                                    </span>
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
                <div class="col-lg-5 col-md-12">
                    <div class="card widget h-100">
                        <div class="card-header d-flex">
                            <h6 class="card-title">
                                Channels
                                <a href="#" class="bi bi-question-circle ms-1 small" data-bs-toggle="tooltip" title=""
                                    data-bs-original-title="Channels where your products are sold"
                                    aria-label="Channels where your products are sold"></a>
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
                            <div id="sales-channels" style="min-height: 232.8px;">
                                <div id="apexchartszjfdnqz9"
                                    class="apexcharts-canvas apexchartszjfdnqz9 apexcharts-theme-light"
                                    style="width: 565px; height: 232.8px;"><svg id="SvgjsSvg2009" width="565"
                                        height="232.79999999999998" xmlns="http://www.w3.org/2000/svg" version="1.1"
                                        xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.com/svgjs"
                                        class="apexcharts-svg" xmlns:data="ApexChartsNS" transform="translate(0, 0)"
                                        style="background: transparent;">
                                        <g id="SvgjsG2011" class="apexcharts-inner apexcharts-graphical"
                                            transform="translate(170.5, 0)">
                                            <defs id="SvgjsDefs2010">
                                                <clipPath id="gridRectMaskzjfdnqz9">
                                                    <rect id="SvgjsRect2013" width="230" height="248" x="-2" y="0"
                                                        rx="0" ry="0" opacity="1" stroke-width="0" stroke="none"
                                                        stroke-dasharray="0" fill="#fff"></rect>
                                                </clipPath>
                                                <clipPath id="gridRectMarkerMaskzjfdnqz9">
                                                    <rect id="SvgjsRect2014" width="230" height="252" x="-2" y="-2"
                                                        rx="0" ry="0" opacity="1" stroke-width="0" stroke="none"
                                                        stroke-dasharray="0" fill="#fff"></rect>
                                                </clipPath>
                                                <filter id="SvgjsFilter2023" filterUnits="userSpaceOnUse" width="200%"
                                                    height="200%" x="-50%" y="-50%">
                                                    <feFlood id="SvgjsFeFlood2024" flood-color="#000000"
                                                        flood-opacity="0.45" result="SvgjsFeFlood2024Out"
                                                        in="SourceGraphic"></feFlood>
                                                    <feComposite id="SvgjsFeComposite2025" in="SvgjsFeFlood2024Out"
                                                        in2="SourceAlpha" operator="in"
                                                        result="SvgjsFeComposite2025Out"></feComposite>
                                                    <feOffset id="SvgjsFeOffset2026" dx="1" dy="1"
                                                        result="SvgjsFeOffset2026Out" in="SvgjsFeComposite2025Out">
                                                    </feOffset>
                                                    <feGaussianBlur id="SvgjsFeGaussianBlur2027" stdDeviation="1 "
                                                        result="SvgjsFeGaussianBlur2027Out" in="SvgjsFeOffset2026Out">
                                                    </feGaussianBlur>
                                                    <feMerge id="SvgjsFeMerge2028" result="SvgjsFeMerge2028Out"
                                                        in="SourceGraphic">
                                                        <feMergeNode id="SvgjsFeMergeNode2029"
                                                            in="SvgjsFeGaussianBlur2027Out"></feMergeNode>
                                                        <feMergeNode id="SvgjsFeMergeNode2030" in="[object Arguments]">
                                                        </feMergeNode>
                                                    </feMerge>
                                                    <feBlend id="SvgjsFeBlend2031" in="SourceGraphic"
                                                        in2="SvgjsFeMerge2028Out" mode="normal"
                                                        result="SvgjsFeBlend2031Out"></feBlend>
                                                </filter>
                                                <filter id="SvgjsFilter2036" filterUnits="userSpaceOnUse" width="200%"
                                                    height="200%" x="-50%" y="-50%">
                                                    <feFlood id="SvgjsFeFlood2037" flood-color="#000000"
                                                        flood-opacity="0.45" result="SvgjsFeFlood2037Out"
                                                        in="SourceGraphic"></feFlood>
                                                    <feComposite id="SvgjsFeComposite2038" in="SvgjsFeFlood2037Out"
                                                        in2="SourceAlpha" operator="in"
                                                        result="SvgjsFeComposite2038Out"></feComposite>
                                                    <feOffset id="SvgjsFeOffset2039" dx="1" dy="1"
                                                        result="SvgjsFeOffset2039Out" in="SvgjsFeComposite2038Out">
                                                    </feOffset>
                                                    <feGaussianBlur id="SvgjsFeGaussianBlur2040" stdDeviation="1 "
                                                        result="SvgjsFeGaussianBlur2040Out" in="SvgjsFeOffset2039Out">
                                                    </feGaussianBlur>
                                                    <feMerge id="SvgjsFeMerge2041" result="SvgjsFeMerge2041Out"
                                                        in="SourceGraphic">
                                                        <feMergeNode id="SvgjsFeMergeNode2042"
                                                            in="SvgjsFeGaussianBlur2040Out"></feMergeNode>
                                                        <feMergeNode id="SvgjsFeMergeNode2043" in="[object Arguments]">
                                                        </feMergeNode>
                                                    </feMerge>
                                                    <feBlend id="SvgjsFeBlend2044" in="SourceGraphic"
                                                        in2="SvgjsFeMerge2041Out" mode="normal"
                                                        result="SvgjsFeBlend2044Out"></feBlend>
                                                </filter>
                                                <filter id="SvgjsFilter2049" filterUnits="userSpaceOnUse" width="200%"
                                                    height="200%" x="-50%" y="-50%">
                                                    <feFlood id="SvgjsFeFlood2050" flood-color="#000000"
                                                        flood-opacity="0.45" result="SvgjsFeFlood2050Out"
                                                        in="SourceGraphic"></feFlood>
                                                    <feComposite id="SvgjsFeComposite2051" in="SvgjsFeFlood2050Out"
                                                        in2="SourceAlpha" operator="in"
                                                        result="SvgjsFeComposite2051Out"></feComposite>
                                                    <feOffset id="SvgjsFeOffset2052" dx="1" dy="1"
                                                        result="SvgjsFeOffset2052Out" in="SvgjsFeComposite2051Out">
                                                    </feOffset>
                                                    <feGaussianBlur id="SvgjsFeGaussianBlur2053" stdDeviation="1 "
                                                        result="SvgjsFeGaussianBlur2053Out" in="SvgjsFeOffset2052Out">
                                                    </feGaussianBlur>
                                                    <feMerge id="SvgjsFeMerge2054" result="SvgjsFeMerge2054Out"
                                                        in="SourceGraphic">
                                                        <feMergeNode id="SvgjsFeMergeNode2055"
                                                            in="SvgjsFeGaussianBlur2053Out"></feMergeNode>
                                                        <feMergeNode id="SvgjsFeMergeNode2056" in="[object Arguments]">
                                                        </feMergeNode>
                                                    </feMerge>
                                                    <feBlend id="SvgjsFeBlend2057" in="SourceGraphic"
                                                        in2="SvgjsFeMerge2054Out" mode="normal"
                                                        result="SvgjsFeBlend2057Out"></feBlend>
                                                </filter>
                                            </defs>
                                            <g id="SvgjsG2015" class="apexcharts-pie">
                                                <g id="SvgjsG2016" transform="translate(0, 0) scale(1)">
                                                    <circle id="SvgjsCircle2017" r="42.49756097560976" cx="113" cy="113"
                                                        fill="transparent"></circle>
                                                    <g id="SvgjsG2018" class="apexcharts-slices">
                                                        <g id="SvgjsG2019"
                                                            class="apexcharts-series apexcharts-pie-series"
                                                            seriesName="SocialxMedia" rel="1" data:realIndex="0">
                                                            <path id="SvgjsPath2020"
                                                                d="M 113 6.756097560975604 A 106.2439024390244 106.2439024390244 0 0 1 126.31589183917337 218.4061375347772 L 118.32635673566935 155.1624550139109 A 42.49756097560976 42.49756097560976 0 0 0 113 70.50243902439024 L 113 6.756097560975604 z"
                                                                fill="rgba(253,126,20,1)" fill-opacity="1"
                                                                stroke-opacity="1" stroke-linecap="butt"
                                                                stroke-width="0" stroke-dasharray="0"
                                                                class="apexcharts-pie-area apexcharts-donut-slice-0"
                                                                index="0" j="0" data:angle="172.8" data:startAngle="0"
                                                                data:strokeWidth="0" data:value="48"
                                                                data:pathOrig="M 113 6.756097560975604 A 106.2439024390244 106.2439024390244 0 0 1 126.31589183917337 218.4061375347772 L 118.32635673566935 155.1624550139109 A 42.49756097560976 42.49756097560976 0 0 0 113 70.50243902439024 L 113 6.756097560975604 z">
                                                            </path>
                                                        </g>
                                                        <g id="SvgjsG2032"
                                                            class="apexcharts-series apexcharts-pie-series"
                                                            seriesName="Google" rel="2" data:realIndex="1">
                                                            <path id="SvgjsPath2033"
                                                                d="M 126.31589183917337 218.4061375347772 A 106.2439024390244 106.2439024390244 0 0 1 8.637969166483714 93.09187789425812 L 71.25518766659349 105.03675115770325 A 42.49756097560976 42.49756097560976 0 0 0 118.32635673566935 155.1624550139109 L 126.31589183917337 218.4061375347772 z"
                                                                fill="rgba(13,202,240,1)" fill-opacity="1"
                                                                stroke-opacity="1" stroke-linecap="butt"
                                                                stroke-width="0" stroke-dasharray="0"
                                                                class="apexcharts-pie-area apexcharts-donut-slice-1"
                                                                index="0" j="1" data:angle="108" data:startAngle="172.8"
                                                                data:strokeWidth="0" data:value="30"
                                                                data:pathOrig="M 126.31589183917337 218.4061375347772 A 106.2439024390244 106.2439024390244 0 0 1 8.637969166483714 93.09187789425812 L 71.25518766659349 105.03675115770325 A 42.49756097560976 42.49756097560976 0 0 0 118.32635673566935 155.1624550139109 L 126.31589183917337 218.4061375347772 z">
                                                            </path>
                                                        </g>
                                                        <g id="SvgjsG2045"
                                                            class="apexcharts-series apexcharts-pie-series"
                                                            seriesName="Email" rel="3" data:realIndex="2">
                                                            <path id="SvgjsPath2046"
                                                                d="M 8.637969166483714 93.09187789425812 A 106.2439024390244 106.2439024390244 0 0 1 112.98145694101684 6.75609917916276 L 112.99258277640673 70.50243967166512 A 42.49756097560976 42.49756097560976 0 0 0 71.25518766659349 105.03675115770325 L 8.637969166483714 93.09187789425812 z"
                                                                fill="rgba(102,16,242,1)" fill-opacity="1"
                                                                stroke-opacity="1" stroke-linecap="butt"
                                                                stroke-width="0" stroke-dasharray="0"
                                                                class="apexcharts-pie-area apexcharts-donut-slice-2"
                                                                index="0" j="2" data:angle="79.19999999999999"
                                                                data:startAngle="280.8" data:strokeWidth="0"
                                                                data:value="22"
                                                                data:pathOrig="M 8.637969166483714 93.09187789425812 A 106.2439024390244 106.2439024390244 0 0 1 112.98145694101684 6.75609917916276 L 112.99258277640673 70.50243967166512 A 42.49756097560976 42.49756097560976 0 0 0 71.25518766659349 105.03675115770325 L 8.637969166483714 93.09187789425812 z">
                                                            </path>
                                                        </g>
                                                        <g id="SvgjsG2021" class="apexcharts-datalabels"><text
                                                                id="SvgjsText2022"
                                                                font-family="Helvetica, Arial, sans-serif"
                                                                x="187.22397805667038" y="108.3302231183224"
                                                                text-anchor="middle" dominant-baseline="auto"
                                                                font-size="12px" font-weight="600" fill="#ffffff"
                                                                class="apexcharts-text apexcharts-pie-label"
                                                                filter="url(#SvgjsFilter2023)"
                                                                style="font-family: Helvetica, Arial, sans-serif;">48.0%</text>
                                                        </g>
                                                        <g id="SvgjsG2034" class="apexcharts-datalabels"><text
                                                                id="SvgjsText2035"
                                                                font-family="Helvetica, Arial, sans-serif"
                                                                x="58.786069786991014" y="163.91026915604286"
                                                                text-anchor="middle" dominant-baseline="auto"
                                                                font-size="12px" font-weight="600" fill="#ffffff"
                                                                class="apexcharts-text apexcharts-pie-label"
                                                                filter="url(#SvgjsFilter2036)"
                                                                style="font-family: Helvetica, Arial, sans-serif;">30.0%</text>
                                                        </g>
                                                        <g id="SvgjsG2047" class="apexcharts-datalabels"><text
                                                                id="SvgjsText2048"
                                                                font-family="Helvetica, Arial, sans-serif"
                                                                x="65.59431147459253" y="55.69636634458694"
                                                                text-anchor="middle" dominant-baseline="auto"
                                                                font-size="12px" font-weight="600" fill="#ffffff"
                                                                class="apexcharts-text apexcharts-pie-label"
                                                                filter="url(#SvgjsFilter2049)"
                                                                style="font-family: Helvetica, Arial, sans-serif;">22.0%</text>
                                                        </g>
                                                    </g>
                                                </g>
                                            </g>
                                            <line id="SvgjsLine2058" x1="0" y1="0" x2="226" y2="0" stroke="#b6b6b6"
                                                stroke-dasharray="0" stroke-width="1" class="apexcharts-ycrosshairs">
                                            </line>
                                            <line id="SvgjsLine2059" x1="0" y1="0" x2="226" y2="0" stroke-dasharray="0"
                                                stroke-width="0" class="apexcharts-ycrosshairs-hidden"></line>
                                        </g>
                                        <g id="SvgjsG2012" class="apexcharts-annotations"></g>
                                    </svg>
                                    <div class="apexcharts-legend"></div>
                                    <div class="apexcharts-tooltip apexcharts-theme-dark">
                                        <div class="apexcharts-tooltip-series-group" style="order: 1;"><span
                                                class="apexcharts-tooltip-marker"
                                                style="background-color: rgb(253, 126, 20);"></span>
                                            <div class="apexcharts-tooltip-text"
                                                style="font-family: Helvetica, Arial, sans-serif; font-size: 12px;">
                                                <div class="apexcharts-tooltip-y-group"><span
                                                        class="apexcharts-tooltip-text-label"></span><span
                                                        class="apexcharts-tooltip-text-value"></span></div>
                                                <div class="apexcharts-tooltip-z-group"><span
                                                        class="apexcharts-tooltip-text-z-label"></span><span
                                                        class="apexcharts-tooltip-text-z-value"></span></div>
                                            </div>
                                        </div>
                                        <div class="apexcharts-tooltip-series-group" style="order: 2;"><span
                                                class="apexcharts-tooltip-marker"
                                                style="background-color: rgb(13, 202, 240);"></span>
                                            <div class="apexcharts-tooltip-text"
                                                style="font-family: Helvetica, Arial, sans-serif; font-size: 12px;">
                                                <div class="apexcharts-tooltip-y-group"><span
                                                        class="apexcharts-tooltip-text-label"></span><span
                                                        class="apexcharts-tooltip-text-value"></span></div>
                                                <div class="apexcharts-tooltip-z-group"><span
                                                        class="apexcharts-tooltip-text-z-label"></span><span
                                                        class="apexcharts-tooltip-text-z-value"></span></div>
                                            </div>
                                        </div>
                                        <div class="apexcharts-tooltip-series-group" style="order: 3;"><span
                                                class="apexcharts-tooltip-marker"
                                                style="background-color: rgb(102, 16, 242);"></span>
                                            <div class="apexcharts-tooltip-text"
                                                style="font-family: Helvetica, Arial, sans-serif; font-size: 12px;">
                                                <div class="apexcharts-tooltip-y-group"><span
                                                        class="apexcharts-tooltip-text-label"></span><span
                                                        class="apexcharts-tooltip-text-value"></span></div>
                                                <div class="apexcharts-tooltip-z-group"><span
                                                        class="apexcharts-tooltip-text-z-label"></span><span
                                                        class="apexcharts-tooltip-text-z-value"></span></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row text-center mb-5 mt-4">
                                <div class="col-4">
                                    <div class="display-7">48%</div>
                                    <div class="text-success my-2 small">
                                        <i class="bi bi-arrow-up me-1 small"></i>30.50%
                                    </div>
                                    <div class="d-flex align-items-center justify-content-center">
                                        <i class="bi bi-circle-fill text-orange me-2 small"></i>
                                        <span class="text-muted">Social Media</span>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="display-7">30%</div>
                                    <div class="text-danger my-2 small">
                                        <i class="bi bi-arrow-down me-1 small"></i>15.20%
                                    </div>
                                    <div class="d-flex align-items-center justify-content-center">
                                        <i class="bi bi-circle-fill text-cyan me-2 small"></i>
                                        <span class="text-muted">Google</span>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="display-7">22%</div>
                                    <div class="text-success my-2 small">
                                        <i class="bi bi-arrow-up me-1 small"></i>1.80%
                                    </div>
                                    <div class="d-flex align-items-center justify-content-center">
                                        <i class="bi bi-circle-fill text-indigo me-2 small"></i>
                                        <span class="text-muted">Email</span>
                                    </div>
                                </div>
                            </div>
                            <div class="text-center">
                                <button class="btn btn-outline-primary btn-icon">
                                    <i class="bi bi-download"></i> Download Report
                                </button>
                            </div>
                            <div class="resize-triggers">
                                <div class="expand-trigger">
                                    <div style="width: 614px; height: 496px;"></div>
                                </div>
                                <div class="contract-trigger"></div>
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
                            <h4 class="mb-3">Orders</h4>
                            <div class="d-flex mb-3" style="position: relative;">
                                <div class="display-7">310</div>
                                <div class="ms-auto" id="total-orders" style="min-height: 35px;">
                                    <div id="apexchartsg2xgr8c7"
                                        class="apexcharts-canvas apexchartsg2xgr8c7 apexcharts-theme-light"
                                        style="width: 100px; height: 35px;"><svg id="SvgjsSvg1821" width="100"
                                            height="35" xmlns="http://www.w3.org/2000/svg" version="1.1"
                                            xmlns:xlink="http://www.w3.org/1999/xlink"
                                            xmlns:svgjs="http://svgjs.com/svgjs" class="apexcharts-svg"
                                            xmlns:data="ApexChartsNS" transform="translate(0, 0)"
                                            style="background: transparent;">
                                            <g id="SvgjsG1823" class="apexcharts-inner apexcharts-graphical"
                                                transform="translate(0, 0)">
                                                <defs id="SvgjsDefs1822">
                                                    <clipPath id="gridRectMaskg2xgr8c7">
                                                        <rect id="SvgjsRect1828" width="108" height="39" x="-4" y="-2"
                                                            rx="0" ry="0" opacity="1" stroke-width="0" stroke="none"
                                                            stroke-dasharray="0" fill="#fff"></rect>
                                                    </clipPath>
                                                    <clipPath id="gridRectMarkerMaskg2xgr8c7">
                                                        <rect id="SvgjsRect1829" width="104" height="39" x="-2" y="-2"
                                                            rx="0" ry="0" opacity="1" stroke-width="0" stroke="none"
                                                            stroke-dasharray="0" fill="#fff"></rect>
                                                    </clipPath>
                                                </defs>
                                                <line id="SvgjsLine1827" x1="0" y1="0" x2="0" y2="35" stroke="#b6b6b6"
                                                    stroke-dasharray="3" class="apexcharts-xcrosshairs" x="0" y="0"
                                                    width="1" height="35" fill="#b1b9c4" filter="none"
                                                    fill-opacity="0.9" stroke-width="1"></line>
                                                <g id="SvgjsG1835" class="apexcharts-xaxis" transform="translate(0, 0)">
                                                    <g id="SvgjsG1836" class="apexcharts-xaxis-texts-g"
                                                        transform="translate(0, -4)"></g>
                                                </g>
                                                <g id="SvgjsG1845" class="apexcharts-grid">
                                                    <g id="SvgjsG1846" class="apexcharts-gridlines-horizontal"
                                                        style="display: none;">
                                                        <line id="SvgjsLine1848" x1="0" y1="0" x2="100" y2="0"
                                                            stroke="#e0e0e0" stroke-dasharray="0"
                                                            class="apexcharts-gridline"></line>
                                                        <line id="SvgjsLine1849" x1="0" y1="8.75" x2="100" y2="8.75"
                                                            stroke="#e0e0e0" stroke-dasharray="0"
                                                            class="apexcharts-gridline"></line>
                                                        <line id="SvgjsLine1850" x1="0" y1="17.5" x2="100" y2="17.5"
                                                            stroke="#e0e0e0" stroke-dasharray="0"
                                                            class="apexcharts-gridline"></line>
                                                        <line id="SvgjsLine1851" x1="0" y1="26.25" x2="100" y2="26.25"
                                                            stroke="#e0e0e0" stroke-dasharray="0"
                                                            class="apexcharts-gridline"></line>
                                                        <line id="SvgjsLine1852" x1="0" y1="35" x2="100" y2="35"
                                                            stroke="#e0e0e0" stroke-dasharray="0"
                                                            class="apexcharts-gridline"></line>
                                                    </g>
                                                    <g id="SvgjsG1847" class="apexcharts-gridlines-vertical"
                                                        style="display: none;"></g>
                                                    <line id="SvgjsLine1854" x1="0" y1="35" x2="100" y2="35"
                                                        stroke="transparent" stroke-dasharray="0"></line>
                                                    <line id="SvgjsLine1853" x1="0" y1="1" x2="0" y2="35"
                                                        stroke="transparent" stroke-dasharray="0"></line>
                                                </g>
                                                <g id="SvgjsG1830"
                                                    class="apexcharts-line-series apexcharts-plot-series">
                                                    <g id="SvgjsG1831" class="apexcharts-series" seriesName="seriesx1"
                                                        data:longestSeries="true" rel="1" data:realIndex="0">
                                                        <path id="SvgjsPath1834"
                                                            d="M 0 32.8125C 5.833333333333333 32.8125 10.833333333333336 14.875 16.666666666666668 14.875C 22.5 14.875 27.500000000000004 25.8125 33.333333333333336 25.8125C 39.16666666666667 25.8125 44.16666666666667 4.8125 50 4.8125C 55.833333333333336 4.8125 60.833333333333336 16.1875 66.66666666666667 16.1875C 72.5 16.1875 77.50000000000001 30.625 83.33333333333334 30.625C 89.16666666666667 30.625 94.16666666666667 21.875 100 21.875"
                                                            fill="none" fill-opacity="1" stroke="rgba(214,51,132,0.85)"
                                                            stroke-opacity="1" stroke-linecap="butt" stroke-width="4"
                                                            stroke-dasharray="0" class="apexcharts-line" index="0"
                                                            clip-path="url(#gridRectMaskg2xgr8c7)"
                                                            pathTo="M 0 32.8125C 5.833333333333333 32.8125 10.833333333333336 14.875 16.666666666666668 14.875C 22.5 14.875 27.500000000000004 25.8125 33.333333333333336 25.8125C 39.16666666666667 25.8125 44.16666666666667 4.8125 50 4.8125C 55.833333333333336 4.8125 60.833333333333336 16.1875 66.66666666666667 16.1875C 72.5 16.1875 77.50000000000001 30.625 83.33333333333334 30.625C 89.16666666666667 30.625 94.16666666666667 21.875 100 21.875"
                                                            pathFrom="M -1 43.75L -1 43.75L 16.666666666666668 43.75L 33.333333333333336 43.75L 50 43.75L 66.66666666666667 43.75L 83.33333333333334 43.75L 100 43.75">
                                                        </path>
                                                        <g id="SvgjsG1832" class="apexcharts-series-markers-wrap"
                                                            data:realIndex="0">
                                                            <g class="apexcharts-series-markers">
                                                                <circle id="SvgjsCircle1860" r="0" cx="0" cy="0"
                                                                    class="apexcharts-marker wlgsdrgeml no-pointer-events"
                                                                    stroke="#ffffff" fill="#d63384" fill-opacity="1"
                                                                    stroke-width="2" stroke-opacity="0.9"
                                                                    default-marker-size="0"></circle>
                                                            </g>
                                                        </g>
                                                    </g>
                                                    <g id="SvgjsG1833" class="apexcharts-datalabels" data:realIndex="0">
                                                    </g>
                                                </g>
                                                <line id="SvgjsLine1855" x1="0" y1="0" x2="100" y2="0" stroke="#b6b6b6"
                                                    stroke-dasharray="0" stroke-width="1"
                                                    class="apexcharts-ycrosshairs"></line>
                                                <line id="SvgjsLine1856" x1="0" y1="0" x2="100" y2="0"
                                                    stroke-dasharray="0" stroke-width="0"
                                                    class="apexcharts-ycrosshairs-hidden"></line>
                                                <g id="SvgjsG1857" class="apexcharts-yaxis-annotations"></g>
                                                <g id="SvgjsG1858" class="apexcharts-xaxis-annotations"></g>
                                                <g id="SvgjsG1859" class="apexcharts-point-annotations"></g>
                                            </g>
                                            <rect id="SvgjsRect1826" width="0" height="0" x="0" y="0" rx="0" ry="0"
                                                opacity="1" stroke-width="0" stroke="none" stroke-dasharray="0"
                                                fill="#fefefe"></rect>
                                            <g id="SvgjsG1844" class="apexcharts-yaxis" rel="0"
                                                transform="translate(-18, 0)"></g>
                                            <g id="SvgjsG1824" class="apexcharts-annotations"></g>
                                        </svg>
                                        <div class="apexcharts-legend" style="max-height: 17.5px;"></div>
                                        <div class="apexcharts-tooltip apexcharts-theme-light">
                                            <div class="apexcharts-tooltip-series-group" style="order: 1;"><span
                                                    class="apexcharts-tooltip-marker"
                                                    style="background-color: rgb(214, 51, 132);"></span>
                                                <div class="apexcharts-tooltip-text"
                                                    style="font-family: Helvetica, Arial, sans-serif; font-size: 12px;">
                                                    <div class="apexcharts-tooltip-y-group"><span
                                                            class="apexcharts-tooltip-text-label"></span><span
                                                            class="apexcharts-tooltip-text-value"></span></div>
                                                    <div class="apexcharts-tooltip-z-group"><span
                                                            class="apexcharts-tooltip-text-z-label"></span><span
                                                            class="apexcharts-tooltip-text-z-value"></span></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div
                                            class="apexcharts-yaxistooltip apexcharts-yaxistooltip-0 apexcharts-yaxistooltip-left apexcharts-theme-light">
                                            <div class="apexcharts-yaxistooltip-text"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="resize-triggers">
                                    <div class="expand-trigger">
                                        <div style="width: 439px; height: 39px;"></div>
                                    </div>
                                    <div class="contract-trigger"></div>
                                </div>
                            </div>
                            <div class="text-success">
                                Over last month 1.4% <i class="small bi bi-arrow-up"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-12">
                    <div class="card h-100">
                        <div class="card-body">
                            <div class="d-flex mb-3">
                                <div class="display-7">
                                    <i class="bi bi-credit-card-2-front"></i>
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
                            <h4 class="mb-3">Sales</h4>
                            <div class="d-flex mb-3" style="position: relative;">
                                <div class="display-7">$3.759,00</div>
                                <div class="ms-auto" id="total-sales" style="min-height: 35px;">
                                    <div id="apexcharts7qolpzih"
                                        class="apexcharts-canvas apexcharts7qolpzih apexcharts-theme-light"
                                        style="width: 100px; height: 35px;"><svg id="SvgjsSvg1780" width="100"
                                            height="35" xmlns="http://www.w3.org/2000/svg" version="1.1"
                                            xmlns:xlink="http://www.w3.org/1999/xlink"
                                            xmlns:svgjs="http://svgjs.com/svgjs" class="apexcharts-svg"
                                            xmlns:data="ApexChartsNS" transform="translate(0, 0)"
                                            style="background: transparent;">
                                            <g id="SvgjsG1782" class="apexcharts-inner apexcharts-graphical"
                                                transform="translate(0, 0)">
                                                <defs id="SvgjsDefs1781">
                                                    <clipPath id="gridRectMask7qolpzih">
                                                        <rect id="SvgjsRect1787" width="108" height="39" x="-4" y="-2"
                                                            rx="0" ry="0" opacity="1" stroke-width="0" stroke="none"
                                                            stroke-dasharray="0" fill="#fff"></rect>
                                                    </clipPath>
                                                    <clipPath id="gridRectMarkerMask7qolpzih">
                                                        <rect id="SvgjsRect1788" width="104" height="39" x="-2" y="-2"
                                                            rx="0" ry="0" opacity="1" stroke-width="0" stroke="none"
                                                            stroke-dasharray="0" fill="#fff"></rect>
                                                    </clipPath>
                                                </defs>
                                                <line id="SvgjsLine1786" x1="0" y1="0" x2="0" y2="35" stroke="#b6b6b6"
                                                    stroke-dasharray="3" class="apexcharts-xcrosshairs" x="0" y="0"
                                                    width="1" height="35" fill="#b1b9c4" filter="none"
                                                    fill-opacity="0.9" stroke-width="1"></line>
                                                <g id="SvgjsG1794" class="apexcharts-xaxis" transform="translate(0, 0)">
                                                    <g id="SvgjsG1795" class="apexcharts-xaxis-texts-g"
                                                        transform="translate(0, -4)"></g>
                                                </g>
                                                <g id="SvgjsG1804" class="apexcharts-grid">
                                                    <g id="SvgjsG1805" class="apexcharts-gridlines-horizontal"
                                                        style="display: none;">
                                                        <line id="SvgjsLine1807" x1="0" y1="0" x2="100" y2="0"
                                                            stroke="#e0e0e0" stroke-dasharray="0"
                                                            class="apexcharts-gridline"></line>
                                                        <line id="SvgjsLine1808" x1="0" y1="8.75" x2="100" y2="8.75"
                                                            stroke="#e0e0e0" stroke-dasharray="0"
                                                            class="apexcharts-gridline"></line>
                                                        <line id="SvgjsLine1809" x1="0" y1="17.5" x2="100" y2="17.5"
                                                            stroke="#e0e0e0" stroke-dasharray="0"
                                                            class="apexcharts-gridline"></line>
                                                        <line id="SvgjsLine1810" x1="0" y1="26.25" x2="100" y2="26.25"
                                                            stroke="#e0e0e0" stroke-dasharray="0"
                                                            class="apexcharts-gridline"></line>
                                                        <line id="SvgjsLine1811" x1="0" y1="35" x2="100" y2="35"
                                                            stroke="#e0e0e0" stroke-dasharray="0"
                                                            class="apexcharts-gridline"></line>
                                                    </g>
                                                    <g id="SvgjsG1806" class="apexcharts-gridlines-vertical"
                                                        style="display: none;"></g>
                                                    <line id="SvgjsLine1813" x1="0" y1="35" x2="100" y2="35"
                                                        stroke="transparent" stroke-dasharray="0"></line>
                                                    <line id="SvgjsLine1812" x1="0" y1="1" x2="0" y2="35"
                                                        stroke="transparent" stroke-dasharray="0"></line>
                                                </g>
                                                <g id="SvgjsG1789"
                                                    class="apexcharts-line-series apexcharts-plot-series">
                                                    <g id="SvgjsG1790" class="apexcharts-series" seriesName="seriesx1"
                                                        data:longestSeries="true" rel="1" data:realIndex="0">
                                                        <path id="SvgjsPath1793"
                                                            d="M 0 32.8125C 5.833333333333333 32.8125 10.833333333333336 14.875 16.666666666666668 14.875C 22.5 14.875 27.500000000000004 25.8125 33.333333333333336 25.8125C 39.16666666666667 25.8125 44.16666666666667 4.8125 50 4.8125C 55.833333333333336 4.8125 60.833333333333336 16.1875 66.66666666666667 16.1875C 72.5 16.1875 77.50000000000001 30.625 83.33333333333334 30.625C 89.16666666666667 30.625 94.16666666666667 21.875 100 21.875"
                                                            fill="none" fill-opacity="1" stroke="rgba(102,16,242,0.85)"
                                                            stroke-opacity="1" stroke-linecap="butt" stroke-width="4"
                                                            stroke-dasharray="0" class="apexcharts-line" index="0"
                                                            clip-path="url(#gridRectMask7qolpzih)"
                                                            pathTo="M 0 32.8125C 5.833333333333333 32.8125 10.833333333333336 14.875 16.666666666666668 14.875C 22.5 14.875 27.500000000000004 25.8125 33.333333333333336 25.8125C 39.16666666666667 25.8125 44.16666666666667 4.8125 50 4.8125C 55.833333333333336 4.8125 60.833333333333336 16.1875 66.66666666666667 16.1875C 72.5 16.1875 77.50000000000001 30.625 83.33333333333334 30.625C 89.16666666666667 30.625 94.16666666666667 21.875 100 21.875"
                                                            pathFrom="M -1 43.75L -1 43.75L 16.666666666666668 43.75L 33.333333333333336 43.75L 50 43.75L 66.66666666666667 43.75L 83.33333333333334 43.75L 100 43.75">
                                                        </path>
                                                        <g id="SvgjsG1791" class="apexcharts-series-markers-wrap"
                                                            data:realIndex="0">
                                                            <g class="apexcharts-series-markers">
                                                                <circle id="SvgjsCircle1819" r="0" cx="0" cy="0"
                                                                    class="apexcharts-marker wxndf63nl no-pointer-events"
                                                                    stroke="#ffffff" fill="#6610f2" fill-opacity="1"
                                                                    stroke-width="2" stroke-opacity="0.9"
                                                                    default-marker-size="0"></circle>
                                                            </g>
                                                        </g>
                                                    </g>
                                                    <g id="SvgjsG1792" class="apexcharts-datalabels" data:realIndex="0">
                                                    </g>
                                                </g>
                                                <line id="SvgjsLine1814" x1="0" y1="0" x2="100" y2="0" stroke="#b6b6b6"
                                                    stroke-dasharray="0" stroke-width="1"
                                                    class="apexcharts-ycrosshairs"></line>
                                                <line id="SvgjsLine1815" x1="0" y1="0" x2="100" y2="0"
                                                    stroke-dasharray="0" stroke-width="0"
                                                    class="apexcharts-ycrosshairs-hidden"></line>
                                                <g id="SvgjsG1816" class="apexcharts-yaxis-annotations"></g>
                                                <g id="SvgjsG1817" class="apexcharts-xaxis-annotations"></g>
                                                <g id="SvgjsG1818" class="apexcharts-point-annotations"></g>
                                            </g>
                                            <rect id="SvgjsRect1785" width="0" height="0" x="0" y="0" rx="0" ry="0"
                                                opacity="1" stroke-width="0" stroke="none" stroke-dasharray="0"
                                                fill="#fefefe"></rect>
                                            <g id="SvgjsG1803" class="apexcharts-yaxis" rel="0"
                                                transform="translate(-18, 0)"></g>
                                            <g id="SvgjsG1783" class="apexcharts-annotations"></g>
                                        </svg>
                                        <div class="apexcharts-legend" style="max-height: 17.5px;"></div>
                                        <div class="apexcharts-tooltip apexcharts-theme-light">
                                            <div class="apexcharts-tooltip-series-group" style="order: 1;"><span
                                                    class="apexcharts-tooltip-marker"
                                                    style="background-color: rgb(102, 16, 242);"></span>
                                                <div class="apexcharts-tooltip-text"
                                                    style="font-family: Helvetica, Arial, sans-serif; font-size: 12px;">
                                                    <div class="apexcharts-tooltip-y-group"><span
                                                            class="apexcharts-tooltip-text-label"></span><span
                                                            class="apexcharts-tooltip-text-value"></span></div>
                                                    <div class="apexcharts-tooltip-z-group"><span
                                                            class="apexcharts-tooltip-text-z-label"></span><span
                                                            class="apexcharts-tooltip-text-z-value"></span></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div
                                            class="apexcharts-yaxistooltip apexcharts-yaxistooltip-0 apexcharts-yaxistooltip-left apexcharts-theme-light">
                                            <div class="apexcharts-yaxistooltip-text"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="resize-triggers">
                                    <div class="expand-trigger">
                                        <div style="width: 439px; height: 39px;"></div>
                                    </div>
                                    <div class="contract-trigger"></div>
                                </div>
                            </div>
                            <div class="text-danger">
                                Over last month 2.4% <i class="small bi bi-arrow-down"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-12">
                    <div class="card h-100">
                        <div class="card-body">
                            <div class="d-flex align-items-center mb-4">
                                <h6 class="card-title">Recent Reviews</h6>
                                <div class="dropdown ms-auto">
                                    <a href="#">View All</a>
                                </div>
                            </div>
                            <div class="summary-cards slick-initialized slick-slider">
                                <div class="slick-list draggable">
                                    <div class="slick-track"
                                        style="opacity: 1; width: 3066px; transform: translate3d(-876px, 0px, 0px);">
                                        <div class="slick-slide slick-cloned" data-slick-index="-1" aria-hidden="true"
                                            tabindex="-1" style="width: 438px;">
                                            <div class="d-flex align-items-center mb-3">
                                                <div class="avatar me-3">
                                                    <span class="avatar-text bg-yellow rounded-circle">D</span>
                                                </div>
                                                <div>
                                                    <h5 class="mb-1">David Berks</h5>
                                                    <ul class="list-inline ms-auto mb-0">
                                                        <li class="list-inline-item mb-0">
                                                            <i class="bi bi-star-fill text-warning"></i>
                                                        </li>
                                                        <li class="list-inline-item mb-0">
                                                            <i class="bi bi-star-fill text-warning"></i>
                                                        </li>
                                                        <li class="list-inline-item mb-0">
                                                            <i class="bi bi-star-fill text-warning"></i>
                                                        </li>
                                                        <li class="list-inline-item mb-0">
                                                            <i class="bi bi-star-fill text-warning"></i>
                                                        </li>
                                                        <li class="list-inline-item mb-0">
                                                            <i class="bi bi-star-fill text-warning"></i>
                                                        </li>
                                                        <li class="list-inline-item mb-0">(5)</li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div>I am very satisfied with this product.</div>
                                        </div>
                                        <div class="slick-slide" data-slick-index="0" aria-hidden="true" tabindex="-1"
                                            style="width: 438px;">
                                            <div class="d-flex align-items-center mb-3">
                                                <div class="avatar me-3">
                                                    <img src="#" class="rounded-circle" alt="image">
                                                </div>
                                                <div>
                                                    <h5 class="mb-1">Amara Keel</h5>
                                                    <ul class="list-inline ms-auto mb-0">
                                                        <li class="list-inline-item mb-0">
                                                            <i class="bi bi-star-fill text-warning"></i>
                                                        </li>
                                                        <li class="list-inline-item mb-0">
                                                            <i class="bi bi-star-fill text-warning"></i>
                                                        </li>
                                                        <li class="list-inline-item mb-0">
                                                            <i class="bi bi-star-fill text-warning"></i>
                                                        </li>
                                                        <li class="list-inline-item mb-0">
                                                            <i class="bi bi-star-fill text-warning"></i>
                                                        </li>
                                                        <li class="list-inline-item mb-0">
                                                            <i class="bi bi-star-fill text-muted"></i>
                                                        </li>
                                                        <li class="list-inline-item mb-0">(4)</li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div>I love your products. It is very easy and fun to use this panel.</div>
                                        </div>
                                        <div class="slick-slide slick-current slick-active" data-slick-index="1"
                                            aria-hidden="false" tabindex="0" style="width: 438px;">
                                            <div class="d-flex align-items-center mb-3">
                                                <div class="avatar me-3">
                                                    <span class="avatar-text bg-indigo rounded-circle">J</span>
                                                </div>
                                                <div>
                                                    <h5 class="mb-1">Johnath Siddeley</h5>
                                                    <ul class="list-inline ms-auto mb-0">
                                                        <li class="list-inline-item mb-0">
                                                            <i class="bi bi-star-fill text-warning"></i>
                                                        </li>
                                                        <li class="list-inline-item mb-0">
                                                            <i class="bi bi-star-fill text-warning"></i>
                                                        </li>
                                                        <li class="list-inline-item mb-0">
                                                            <i class="bi bi-star-fill text-warning"></i>
                                                        </li>
                                                        <li class="list-inline-item mb-0">
                                                            <i class="bi bi-star-fill text-warning"></i>
                                                        </li>
                                                        <li class="list-inline-item mb-0">
                                                            <i class="bi bi-star-fill text-warning"></i>
                                                        </li>
                                                        <li class="list-inline-item mb-0">(5)</li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div>Very nice glasses. I ordered for my friend.</div>
                                        </div>
                                        <div class="slick-slide" data-slick-index="2" aria-hidden="true" tabindex="-1"
                                            style="width: 438px;">
                                            <div class="d-flex align-items-center mb-3">
                                                <div class="avatar me-3">
                                                    <span class="avatar-text bg-yellow rounded-circle">D</span>
                                                </div>
                                                <div>
                                                    <h5 class="mb-1">David Berks</h5>
                                                    <ul class="list-inline ms-auto mb-0">
                                                        <li class="list-inline-item mb-0">
                                                            <i class="bi bi-star-fill text-warning"></i>
                                                        </li>
                                                        <li class="list-inline-item mb-0">
                                                            <i class="bi bi-star-fill text-warning"></i>
                                                        </li>
                                                        <li class="list-inline-item mb-0">
                                                            <i class="bi bi-star-fill text-warning"></i>
                                                        </li>
                                                        <li class="list-inline-item mb-0">
                                                            <i class="bi bi-star-fill text-warning"></i>
                                                        </li>
                                                        <li class="list-inline-item mb-0">
                                                            <i class="bi bi-star-fill text-warning"></i>
                                                        </li>
                                                        <li class="list-inline-item mb-0">(5)</li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div>I am very satisfied with this product.</div>
                                        </div>
                                        <div class="slick-slide slick-cloned" data-slick-index="3" aria-hidden="true"
                                            tabindex="-1" style="width: 438px;">
                                            <div class="d-flex align-items-center mb-3">
                                                <div class="avatar me-3">
                                                    <img src="#" class="rounded-circle" alt="image">
                                                </div>
                                                <div>
                                                    <h5 class="mb-1">Amara Keel</h5>
                                                    <ul class="list-inline ms-auto mb-0">
                                                        <li class="list-inline-item mb-0">
                                                            <i class="bi bi-star-fill text-warning"></i>
                                                        </li>
                                                        <li class="list-inline-item mb-0">
                                                            <i class="bi bi-star-fill text-warning"></i>
                                                        </li>
                                                        <li class="list-inline-item mb-0">
                                                            <i class="bi bi-star-fill text-warning"></i>
                                                        </li>
                                                        <li class="list-inline-item mb-0">
                                                            <i class="bi bi-star-fill text-warning"></i>
                                                        </li>
                                                        <li class="list-inline-item mb-0">
                                                            <i class="bi bi-star-fill text-muted"></i>
                                                        </li>
                                                        <li class="list-inline-item mb-0">(4)</li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div>I love your products. It is very easy and fun to use this panel.</div>
                                        </div>
                                        <div class="slick-slide slick-cloned" data-slick-index="4" aria-hidden="true"
                                            tabindex="-1" style="width: 438px;">
                                            <div class="d-flex align-items-center mb-3">
                                                <div class="avatar me-3">
                                                    <span class="avatar-text bg-indigo rounded-circle">J</span>
                                                </div>
                                                <div>
                                                    <h5 class="mb-1">Johnath Siddeley</h5>
                                                    <ul class="list-inline ms-auto mb-0">
                                                        <li class="list-inline-item mb-0">
                                                            <i class="bi bi-star-fill text-warning"></i>
                                                        </li>
                                                        <li class="list-inline-item mb-0">
                                                            <i class="bi bi-star-fill text-warning"></i>
                                                        </li>
                                                        <li class="list-inline-item mb-0">
                                                            <i class="bi bi-star-fill text-warning"></i>
                                                        </li>
                                                        <li class="list-inline-item mb-0">
                                                            <i class="bi bi-star-fill text-warning"></i>
                                                        </li>
                                                        <li class="list-inline-item mb-0">
                                                            <i class="bi bi-star-fill text-warning"></i>
                                                        </li>
                                                        <li class="list-inline-item mb-0">(5)</li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div>Very nice glasses. I ordered for my friend.</div>
                                        </div>
                                        <div class="slick-slide slick-cloned" data-slick-index="5" aria-hidden="true"
                                            tabindex="-1" style="width: 438px;">
                                            <div class="d-flex align-items-center mb-3">
                                                <div class="avatar me-3">
                                                    <span class="avatar-text bg-yellow rounded-circle">D</span>
                                                </div>
                                                <div>
                                                    <h5 class="mb-1">David Berks</h5>
                                                    <ul class="list-inline ms-auto mb-0">
                                                        <li class="list-inline-item mb-0">
                                                            <i class="bi bi-star-fill text-warning"></i>
                                                        </li>
                                                        <li class="list-inline-item mb-0">
                                                            <i class="bi bi-star-fill text-warning"></i>
                                                        </li>
                                                        <li class="list-inline-item mb-0">
                                                            <i class="bi bi-star-fill text-warning"></i>
                                                        </li>
                                                        <li class="list-inline-item mb-0">
                                                            <i class="bi bi-star-fill text-warning"></i>
                                                        </li>
                                                        <li class="list-inline-item mb-0">
                                                            <i class="bi bi-star-fill text-warning"></i>
                                                        </li>
                                                        <li class="list-inline-item mb-0">(5)</li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div>I am very satisfied with this product.</div>
                                        </div>
                                    </div>
                                </div>


                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-12">
                    <div class="card h-100">
                        <div class="card-body">
                            <div class="d-flex mb-4">
                                <h6 class="card-title mb-0">Customer Rating</h6>
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
                            <div class="text-center">
                                <div class="display-6">3.0</div>
                                <div class="d-flex justify-content-center gap-3 my-3">
                                    <i class="bi bi-star-fill icon-lg text-warning"></i>
                                    <i class="bi bi-star-fill icon-lg text-warning"></i>
                                    <i class="bi bi-star-fill icon-lg text-warning"></i>
                                    <i class="bi bi-star-fill icon-lg text-muted"></i>
                                    <i class="bi bi-star-fill icon-lg text-muted"></i>
                                    <span>(318)</span>
                                </div>
                            </div>
                            <div class="text-muted d-flex align-items-center justify-content-center">
                                <span class="text-success me-3 d-block">
                                    <i class="bi bi-arrow-up me-1 small"></i>+35
                                </span> Point from last month
                            </div>
                            <div class="row my-4">
                                <div class="col-md-6 m-auto" style="position: relative;">
                                    <div id="customer-rating" style="min-height: 50px;">
                                        <div id="apexcharts77ktvse"
                                            class="apexcharts-canvas apexcharts77ktvse apexcharts-theme-light"
                                            style="width: 207px; height: 50px;"><svg id="SvgjsSvg1862" width="207"
                                                height="50" xmlns="http://www.w3.org/2000/svg" version="1.1"
                                                xmlns:xlink="http://www.w3.org/1999/xlink"
                                                xmlns:svgjs="http://svgjs.com/svgjs" class="apexcharts-svg"
                                                xmlns:data="ApexChartsNS" transform="translate(0, 0)"
                                                style="background: transparent;">
                                                <g id="SvgjsG1864" class="apexcharts-inner apexcharts-graphical"
                                                    transform="translate(0, 0)">
                                                    <defs id="SvgjsDefs1863">
                                                        <clipPath id="gridRectMask77ktvse">
                                                            <rect id="SvgjsRect1869" width="215" height="54" x="-4"
                                                                y="-2" rx="0" ry="0" opacity="1" stroke-width="0"
                                                                stroke="none" stroke-dasharray="0" fill="#fff"></rect>
                                                        </clipPath>
                                                        <clipPath id="gridRectMarkerMask77ktvse">
                                                            <rect id="SvgjsRect1870" width="211" height="54" x="-2"
                                                                y="-2" rx="0" ry="0" opacity="1" stroke-width="0"
                                                                stroke="none" stroke-dasharray="0" fill="#fff"></rect>
                                                        </clipPath>
                                                    </defs>
                                                    <line id="SvgjsLine1868" x1="0" y1="0" x2="0" y2="50"
                                                        stroke="#b6b6b6" stroke-dasharray="3"
                                                        class="apexcharts-xcrosshairs" x="0" y="0" width="1" height="50"
                                                        fill="#b1b9c4" filter="none" fill-opacity="0.9"
                                                        stroke-width="1"></line>
                                                    <g id="SvgjsG1876" class="apexcharts-xaxis"
                                                        transform="translate(0, 0)">
                                                        <g id="SvgjsG1877" class="apexcharts-xaxis-texts-g"
                                                            transform="translate(0, -4)"></g>
                                                    </g>
                                                    <g id="SvgjsG1888" class="apexcharts-grid">
                                                        <g id="SvgjsG1889" class="apexcharts-gridlines-horizontal"
                                                            style="display: none;">
                                                            <line id="SvgjsLine1891" x1="0" y1="0" x2="207" y2="0"
                                                                stroke="#e0e0e0" stroke-dasharray="0"
                                                                class="apexcharts-gridline"></line>
                                                            <line id="SvgjsLine1892" x1="0" y1="10" x2="207" y2="10"
                                                                stroke="#e0e0e0" stroke-dasharray="0"
                                                                class="apexcharts-gridline"></line>
                                                            <line id="SvgjsLine1893" x1="0" y1="20" x2="207" y2="20"
                                                                stroke="#e0e0e0" stroke-dasharray="0"
                                                                class="apexcharts-gridline"></line>
                                                            <line id="SvgjsLine1894" x1="0" y1="30" x2="207" y2="30"
                                                                stroke="#e0e0e0" stroke-dasharray="0"
                                                                class="apexcharts-gridline"></line>
                                                            <line id="SvgjsLine1895" x1="0" y1="40" x2="207" y2="40"
                                                                stroke="#e0e0e0" stroke-dasharray="0"
                                                                class="apexcharts-gridline"></line>
                                                            <line id="SvgjsLine1896" x1="0" y1="50" x2="207" y2="50"
                                                                stroke="#e0e0e0" stroke-dasharray="0"
                                                                class="apexcharts-gridline"></line>
                                                        </g>
                                                        <g id="SvgjsG1890" class="apexcharts-gridlines-vertical"
                                                            style="display: none;"></g>
                                                        <line id="SvgjsLine1898" x1="0" y1="50" x2="207" y2="50"
                                                            stroke="transparent" stroke-dasharray="0"></line>
                                                        <line id="SvgjsLine1897" x1="0" y1="1" x2="0" y2="50"
                                                            stroke="transparent" stroke-dasharray="0"></line>
                                                    </g>
                                                    <g id="SvgjsG1871"
                                                        class="apexcharts-line-series apexcharts-plot-series">
                                                        <g id="SvgjsG1872" class="apexcharts-series" seriesName="Rate"
                                                            data:longestSeries="true" rel="1" data:realIndex="0">
                                                            <path id="SvgjsPath1875"
                                                                d="M 0 37.5C 9.056249999999999 37.5 16.81875 17 25.875 17C 34.93125 17 42.69375 29.5 51.75 29.5C 60.80625 29.5 68.56875 5.5 77.625 5.5C 86.68125 5.5 94.44375 18.5 103.5 18.5C 112.55625 18.5 120.31875 37.5 129.375 37.5C 138.43125 37.5 146.19375 28 155.25 28C 164.30625 28 172.06875 44 181.125 44C 190.18125 44 197.94375 32 207 32"
                                                                fill="none" fill-opacity="1"
                                                                stroke="rgba(5,177,113,0.85)" stroke-opacity="1"
                                                                stroke-linecap="butt" stroke-width="4"
                                                                stroke-dasharray="0" class="apexcharts-line" index="0"
                                                                clip-path="url(#gridRectMask77ktvse)"
                                                                pathTo="M 0 37.5C 9.056249999999999 37.5 16.81875 17 25.875 17C 34.93125 17 42.69375 29.5 51.75 29.5C 60.80625 29.5 68.56875 5.5 77.625 5.5C 86.68125 5.5 94.44375 18.5 103.5 18.5C 112.55625 18.5 120.31875 37.5 129.375 37.5C 138.43125 37.5 146.19375 28 155.25 28C 164.30625 28 172.06875 44 181.125 44C 190.18125 44 197.94375 32 207 32"
                                                                pathFrom="M -1 50L -1 50L 25.875 50L 51.75 50L 77.625 50L 103.5 50L 129.375 50L 155.25 50L 181.125 50L 207 50">
                                                            </path>
                                                            <g id="SvgjsG1873" class="apexcharts-series-markers-wrap"
                                                                data:realIndex="0">
                                                                <g class="apexcharts-series-markers">
                                                                    <circle id="SvgjsCircle1904" r="0" cx="0" cy="0"
                                                                        class="apexcharts-marker wzlbqa30k no-pointer-events"
                                                                        stroke="#ffffff" fill="#05b171" fill-opacity="1"
                                                                        stroke-width="2" stroke-opacity="0.9"
                                                                        default-marker-size="0"></circle>
                                                                </g>
                                                            </g>
                                                        </g>
                                                        <g id="SvgjsG1874" class="apexcharts-datalabels"
                                                            data:realIndex="0"></g>
                                                    </g>
                                                    <line id="SvgjsLine1899" x1="0" y1="0" x2="207" y2="0"
                                                        stroke="#b6b6b6" stroke-dasharray="0" stroke-width="1"
                                                        class="apexcharts-ycrosshairs"></line>
                                                    <line id="SvgjsLine1900" x1="0" y1="0" x2="207" y2="0"
                                                        stroke-dasharray="0" stroke-width="0"
                                                        class="apexcharts-ycrosshairs-hidden"></line>
                                                    <g id="SvgjsG1901" class="apexcharts-yaxis-annotations"></g>
                                                    <g id="SvgjsG1902" class="apexcharts-xaxis-annotations"></g>
                                                    <g id="SvgjsG1903" class="apexcharts-point-annotations"></g>
                                                </g>
                                                <rect id="SvgjsRect1867" width="0" height="0" x="0" y="0" rx="0" ry="0"
                                                    opacity="1" stroke-width="0" stroke="none" stroke-dasharray="0"
                                                    fill="#fefefe"></rect>
                                                <g id="SvgjsG1887" class="apexcharts-yaxis" rel="0"
                                                    transform="translate(-18, 0)"></g>
                                                <g id="SvgjsG1865" class="apexcharts-annotations"></g>
                                            </svg>
                                            <div class="apexcharts-legend" style="max-height: 25px;"></div>
                                            <div class="apexcharts-tooltip apexcharts-theme-light">
                                                <div class="apexcharts-tooltip-series-group" style="order: 1;"><span
                                                        class="apexcharts-tooltip-marker"
                                                        style="background-color: rgb(5, 177, 113);"></span>
                                                    <div class="apexcharts-tooltip-text"
                                                        style="font-family: Helvetica, Arial, sans-serif; font-size: 12px;">
                                                        <div class="apexcharts-tooltip-y-group"><span
                                                                class="apexcharts-tooltip-text-label"></span><span
                                                                class="apexcharts-tooltip-text-value"></span></div>
                                                        <div class="apexcharts-tooltip-z-group"><span
                                                                class="apexcharts-tooltip-text-z-label"></span><span
                                                                class="apexcharts-tooltip-text-z-value"></span></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div
                                                class="apexcharts-yaxistooltip apexcharts-yaxistooltip-0 apexcharts-yaxistooltip-left apexcharts-theme-light">
                                                <div class="apexcharts-yaxistooltip-text"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="resize-triggers">
                                        <div class="expand-trigger">
                                            <div style="width: 232px; height: 51px;"></div>
                                        </div>
                                        <div class="contract-trigger"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="text-center">
                                <button class="btn btn-outline-primary btn-icon">
                                    <i class="bi bi-download"></i> Download Report
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="card h-100 bg-purple">
                        <div class="card-body text-center" style="position: relative;">
                            <div class="text-white-50">
                                <div class="bi bi-box-seam display-6 mb-3"></div>
                                <div class="display-8 mb-2">Products Sold</div>
                                <h5>89 Sold</h5>
                            </div>
                            <div id="products-sold" style="min-height: 195px;">
                                <div id="apexchartszd9y70cq"
                                    class="apexcharts-canvas apexchartszd9y70cq apexcharts-theme-light"
                                    style="width: 438px; height: 180px;"><svg id="SvgjsSvg2060" width="438" height="180"
                                        xmlns="http://www.w3.org/2000/svg" version="1.1"
                                        xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.com/svgjs"
                                        class="apexcharts-svg" xmlns:data="ApexChartsNS" transform="translate(0, 0)"
                                        style="background: transparent;">
                                        <g id="SvgjsG2062" class="apexcharts-inner apexcharts-graphical"
                                            transform="translate(22, 30)">
                                            <defs id="SvgjsDefs2061">
                                                <linearGradient id="SvgjsLinearGradient2065" x1="0" y1="0" x2="0"
                                                    y2="1">
                                                    <stop id="SvgjsStop2066" stop-opacity="0.4"
                                                        stop-color="rgba(216,227,240,0.4)" offset="0"></stop>
                                                    <stop id="SvgjsStop2067" stop-opacity="0.5"
                                                        stop-color="rgba(190,209,230,0.5)" offset="1"></stop>
                                                    <stop id="SvgjsStop2068" stop-opacity="0.5"
                                                        stop-color="rgba(190,209,230,0.5)" offset="1"></stop>
                                                </linearGradient>
                                                <clipPath id="gridRectMaskzd9y70cq">
                                                    <rect id="SvgjsRect2070" width="410" height="112.34800000000001"
                                                        x="-2" y="0" rx="0" ry="0" opacity="1" stroke-width="0"
                                                        stroke="none" stroke-dasharray="0" fill="#fff"></rect>
                                                </clipPath>
                                                <clipPath id="gridRectMarkerMaskzd9y70cq">
                                                    <rect id="SvgjsRect2071" width="410" height="116.34800000000001"
                                                        x="-2" y="-2" rx="0" ry="0" opacity="1" stroke-width="0"
                                                        stroke="none" stroke-dasharray="0" fill="#fff"></rect>
                                                </clipPath>
                                            </defs>
                                            <rect id="SvgjsRect2069" width="20.3" height="112.34800000000001" x="0"
                                                y="0" rx="0" ry="0" opacity="1" stroke-width="0" stroke-dasharray="3"
                                                fill="url(#SvgjsLinearGradient2065)" class="apexcharts-xcrosshairs"
                                                y2="112.34800000000001" filter="none" fill-opacity="0.9"></rect>
                                            <g id="SvgjsG2110" class="apexcharts-xaxis" transform="translate(0, 0)">
                                                <g id="SvgjsG2111" class="apexcharts-xaxis-texts-g"
                                                    transform="translate(0, -4)"><text id="SvgjsText2113"
                                                        font-family="Helvetica, Arial, sans-serif" x="29" y="141.348"
                                                        text-anchor="middle" dominant-baseline="auto" font-size="12px"
                                                        font-weight="400" fill="rgba(255,255,255,55%)"
                                                        class="apexcharts-text apexcharts-xaxis-label "
                                                        style="font-family: Helvetica, Arial, sans-serif;">
                                                        <tspan id="SvgjsTspan2114">Mon</tspan>
                                                        <title>Mon</title>
                                                    </text><text id="SvgjsText2116"
                                                        font-family="Helvetica, Arial, sans-serif" x="87" y="141.348"
                                                        text-anchor="middle" dominant-baseline="auto" font-size="12px"
                                                        font-weight="400" fill="rgba(255,255,255,55%)"
                                                        class="apexcharts-text apexcharts-xaxis-label "
                                                        style="font-family: Helvetica, Arial, sans-serif;">
                                                        <tspan id="SvgjsTspan2117">Tue</tspan>
                                                        <title>Tue</title>
                                                    </text><text id="SvgjsText2119"
                                                        font-family="Helvetica, Arial, sans-serif" x="145" y="141.348"
                                                        text-anchor="middle" dominant-baseline="auto" font-size="12px"
                                                        font-weight="400" fill="rgba(255,255,255,55%)"
                                                        class="apexcharts-text apexcharts-xaxis-label "
                                                        style="font-family: Helvetica, Arial, sans-serif;">
                                                        <tspan id="SvgjsTspan2120">Wed</tspan>
                                                        <title>Wed</title>
                                                    </text><text id="SvgjsText2122"
                                                        font-family="Helvetica, Arial, sans-serif" x="203" y="141.348"
                                                        text-anchor="middle" dominant-baseline="auto" font-size="12px"
                                                        font-weight="400" fill="rgba(255,255,255,55%)"
                                                        class="apexcharts-text apexcharts-xaxis-label "
                                                        style="font-family: Helvetica, Arial, sans-serif;">
                                                        <tspan id="SvgjsTspan2123">Thu</tspan>
                                                        <title>Thu</title>
                                                    </text><text id="SvgjsText2125"
                                                        font-family="Helvetica, Arial, sans-serif" x="261" y="141.348"
                                                        text-anchor="middle" dominant-baseline="auto" font-size="12px"
                                                        font-weight="400" fill="rgba(255,255,255,55%)"
                                                        class="apexcharts-text apexcharts-xaxis-label "
                                                        style="font-family: Helvetica, Arial, sans-serif;">
                                                        <tspan id="SvgjsTspan2126">Fri</tspan>
                                                        <title>Fri</title>
                                                    </text><text id="SvgjsText2128"
                                                        font-family="Helvetica, Arial, sans-serif" x="319" y="141.348"
                                                        text-anchor="middle" dominant-baseline="auto" font-size="12px"
                                                        font-weight="400" fill="rgba(255,255,255,55%)"
                                                        class="apexcharts-text apexcharts-xaxis-label "
                                                        style="font-family: Helvetica, Arial, sans-serif;">
                                                        <tspan id="SvgjsTspan2129">Fri</tspan>
                                                        <title>Fri</title>
                                                    </text><text id="SvgjsText2131"
                                                        font-family="Helvetica, Arial, sans-serif" x="377" y="141.348"
                                                        text-anchor="middle" dominant-baseline="auto" font-size="12px"
                                                        font-weight="400" fill="rgba(255,255,255,55%)"
                                                        class="apexcharts-text apexcharts-xaxis-label "
                                                        style="font-family: Helvetica, Arial, sans-serif;">
                                                        <tspan id="SvgjsTspan2132">Sun</tspan>
                                                        <title>Sun</title>
                                                    </text></g>
                                            </g>
                                            <g id="SvgjsG2135" class="apexcharts-grid">
                                                <g id="SvgjsG2136" class="apexcharts-gridlines-horizontal"
                                                    style="display: none;">
                                                    <line id="SvgjsLine2138" x1="0" y1="0" x2="406" y2="0"
                                                        stroke="#e0e0e0" stroke-dasharray="0"
                                                        class="apexcharts-gridline"></line>
                                                    <line id="SvgjsLine2139" x1="0" y1="28.087000000000003" x2="406"
                                                        y2="28.087000000000003" stroke="#e0e0e0" stroke-dasharray="0"
                                                        class="apexcharts-gridline"></line>
                                                    <line id="SvgjsLine2140" x1="0" y1="56.17400000000001" x2="406"
                                                        y2="56.17400000000001" stroke="#e0e0e0" stroke-dasharray="0"
                                                        class="apexcharts-gridline"></line>
                                                    <line id="SvgjsLine2141" x1="0" y1="84.26100000000001" x2="406"
                                                        y2="84.26100000000001" stroke="#e0e0e0" stroke-dasharray="0"
                                                        class="apexcharts-gridline"></line>
                                                    <line id="SvgjsLine2142" x1="0" y1="112.34800000000001" x2="406"
                                                        y2="112.34800000000001" stroke="#e0e0e0" stroke-dasharray="0"
                                                        class="apexcharts-gridline"></line>
                                                </g>
                                                <g id="SvgjsG2137" class="apexcharts-gridlines-vertical"
                                                    style="display: none;"></g>
                                                <line id="SvgjsLine2144" x1="0" y1="112.34800000000001" x2="406"
                                                    y2="112.34800000000001" stroke="transparent" stroke-dasharray="0">
                                                </line>
                                                <line id="SvgjsLine2143" x1="0" y1="1" x2="0" y2="112.34800000000001"
                                                    stroke="transparent" stroke-dasharray="0"></line>
                                            </g>
                                            <g id="SvgjsG2072" class="apexcharts-bar-series apexcharts-plot-series">
                                                <g id="SvgjsG2073" class="apexcharts-series" rel="1" seriesName="Sales"
                                                    data:realIndex="0">
                                                    <path id="SvgjsPath2075"
                                                        d="M 18.85 112.34800000000001L 18.85 24.724666666666664Q 18.85 18.724666666666664 24.85 18.724666666666664L 33.150000000000006 18.724666666666664Q 39.150000000000006 18.724666666666664 39.150000000000006 24.724666666666664L 39.150000000000006 24.724666666666664L 39.150000000000006 112.34800000000001L 39.150000000000006 112.34800000000001z"
                                                        fill="rgba(255,255,255,60%)" fill-opacity="1" stroke-opacity="1"
                                                        stroke-linecap="round" stroke-width="0" stroke-dasharray="0"
                                                        class="apexcharts-bar-area" index="0"
                                                        clip-path="url(#gridRectMaskzd9y70cq)"
                                                        pathTo="M 18.85 112.34800000000001L 18.85 24.724666666666664Q 18.85 18.724666666666664 24.85 18.724666666666664L 33.150000000000006 18.724666666666664Q 39.150000000000006 18.724666666666664 39.150000000000006 24.724666666666664L 39.150000000000006 24.724666666666664L 39.150000000000006 112.34800000000001L 39.150000000000006 112.34800000000001z"
                                                        pathFrom="M 18.85 112.34800000000001L 18.85 112.34800000000001L 39.150000000000006 112.34800000000001L 39.150000000000006 112.34800000000001L 39.150000000000006 112.34800000000001L 39.150000000000006 112.34800000000001L 39.150000000000006 112.34800000000001L 18.85 112.34800000000001"
                                                        cy="18.724666666666664" cx="76.85" j="0" val="30"
                                                        barHeight="93.62333333333335" barWidth="20.3"></path>
                                                    <path id="SvgjsPath2080"
                                                        d="M 76.85 112.34800000000001L 76.85 40.32855555555557Q 76.85 34.32855555555557 82.85 34.32855555555557L 91.14999999999999 34.32855555555557Q 97.14999999999999 34.32855555555557 97.14999999999999 40.32855555555557L 97.14999999999999 40.32855555555557L 97.14999999999999 112.34800000000001L 97.14999999999999 112.34800000000001z"
                                                        fill="rgba(255,255,255,60%)" fill-opacity="1" stroke-opacity="1"
                                                        stroke-linecap="round" stroke-width="0" stroke-dasharray="0"
                                                        class="apexcharts-bar-area" index="0"
                                                        clip-path="url(#gridRectMaskzd9y70cq)"
                                                        pathTo="M 76.85 112.34800000000001L 76.85 40.32855555555557Q 76.85 34.32855555555557 82.85 34.32855555555557L 91.14999999999999 34.32855555555557Q 97.14999999999999 34.32855555555557 97.14999999999999 40.32855555555557L 97.14999999999999 40.32855555555557L 97.14999999999999 112.34800000000001L 97.14999999999999 112.34800000000001z"
                                                        pathFrom="M 76.85 112.34800000000001L 76.85 112.34800000000001L 97.14999999999999 112.34800000000001L 97.14999999999999 112.34800000000001L 97.14999999999999 112.34800000000001L 97.14999999999999 112.34800000000001L 97.14999999999999 112.34800000000001L 76.85 112.34800000000001"
                                                        cy="34.32855555555557" cx="134.85" j="1" val="25"
                                                        barHeight="78.01944444444445" barWidth="20.3"></path>
                                                    <path id="SvgjsPath2085"
                                                        d="M 134.85 112.34800000000001L 134.85 9.120777777777775Q 134.85 3.120777777777775 140.85 3.120777777777775L 149.15 3.120777777777775Q 155.15 3.120777777777775 155.15 9.120777777777775L 155.15 9.120777777777775L 155.15 112.34800000000001L 155.15 112.34800000000001z"
                                                        fill="rgba(255,255,255,60%)" fill-opacity="1" stroke-opacity="1"
                                                        stroke-linecap="round" stroke-width="0" stroke-dasharray="0"
                                                        class="apexcharts-bar-area" index="0"
                                                        clip-path="url(#gridRectMaskzd9y70cq)"
                                                        pathTo="M 134.85 112.34800000000001L 134.85 9.120777777777775Q 134.85 3.120777777777775 140.85 3.120777777777775L 149.15 3.120777777777775Q 155.15 3.120777777777775 155.15 9.120777777777775L 155.15 9.120777777777775L 155.15 112.34800000000001L 155.15 112.34800000000001z"
                                                        pathFrom="M 134.85 112.34800000000001L 134.85 112.34800000000001L 155.15 112.34800000000001L 155.15 112.34800000000001L 155.15 112.34800000000001L 155.15 112.34800000000001L 155.15 112.34800000000001L 134.85 112.34800000000001"
                                                        cy="3.120777777777775" cx="192.85" j="2" val="35"
                                                        barHeight="109.22722222222224" barWidth="20.3"></path>
                                                    <path id="SvgjsPath2090"
                                                        d="M 192.85 112.34800000000001L 192.85 40.32855555555557Q 192.85 34.32855555555557 198.85 34.32855555555557L 207.15 34.32855555555557Q 213.15 34.32855555555557 213.15 40.32855555555557L 213.15 40.32855555555557L 213.15 112.34800000000001L 213.15 112.34800000000001z"
                                                        fill="rgba(255,255,255,60%)" fill-opacity="1" stroke-opacity="1"
                                                        stroke-linecap="round" stroke-width="0" stroke-dasharray="0"
                                                        class="apexcharts-bar-area" index="0"
                                                        clip-path="url(#gridRectMaskzd9y70cq)"
                                                        pathTo="M 192.85 112.34800000000001L 192.85 40.32855555555557Q 192.85 34.32855555555557 198.85 34.32855555555557L 207.15 34.32855555555557Q 213.15 34.32855555555557 213.15 40.32855555555557L 213.15 40.32855555555557L 213.15 112.34800000000001L 213.15 112.34800000000001z"
                                                        pathFrom="M 192.85 112.34800000000001L 192.85 112.34800000000001L 213.15 112.34800000000001L 213.15 112.34800000000001L 213.15 112.34800000000001L 213.15 112.34800000000001L 213.15 112.34800000000001L 192.85 112.34800000000001"
                                                        cy="34.32855555555557" cx="250.85" j="3" val="25"
                                                        barHeight="78.01944444444445" barWidth="20.3"></path>
                                                    <path id="SvgjsPath2095"
                                                        d="M 250.85 112.34800000000001L 250.85 9.120777777777775Q 250.85 3.120777777777775 256.85 3.120777777777775L 265.15 3.120777777777775Q 271.15 3.120777777777775 271.15 9.120777777777775L 271.15 9.120777777777775L 271.15 112.34800000000001L 271.15 112.34800000000001z"
                                                        fill="rgba(255,255,255,60%)" fill-opacity="1" stroke-opacity="1"
                                                        stroke-linecap="round" stroke-width="0" stroke-dasharray="0"
                                                        class="apexcharts-bar-area" index="0"
                                                        clip-path="url(#gridRectMaskzd9y70cq)"
                                                        pathTo="M 250.85 112.34800000000001L 250.85 9.120777777777775Q 250.85 3.120777777777775 256.85 3.120777777777775L 265.15 3.120777777777775Q 271.15 3.120777777777775 271.15 9.120777777777775L 271.15 9.120777777777775L 271.15 112.34800000000001L 271.15 112.34800000000001z"
                                                        pathFrom="M 250.85 112.34800000000001L 250.85 112.34800000000001L 271.15 112.34800000000001L 271.15 112.34800000000001L 271.15 112.34800000000001L 271.15 112.34800000000001L 271.15 112.34800000000001L 250.85 112.34800000000001"
                                                        cy="3.120777777777775" cx="308.85" j="4" val="35"
                                                        barHeight="109.22722222222224" barWidth="20.3"></path>
                                                    <path id="SvgjsPath2100"
                                                        d="M 308.85 112.34800000000001L 308.85 55.93244444444445Q 308.85 49.93244444444445 314.85 49.93244444444445L 323.15000000000003 49.93244444444445Q 329.15000000000003 49.93244444444445 329.15000000000003 55.93244444444445L 329.15000000000003 55.93244444444445L 329.15000000000003 112.34800000000001L 329.15000000000003 112.34800000000001z"
                                                        fill="rgba(255,255,255,60%)" fill-opacity="1" stroke-opacity="1"
                                                        stroke-linecap="round" stroke-width="0" stroke-dasharray="0"
                                                        class="apexcharts-bar-area" index="0"
                                                        clip-path="url(#gridRectMaskzd9y70cq)"
                                                        pathTo="M 308.85 112.34800000000001L 308.85 55.93244444444445Q 308.85 49.93244444444445 314.85 49.93244444444445L 323.15000000000003 49.93244444444445Q 329.15000000000003 49.93244444444445 329.15000000000003 55.93244444444445L 329.15000000000003 55.93244444444445L 329.15000000000003 112.34800000000001L 329.15000000000003 112.34800000000001z"
                                                        pathFrom="M 308.85 112.34800000000001L 308.85 112.34800000000001L 329.15000000000003 112.34800000000001L 329.15000000000003 112.34800000000001L 329.15000000000003 112.34800000000001L 329.15000000000003 112.34800000000001L 329.15000000000003 112.34800000000001L 308.85 112.34800000000001"
                                                        cy="49.93244444444445" cx="366.85" j="5" val="20"
                                                        barHeight="62.415555555555564" barWidth="20.3"></path>
                                                    <path id="SvgjsPath2105"
                                                        d="M 366.85 112.34800000000001L 366.85 24.724666666666664Q 366.85 18.724666666666664 372.85 18.724666666666664L 381.15000000000003 18.724666666666664Q 387.15000000000003 18.724666666666664 387.15000000000003 24.724666666666664L 387.15000000000003 24.724666666666664L 387.15000000000003 112.34800000000001L 387.15000000000003 112.34800000000001z"
                                                        fill="rgba(255,255,255,60%)" fill-opacity="1" stroke-opacity="1"
                                                        stroke-linecap="round" stroke-width="0" stroke-dasharray="0"
                                                        class="apexcharts-bar-area" index="0"
                                                        clip-path="url(#gridRectMaskzd9y70cq)"
                                                        pathTo="M 366.85 112.34800000000001L 366.85 24.724666666666664Q 366.85 18.724666666666664 372.85 18.724666666666664L 381.15000000000003 18.724666666666664Q 387.15000000000003 18.724666666666664 387.15000000000003 24.724666666666664L 387.15000000000003 24.724666666666664L 387.15000000000003 112.34800000000001L 387.15000000000003 112.34800000000001z"
                                                        pathFrom="M 366.85 112.34800000000001L 366.85 112.34800000000001L 387.15000000000003 112.34800000000001L 387.15000000000003 112.34800000000001L 387.15000000000003 112.34800000000001L 387.15000000000003 112.34800000000001L 387.15000000000003 112.34800000000001L 366.85 112.34800000000001"
                                                        cy="18.724666666666664" cx="424.85" j="6" val="30"
                                                        barHeight="93.62333333333335" barWidth="20.3"></path>
                                                </g>
                                                <g id="SvgjsG2074" class="apexcharts-datalabels" data:realIndex="0">
                                                    <g id="SvgjsG2077" class="apexcharts-data-labels"
                                                        transform="rotate(0)"><text id="SvgjsText2079"
                                                            font-family="Helvetica, Arial, sans-serif"
                                                            x="28.999999999999993" y="12.724666666666664"
                                                            text-anchor="middle" dominant-baseline="auto"
                                                            font-size="12px" font-weight="600"
                                                            fill="rgba(255,255,255,55%)" class="apexcharts-datalabel"
                                                            cx="28.999999999999993" cy="12.724666666666664"
                                                            style="font-family: Helvetica, Arial, sans-serif;">$30</text>
                                                    </g>
                                                    <g id="SvgjsG2082" class="apexcharts-data-labels"
                                                        transform="rotate(0)"><text id="SvgjsText2084"
                                                            font-family="Helvetica, Arial, sans-serif" x="87"
                                                            y="28.328555555555567" text-anchor="middle"
                                                            dominant-baseline="auto" font-size="12px" font-weight="600"
                                                            fill="rgba(255,255,255,55%)" class="apexcharts-datalabel"
                                                            cx="87" cy="28.328555555555567"
                                                            style="font-family: Helvetica, Arial, sans-serif;">$25</text>
                                                    </g>
                                                    <g id="SvgjsG2087" class="apexcharts-data-labels"
                                                        transform="rotate(0)"><text id="SvgjsText2089"
                                                            font-family="Helvetica, Arial, sans-serif" x="145" y="0"
                                                            text-anchor="middle" dominant-baseline="auto"
                                                            font-size="12px" font-weight="600"
                                                            fill="rgba(255,255,255,55%)" class="apexcharts-datalabel"
                                                            cx="145" cy="0"
                                                            style="font-family: Helvetica, Arial, sans-serif;">$35</text>
                                                    </g>
                                                    <g id="SvgjsG2092" class="apexcharts-data-labels"
                                                        transform="rotate(0)"><text id="SvgjsText2094"
                                                            font-family="Helvetica, Arial, sans-serif" x="203"
                                                            y="28.328555555555567" text-anchor="middle"
                                                            dominant-baseline="auto" font-size="12px" font-weight="600"
                                                            fill="rgba(255,255,255,55%)" class="apexcharts-datalabel"
                                                            cx="203" cy="28.328555555555567"
                                                            style="font-family: Helvetica, Arial, sans-serif;">$25</text>
                                                    </g>
                                                    <g id="SvgjsG2097" class="apexcharts-data-labels"
                                                        transform="rotate(0)"><text id="SvgjsText2099"
                                                            font-family="Helvetica, Arial, sans-serif" x="261" y="0"
                                                            text-anchor="middle" dominant-baseline="auto"
                                                            font-size="12px" font-weight="600"
                                                            fill="rgba(255,255,255,55%)" class="apexcharts-datalabel"
                                                            cx="261" cy="0"
                                                            style="font-family: Helvetica, Arial, sans-serif;">$35</text>
                                                    </g>
                                                    <g id="SvgjsG2102" class="apexcharts-data-labels"
                                                        transform="rotate(0)"><text id="SvgjsText2104"
                                                            font-family="Helvetica, Arial, sans-serif" x="319"
                                                            y="43.93244444444445" text-anchor="middle"
                                                            dominant-baseline="auto" font-size="12px" font-weight="600"
                                                            fill="rgba(255,255,255,55%)" class="apexcharts-datalabel"
                                                            cx="319" cy="43.93244444444445"
                                                            style="font-family: Helvetica, Arial, sans-serif;">$20</text>
                                                    </g>
                                                    <g id="SvgjsG2107" class="apexcharts-data-labels"
                                                        transform="rotate(0)"><text id="SvgjsText2109"
                                                            font-family="Helvetica, Arial, sans-serif" x="377"
                                                            y="12.724666666666664" text-anchor="middle"
                                                            dominant-baseline="auto" font-size="12px" font-weight="600"
                                                            fill="rgba(255,255,255,55%)" class="apexcharts-datalabel"
                                                            cx="377" cy="12.724666666666664"
                                                            style="font-family: Helvetica, Arial, sans-serif;">$30</text>
                                                    </g>
                                                </g>
                                            </g>
                                            <line id="SvgjsLine2145" x1="0" y1="0" x2="406" y2="0" stroke="#b6b6b6"
                                                stroke-dasharray="0" stroke-width="1" class="apexcharts-ycrosshairs">
                                            </line>
                                            <line id="SvgjsLine2146" x1="0" y1="0" x2="406" y2="0" stroke-dasharray="0"
                                                stroke-width="0" class="apexcharts-ycrosshairs-hidden"></line>
                                            <g id="SvgjsG2147" class="apexcharts-yaxis-annotations"></g>
                                            <g id="SvgjsG2148" class="apexcharts-xaxis-annotations"></g>
                                            <g id="SvgjsG2149" class="apexcharts-point-annotations"></g>
                                        </g>
                                        <g id="SvgjsG2133" class="apexcharts-yaxis" rel="0"
                                            transform="translate(-8, 0)">
                                            <g id="SvgjsG2134" class="apexcharts-yaxis-texts-g"></g>
                                        </g>
                                        <g id="SvgjsG2063" class="apexcharts-annotations"></g>
                                    </svg>
                                    <div class="apexcharts-legend" style="max-height: 90px;"></div>
                                    <div class="apexcharts-tooltip apexcharts-theme-light">
                                        <div class="apexcharts-tooltip-title"
                                            style="font-family: Helvetica, Arial, sans-serif; font-size: 12px;"></div>
                                        <div class="apexcharts-tooltip-series-group" style="order: 1;"><span
                                                class="apexcharts-tooltip-marker"
                                                style="background-color: rgba(255, 255, 255, 0.6);"></span>
                                            <div class="apexcharts-tooltip-text"
                                                style="font-family: Helvetica, Arial, sans-serif; font-size: 12px;">
                                                <div class="apexcharts-tooltip-y-group"><span
                                                        class="apexcharts-tooltip-text-label"></span><span
                                                        class="apexcharts-tooltip-text-value"></span></div>
                                                <div class="apexcharts-tooltip-z-group"><span
                                                        class="apexcharts-tooltip-text-z-label"></span><span
                                                        class="apexcharts-tooltip-text-z-value"></span></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div
                                        class="apexcharts-yaxistooltip apexcharts-yaxistooltip-0 apexcharts-yaxistooltip-left apexcharts-theme-light">
                                        <div class="apexcharts-yaxistooltip-text"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="resize-triggers">
                                <div class="expand-trigger">
                                    <div style="width: 487px; height: 385px;"></div>
                                </div>
                                <div class="contract-trigger"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="card widget h-100">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="card-title">
                                Your Top Countries
                                <a href="#" class="bi bi-question-circle ms-1 small" data-bs-toggle="tooltip" title=""
                                    data-bs-original-title="Sales performance revenue based by country"
                                    aria-label="Sales performance revenue based by country"></a>
                            </h5>
                            <a href="#">View All</a>
                        </div>
                        <div class="card-body">
                            <div class="list-group list-group-flush">
                                <div class="list-group-item d-flex justify-content-between align-items-center px-0">
                                    <div class="d-flex flex-grow-1 align-items-center">
                                        <img width="45" class="me-3"
                                            src="https://vetra.laborasyon.com/assets/flags/united-states-of-america.svg"
                                            alt="...">
                                        <span>United States</span>
                                    </div>
                                    <span>$1.671,10</span>
                                </div>
                                <div class="list-group-item d-flex justify-content-between align-items-center px-0">
                                    <div class="d-flex flex-grow-1 align-items-center">
                                        <img width="45" class="me-3"
                                            src="https://vetra.laborasyon.com/assets/flags/venezuela.svg" alt="...">
                                        <span>Venezuela</span>
                                    </div>
                                    <span>$1.064,75</span>
                                </div>
                                <div class="list-group-item d-flex justify-content-between align-items-center px-0">
                                    <div class="d-flex flex-grow-1 align-items-center">
                                        <img width="45" class="me-3"
                                            src="https://vetra.laborasyon.com/assets/flags/salvador.svg" alt="...">
                                        <span>Salvador</span>
                                    </div>
                                    <span>$1.055,98</span>
                                </div>
                                <div class="list-group-item d-flex justify-content-between align-items-center px-0">
                                    <div class="d-flex flex-grow-1 align-items-center">
                                        <img width="45" class="me-3"
                                            src="https://vetra.laborasyon.com/assets/flags/russia.svg" alt="...">
                                        <span>Russia</span>
                                    </div>
                                    <span>$1.042,00</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-5 col-md-12">
                    <div class="card widget">
                        <div class="card-header">
                            <h5 class="card-title">Activity Overview</h5>
                        </div>
                        <div class="row g-4">
                            <div class="col-md-6">
                                <div class="card border-0">
                                    <div class="card-body text-center">
                                        <div class="display-5">
                                            <i class="bi bi-truck text-secondary"></i>
                                        </div>
                                        <h5 class="my-3">Delivered</h5>
                                        <div class="text-muted">15 New Packages</div>
                                        <div class="progress mt-3" style="height: 5px">
                                            <div class="progress-bar bg-secondary" role="progressbar" style="width: 25%"
                                                aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card border-0">
                                    <div class="card-body text-center">
                                        <div class="display-5">
                                            <i class="bi bi-receipt text-warning"></i>
                                        </div>
                                        <h5 class="my-3">Ordered</h5>
                                        <div class="text-muted">72 New Items</div>
                                        <div class="progress mt-3" style="height: 5px">
                                            <div class="progress-bar bg-warning" role="progressbar" style="width: 67%"
                                                aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card border-0">
                                    <div class="card-body text-center">
                                        <div class="display-5">
                                            <i class="bi bi-bar-chart text-info"></i>
                                        </div>
                                        <h5 class="my-3">Reported</h5>
                                        <div class="text-muted">50 Support New Cases</div>
                                        <div class="progress mt-3" style="height: 5px">
                                            <div class="progress-bar bg-info" role="progressbar" style="width: 80%"
                                                aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card border-0">
                                    <div class="card-body text-center">
                                        <div class="display-5">
                                            <i class="bi bi-cursor text-success"></i>
                                        </div>
                                        <h5 class="my-3">Arrived</h5>
                                        <div class="text-muted">34 Upgraded Boxed</div>
                                        <div class="progress mt-3" style="height: 5px">
                                            <div class="progress-bar bg-success" role="progressbar" style="width: 55%"
                                                aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
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