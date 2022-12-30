<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DistributorOrder;
use App\Models\ProductCategory;
use Inertia\Inertia;

class DistributorShopController extends Controller
{
    public function shop () {
        $orders = DistributorOrder::with(["distributor_packages" => function ($query) {
            $query->select("distributor_packages.id");
        }, "distributor_packages.productOptions" => function ($query) {
            $query->select("distributor_package_id", "variation", "buying_price as price", "product_id")->distinct()->first();
        }, "distributor_packages.productOptions.product" => function ($query) {
            $query->select("id", "name");
        }])->get();

        $categories = ProductCategory::select("id", "name")->get();
        dd($orders);;
        return Inertia::render("DistributorDashboard/Shop", ["categories" => $categories, "productOptions" => $productOptions]);
    }
}
