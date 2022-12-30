<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDistributorTransactionRequest;
use App\Http\Requests\UpdateDistributorTransactionRequest;
use App\Models\DistributorTransaction;

class DistributorTransactionController extends Controller
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
     * @param  \App\Http\Requests\StoreDistributorTransactionRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreDistributorTransactionRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\DistributorTransaction  $distributorTransaction
     * @return \Illuminate\Http\Response
     */
    public function show(DistributorTransaction $distributorTransaction)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\DistributorTransaction  $distributorTransaction
     * @return \Illuminate\Http\Response
     */
    public function edit(DistributorTransaction $distributorTransaction)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateDistributorTransactionRequest  $request
     * @param  \App\Models\DistributorTransaction  $distributorTransaction
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateDistributorTransactionRequest $request, DistributorTransaction $distributorTransaction)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\DistributorTransaction  $distributorTransaction
     * @return \Illuminate\Http\Response
     */
    public function destroy(DistributorTransaction $distributorTransaction)
    {
        //
    }
}
