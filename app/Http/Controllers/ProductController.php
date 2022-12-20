<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Image;
use App\Models\Product;
use Illuminate\Support\Str;
use App\Models\ProductCategory;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Inertia::render('Admin/Products', 
        [
            'products' => Product::select('id', 'product_category_id', 'name', 'description', 'ingredients', 'created_at')->with(['product_category' => function ($query) {
                $query->select('id', 'name');
            }, 'images' => function ($query) {
                $query->select('imageable_id', 'url')->get();
            }])->withCount('product_options')->get(),
            'categories' => ProductCategory::select('id', 'name')->get() 
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreProductRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProductRequest $request)
    {
        $data = $request->validated();

        $data['slug'] = Str::slug($data['name']);
        $product = Product::create($data);
        
        //Upload Images
        $images = [];
        foreach ($request->file('images') as $imageFile) {
            $image = new Image();
            $image->url = Storage::disk('public')->put('product_images', $imageFile);
            array_push($images, $image);
        }

        $product->images()->saveMany($images);
        return response()->redirectTo('/products/'.$product->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    
    // Admin View
    public function show($subdomain, $id)
    {
        $data = Validator::make(['id' => $id], ['id' => 'required|numeric|exists:products,id'])->validated();
        $product = Product::select('id', 'product_category_id', 'name', 'description', 'ingredients', 'views', 'created_at')->where('id', $data['id'])->with(['images' => function ($query) {
            $query->select('imageable_id', 'imageable_type', 'url');
        }, 'product_category' => function ($query) {
            $query->select('id', 'name');
        }, 'product_options' => function ($query) {
            $query->select('id', 'product_id', 'variation', 'buying_price', 'selling_price', 'wholesale_price', 'wholesale_min', 'sold', 'stock');
        }, 'user_reviews' => function ($query) {
            $query->select('id', 'review', 'banned', 'created_at');
        }])->first();
        return Inertia::render('Admin/ProductView', [
            'product' => $product
        ]);
    }

    //Client View
    public function userShow ($query) { 
        $product = $this->getBySlug($query);
        return Inertia::render('Shop/ProductView', ['product' => $product]);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateProductRequest  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update($subdomain, UpdateProductRequest $request, $id)
    {
        $data = $request->validated();
        $data['id'] = Validator::make(['id' => $id], ['id' => 'required|numeric|exists:products,id'])->validated()['id'];
    
        Product::where('id', $data['id'])->update($data);
        return response()->redirectTo('/products');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy($subdomain, $id)
    {
        $id = Validator::make(['id' => $id], ['id' => 'required|numeric|exists:products,id'])->validated()['id'];
    
        Product::where('id', $id)->delete();
        return response()->redirectTo('/products');
    }

    public function search ($subdomain, $query) {
        $data = Validator::make(['query' => $query], ['query' => 'required|string'])->validated();
        return response()->json(['results' => Product::select('name', 'id')->with(['product_options' => function ($query) {
            $query->select('id', 'product_id', 'variation', 'wholesale_price');
        }])->where('name', 'like', '%'.$data['query'].'%')->get()]);
    }

    private function getBySlug ($slug, $distributor = false) {
        $data = Validator::make(['slug' => $slug], ['slug' => 'required|string'])->validated();
        return Product::where('slug', $data['slug'])->with(['images' => function ($query) {
            $query->select('imageable_id', 'url');
        }, 'product_category' => function ($query) {
            $query->select('id', 'name');
        }, 'product_options' => function ($query) use ($distributor) {
            $distributor ? $query->select('product_id', 'variation', 'wholesale_price as price') : $query->select('product_id', 'variation', 'selling_price as price');
        }])->first();
    }
}
