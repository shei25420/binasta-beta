<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Image;
use Illuminate\Support\Str;
use App\Models\ProductCategory;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\StoreProductCategoryRequest;
use App\Http\Requests\UpdateProductCategoryRequest;
use Illuminate\Support\Facades\Validator;

class ProductCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Inertia::render('Admin/ProductCategories', [
            'categories' => ProductCategory::select('id', 'name', 'created_at')->with(['image' => function ($query) {
                $query->select('imageable_id', 'url');
            }])->withCount('products')->get()
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
     * @param  \App\Http\Requests\StoreProductCategoryRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProductCategoryRequest $request)
    {
        $data = $request->validated();
        
        $data['slug'] = Str::slug($data['name']);
        $category = ProductCategory::create($data);

        //Upload Image
        $path = Storage::disk('public')->put('product_category_images', $request->file('image_path'));
        $image = new Image();
        $image->url = $path;

        $category->image()->save($image);
        return response()->redirectTo('/product_categories');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ProductCategory  $productCategory
     * @return \Illuminate\Http\Response
     */
    public function show(ProductCategory $productCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ProductCategory  $productCategory
     * @return \Illuminate\Http\Response
     */
    public function edit(ProductCategory $productCategory)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateProductCategoryRequest  $request
     * @param  \App\Models\ProductCategory  $productCategory
     * @return \Illuminate\Http\Response
     */
    public function update($subdomain, UpdateProductCategoryRequest $request, $id)
    {
        $data = $request->validated();

        $productCategory = ProductCategory::find($id);
        $productCategory->update($data);
       
        if($request->hasFile('image_path')) {
            //Delete Previous Image
            Storage::disk('public')->delete($productCategory->image->url);
            $productCategory->image()->delete();

            //Save New Image
            $path = Storage::disk('public')->put('product_category_images', $request->file('image_path'));
            $image = new Image();
            $image->url = $path;

            $productCategory->image()->save($image);
            return response()->redirectTo('/product_categories');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ProductCategory  $productCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy($subdomain, $id)
    {
        $data = Validator::make(['id' => $id], ['id' => 'required|numeric|exists:product_categories,id'])->validated();
        $productCategory = ProductCategory::find($data['id']);
       
        Storage::disk('public')->delete($productCategory->image->url);
        $productCategory->image()->delete();
        // $productCategory->products()->productOptions()->delete
        // $productCategory->products()->delete();
        $productCategory->delete();
        return response()->redirectTo('/product_categories');
    }
}
