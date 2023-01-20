<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Illuminate\Support\Str;
use App\Models\ProductOption;
use App\Models\DistributorPackage;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\StoreDistributorPackageRequest;
use App\Http\Requests\UpdateDistributorPackageRequest;

class DistributorPackageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Inertia::render('Admin/DistributorPackages', [
            'packages' => DistributorPackage::select('id', 'name', 'description', 'image_path', 'created_at')->with(['productOptions' => function ($query) {
                $query->select('product_options.id', 'product_id', 'variation', 'wholesale_price');
            }])->get(),
            'product_options' => ProductOption::select('id', 'product_id', 'variation', 'wholesale_min', 'wholesale_price')->with(['product' => function ($query) {
                $query->select('id', 'name');
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
     * @param  \App\Http\Requests\StoreDistributorPackageRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreDistributorPackageRequest $request)
    {
        $data = $request->validated();

        $data['slug'] = Str::slug($data['name']);

        $data["image_path"] = Storage::disk('public')->put('product_images', $request->file('image'));

        $package = DistributorPackage::create($data);

        $package->productOptions()->attach($data['product_options']);

        return response()->redirectTo('/distributor_packages');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\DistributorPackage  $distributorPackage
     * @return \Illuminate\Http\Response
     */
    public function show(DistributorPackage $distributorPackage)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\DistributorPackage  $distributorPackage
     * @return \Illuminate\Http\Response
     */
    public function edit(DistributorPackage $distributorPackage)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateDistributorPackageRequest  $request
     * @param  \App\Models\DistributorPackage  $distributorPackage
     * @return \Illuminate\Http\Response
     */
    public function update($subdomain, UpdateDistributorPackageRequest $request, $id)
    {
        $data = $request->validated();
        $data['id'] = Validator::make(['id' => $id], ['id' => 'required|numeric|exists:distributor_packages,id'])->validated()['id'];
        
        $product_options = $data['product_options'];
        unset($data['product_options']);
    
        $package = DistributorPackage::where('id', $data['id'])->first();
        
        $package->productOptions()->sync($product_options);
        $package->update($data);  
        return response()->redirectTo('/distributor_packages');  
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\DistributorPackage  $distributorPackage
     * @return \Illuminate\Http\Response
     */
    public function destroy($subdomain, $id)
    {
        $id = Validator::make(['id' => $id], ['id' => 'required|numeric|exists:distributor_packages,id'])->validated()['id'];

        DistributorPackage::where('id', $id)->delete();
        return response()->redirectTo('/distributor_packages');
    }

    public function search ($subdomain, $query) {
        $data = Validator::make(['query' => $query], ['query' => 'string|required'])->validated();

        $packages = DistributorPackage::select("id", "name")->where("name", "LIKE", "%".$data["query"]."%")->get();
        return response()->json(["results" => $packages]);
    }
}
