<?php

namespace App\Http\Controllers;

use App\Models\ProductOption;
use App\Http\Requests\StoreProductOptionRequest;
use App\Http\Requests\UpdateProductOptionRequest;
use Illuminate\Support\Facades\Validator;

class ProductOptionController extends Controller
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
     * @param  \App\Http\Requests\StoreProductOptionRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProductOptionRequest $request)
    {
        ProductOption::create($request->validated());
        return response()->redirectTo('/products/'.$request->safe()->only('product_id')['product_id']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ProductOption  $productOption
     * @return \Illuminate\Http\Response
     */
    public function show(ProductOption $productOption)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ProductOption  $productOption
     * @return \Illuminate\Http\Response
     */
    public function edit(ProductOption $productOption)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateProductOptionRequest  $request
     * @param  \App\Models\ProductOption  $productOption
     * @return \Illuminate\Http\Response
     */
    public function update($subdomain, UpdateProductOptionRequest $request, $id)
    {
        $data = $request->validated();
        $data['id'] = Validator::make(['id' => $id], ['id' => 'required|numeric|exists:product_options,id'])->validated()['id'];

        ProductOption::where('id', $data['id'])->update($data);

        return response()->redirectTo('/products/'.$data['product_id']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ProductOption  $productOption
     * @return \Illuminate\Http\Response
     */
    public function destroy($subdomain, $id)
    {
        $id = Validator::make(['id' => $id], ['id' => 'required|numeric|exists:product_options,id'])->validated()['id'];
        $option = ProductOption::find($id);

        $product_id = $option->product_id;
        $option->delete();
        return response()->redirectTo('/products/'.$product_id);
    }
}
