<?php

namespace App\Http\Controllers;

use App\Models\DistributorOrder;
use App\Http\Requests\StoreDistributorOrderRequest;
use App\Http\Requests\UpdateDistributorOrderRequest;
use Inertia\Inertia;

class DistributorOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Inertia::render('Admin/DistributorOrders', ['orders' => DistributorOrder::with(['distributor' => function ($query) {
            $query->select('id', 'first_name', 'last_name');
        }, 'distributor_address' => function ($query) {
            $query->select('id', 'location', 'phone_number');
        }, 'distributor_packages' => function ($query) {
            $query->select('distributor_packages.id', 'name')->withCount('productOptions');
        }])->get()]);
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
     * @param  \App\Http\Requests\StoreDistributorOrderRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreDistributorOrderRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\DistributorOrder  $distributorOrder
     * @return \Illuminate\Http\Response
     */
    public function show(DistributorOrder $distributorOrder)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\DistributorOrder  $distributorOrder
     * @return \Illuminate\Http\Response
     */
    public function edit(DistributorOrder $distributorOrder)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateDistributorOrderRequest  $request
     * @param  \App\Models\DistributorOrder  $distributorOrder
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateDistributorOrderRequest $request, DistributorOrder $distributorOrder)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\DistributorOrder  $distributorOrder
     * @return \Illuminate\Http\Response
     */
    public function destroy(DistributorOrder $distributorOrder)
    {
        //
    }
}
