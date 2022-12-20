<?php

namespace App\Http\Controllers;

use App\Models\Discount;
use App\Http\Requests\StoreDiscountRequest;
use App\Http\Requests\UpdateDiscountRequest;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use Inertia\Inertia;

class DiscountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Inertia::render('Admin/Discounts', ['discounts' => Discount::select('id', 'product_id', 'percentage', 'active', 'start_date', 'end_date', 'created_at')->with(['product' => function ($query) {
            $query->select('id', 'name');
        }])->get()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreDiscountRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreDiscountRequest $request)
    {
        $data = $request->validated();
        
        $data['start_date'] = new Carbon($data['start_date']);
        $data['end_date'] = new Carbon($data['end_date']);

        Discount::create($data);
        return response()->redirectTo('/discounts');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateDiscountRequest  $request
     * @param  \App\Models\Discount  $discount
     * @return \Illuminate\Http\Response
     */
    public function update($subdomain, UpdateDiscountRequest $request, $id)
    {
        $data = $request->validated();
        $data['id'] = Validator::make(['id' => $id], ['id' => 'required|numeric|exists:discounts,id'])->validated()['id'];
    
        Discount::where('id', $data['id'])->update($data);
        return response()->redirectTo('/discounts');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Discount  $discount
     * @return \Illuminate\Http\Response
     */
    public function destroy($subdomain, $id)
    {
        $id = Validator::make(['id' => $id], ['id' => 'required|numeric|exists:discounts,id'])->validated()['id'];
        Discount::where('id', $id)->delete();

        return response()->redirectTo('/discounts');
    }
}
