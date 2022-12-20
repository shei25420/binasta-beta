<?php

namespace App\Http\Controllers;

use App\Models\MainSubscriber;
use App\Http\Requests\StoreMainSubscriberRequest;
use App\Http\Requests\UpdateMainSubscriberRequest;

class MainSubscriberController extends Controller
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
     * @param  \App\Http\Requests\StoreMainSubscriberRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreMainSubscriberRequest $request)
    {
        MainSubscriber::create($request->validated());
        return response()->json(['status' => 1]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\MainSubscriber  $mainSubscriber
     * @return \Illuminate\Http\Response
     */
    public function show(MainSubscriber $mainSubscriber)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\MainSubscriber  $mainSubscriber
     * @return \Illuminate\Http\Response
     */
    public function edit(MainSubscriber $mainSubscriber)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateMainSubscriberRequest  $request
     * @param  \App\Models\MainSubscriber  $mainSubscriber
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateMainSubscriberRequest $request, MainSubscriber $mainSubscriber)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MainSubscriber  $mainSubscriber
     * @return \Illuminate\Http\Response
     */
    public function destroy(MainSubscriber $mainSubscriber)
    {
        //
    }
}
