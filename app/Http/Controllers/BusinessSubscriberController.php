<?php

namespace App\Http\Controllers;

use App\Models\BusinessSubscriber;
use App\Http\Requests\StoreBusinessSubscriberRequest;
use App\Http\Requests\UpdateBusinessSubscriberRequest;

class BusinessSubscriberController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreBusinessSubscriberRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreBusinessSubscriberRequest $request)
    {
        BusinessSubscriber::create($request->validated());
        return response()->json(['status' => 1]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\BusinessSubscriber  $businessSubscriber
     * @return \Illuminate\Http\Response
     */
    public function show(BusinessSubscriber $businessSubscriber)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateBusinessSubscriberRequest  $request
     * @param  \App\Models\BusinessSubscriber  $businessSubscriber
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateBusinessSubscriberRequest $request, BusinessSubscriber $businessSubscriber)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\BusinessSubscriber  $businessSubscriber
     * @return \Illuminate\Http\Response
     */
    public function destroy(BusinessSubscriber $businessSubscriber)
    {
        //
    }
}
