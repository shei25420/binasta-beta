<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Http\Requests\StoreAdminRequest;
use App\Http\Requests\UpdateAdminRequest;
use App\Models\Blog;
use App\Models\Distributor;
use App\Models\DistributorOrder;
use App\Models\Order;
use App\Models\Product;
use App\Models\ProductOption;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $products_meta = Product::select(DB::raw("COUNT(*) as products_count, SUM(views) as product_views"))->first();
        
        $distributors_meta = Distributor::select(DB::raw("COUNT(*) as distributors_count, SUM(binapoints) as awarded_points, SUM(suspended) as suspended_count, SUM(verified) as verified_count"))->first();
        
        $product_options_meta = ProductOption::select(DB::raw("SUM(sold) as total_sold"))->first();
        
        $customers_meta = User::select(DB::raw("COUNT(*) as total_customers"))->first();
        
        $distributor_orders_meta = DistributorOrder::select(DB::raw("created_at, SUM(if(status = true, 1, 0)) as total_paid, COUNT(*) as total_orders, SUM(amount) as total_amount, MONTH(created_at) month, YEAR(created_at) year, DAY(created_at) day"))
        ->groupBy('day')
        ->get();

        $customer_orders_meta = Order::select(DB::raw("created_at, COUNT(*) as total_orders, SUM(if(status = true, 1, 0)) as total_paid, SUM(amount) as total_amount, YEAR(created_at) year, MONTH(created_at) month, DAY(created_at) day"))
        ->groupBy("day")
        ->get();

        $blog_meta = Blog::select("COUNT(*) as total_blogs");
        
        return Inertia::render("Admin/Dashboard", [
            "products_meta" => $products_meta,
            "distributors_meta" => $distributors_meta,
            "product_options_meta" => $product_options_meta,
            "customers_meta" => $customers_meta,
            "distributor_orders_meta" => $distributor_orders_meta,
            "customer_orders_meta" => $customer_orders_meta,
            "blog_meta" => $blog_meta
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreAdminRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAdminRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function show(Admin $admin)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function edit(Admin $admin)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateAdminRequest  $request
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateAdminRequest $request, Admin $admin)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function destroy(Admin $admin)
    {
        //
    }
}
