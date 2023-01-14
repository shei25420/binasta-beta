<?php

namespace App\Http\Controllers;

use App\Helpers\Billing;
use App\Models\Payout;
use App\Http\Requests\StorePayoutRequest;
use App\Http\Requests\UpdatePayoutRequest;

class PayoutController extends Controller
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
     * @param  \App\Http\Requests\StorePayoutRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePayoutRequest $request)
    {
        $gateway =  (new Billing())->payment_gateway("mpesa");
        $gateway->process_payout(["amount" => 1]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Payout  $payout
     * @return \Illuminate\Http\Response
     */
    public function show(Payout $payout)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Payout  $payout
     * @return \Illuminate\Http\Response
     */
    public function edit(Payout $payout)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePayoutRequest  $request
     * @param  \App\Models\Payout  $payout
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePayoutRequest $request, Payout $payout)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Payout  $payout
     * @return \Illuminate\Http\Response
     */
    public function destroy(Payout $payout)
    {
        //
    }
}
