<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDistributorDiscountRequest;
use App\Http\Requests\UpdateDistributorDiscountRequest;
use App\Models\DistributorDiscount;
use Illuminate\Support\Facades\Validator;
use Inertia\Inertia;

class DistributorDiscountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Inertia::render("Admin/DistributorDiscounts", [
            "discounts" => DistributorDiscount::select("id", "percentage", "active", "start_date", "end_date", "distributor_package_id", "created_at")->with(["distributor_package" => function ($query) {
                $query->select("id", "name");
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
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreDistributorDiscountRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreDistributorDiscountRequest $request)
    {
        $data = $request->validated();

        DistributorDiscount::create($data);
        return response()->redirectTo("/distributor_discounts");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\DistributorDiscount  $distributorDiscount
     * @return \Illuminate\Http\Response
     */
    public function show(DistributorDiscount $distributorDiscount)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\DistributorDiscount  $distributorDiscount
     * @return \Illuminate\Http\Response
     */
    public function edit(DistributorDiscount $distributorDiscount)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateDistributorDiscountRequest  $request
     * @param  \App\Models\DistributorDiscount  $distributorDiscount
     * @return \Illuminate\Http\Response
     */
    public function update($subdomain, UpdateDistributorDiscountRequest $request, $id)
    {
        $data = $request->validated();
        $data["id"] = Validator::make(["id" => $id], ["id" => "required|numeric|exists:distributor_discounts,id"])->validated()["id"];

        DistributorDiscount::where("id", $data["id"])->update($data);
        return response()->redirectTo("/distributor_discounts");
    } 

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\DistributorDiscount  $distributorDiscount
     * @return \Illuminate\Http\Response
     */
    public function destroy($subdomain, $id)
    {
        $id = Validator::make(["id" => $id], ["id" => "required|numeric|exists:distributor_discounts,id"])->validated()["id"];
        
        DistributorDiscount::where("id", $id)->delete();
        return response()->redirectTo("/distributor_discounts");
    } 

}
