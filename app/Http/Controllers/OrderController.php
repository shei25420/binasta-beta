<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Order;
use Illuminate\Support\Str;
use App\Http\Requests\StoreOrderRequest;
use App\Http\Requests\UpdateOrderRequest;
use App\Models\ProductOption;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Inertia::render('Admin/Orders', [
            'orders' => Order::select('id', 'user_id', 'user_address_id', 'location', 'phone_number', 'status', 'created_at')->with(['user' => function ($query) {
                $query->select('id', 'email');
            }, 'product_options' => function ($query) {
                $query->select('id', 'buying_price');
            }, 'user_address' => function ($query) {
                $query->select('id', 'location', 'phone_number');
            }])->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Inertia::render('Admin/NewOrder');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreOrderRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreOrderRequest $request)
    {
        $data = $request->validated();
        $data['user_id'] = auth()->id();
        
        $ref = Str::random(8);
        while(Order::where('ref', $ref)->exists()) $ref = Str::random(8);
        $data['ref'] = $ref;
        
        $total_amount = 0;
        foreach ($data["product_options"] as $option) {
            $opt = ProductOption::find($option["id"]);
            $total_amount += $opt->selling_price * $option["qty"];
        }

        $data["amount"] = $total_amount;
        $order = Order::create($data);
        
        foreach ($data['product_options'] as $option) {
            $order->product_options()->attach([$option["id"] => ['quantity' => $option["qty"]]]);
        }

        return response()->redirectTo('/invoice/'.$data['ref']); 
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateOrderRequest  $request
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateOrderRequest $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        //
    }
}
