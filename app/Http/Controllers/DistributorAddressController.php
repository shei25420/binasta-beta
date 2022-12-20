<?php

namespace App\Http\Controllers;

use App\Models\DistributorAddress;
use App\Http\Requests\StoreDistributorAddressRequest;
use App\Http\Requests\UpdateDistributorAddressRequest;

class DistributorAddressController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreDistributorAddressRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreDistributorAddressRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\DistributorAddress  $distributorAddress
     * @return \Illuminate\Http\Response
     */
    public function show(DistributorAddress $distributorAddress)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateDistributorAddressRequest  $request
     * @param  \App\Models\DistributorAddress  $distributorAddress
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateDistributorAddressRequest $request, DistributorAddress $distributorAddress)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\DistributorAddress  $distributorAddress
     * @return \Illuminate\Http\Response
     */
    public function destroy(DistributorAddress $distributorAddress)
    {
        //
    }
}
