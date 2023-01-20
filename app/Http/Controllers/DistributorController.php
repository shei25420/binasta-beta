<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Image;
use App\Models\Tenant;
use App\Models\Country;
use App\Models\Product;
use App\Models\Distributor;
use Illuminate\Support\Str;
use App\Models\ProductOption;
use App\Models\ProductCategory;
use App\Models\DistributorOrder;
use Illuminate\Support\Facades\DB;
use App\Models\BinapointsConfiguration;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\StoreDistributorRequest;
use App\Http\Requests\UpdateDistributorRequest;
use App\Http\Requests\SuspendDistributorRequest;
use App\Http\Requests\ValidateDistributorRequest;

class DistributorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Inertia::render('Admin/Distributors', [
            'distributors' =>  Distributor::select('id', 'parent_distributor_id', 'ref', 'country_id', 'first_name', 'last_name', 'email', 'binapoints', 'gender', 'domain', 'verified', 'suspended', 'balance', 'created_at', DB::raw("COUNT(*) as total, YEAR(created_at) year, MONTH(created_at) month, DAY(created_at) day"))->with(['country' => function ($query) {
                $query->select('id', 'name');
            }, 'patron' => function ($query) {
                $query->select('id', 'first_name', 'last_name');
            }])->groupBy("day")->latest()->get(),
            'countries' => Country::select('id', 'name')->get()
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
     * @param  \App\Http\Requests\StoreDistributorRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreDistributorRequest $request)
    {
        $data = $request->validated();

        $ref = Str::random(4);
        while(Distributor::where('ref', $ref)->exists()) $ref = Str::random(4);
        $data['ref'] = $ref;

        Distributor::create($data);
        return response()->redirectTo('/distributors');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Distributor  $distributor
     * @return \Illuminate\Http\Response
     */
    public function show(Distributor $distributor)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Distributor  $distributor
     * @return \Illuminate\Http\Response
     */
    public function edit(Distributor $distributor)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateDistributorRequest  $request
     * @param  \App\Models\Distributor  $distributor
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateDistributorRequest $request, Distributor $distributor)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Distributor  $distributor
     * @return \Illuminate\Http\Response
     */
    public function destroy($subdomain, $id)
    {
        $id = Validator::make(['id' => $id], ['id' => 'required|numeric|exists:distributors,id'])->validated()['id'];
        Distributor::where('id', $id)->delete();

        return response()->redirectTo('/distributors');
    }

    public function search ($subdomain, $query) {
        $data = Validator::make(['query' => $query], ['query' => 'required|string'])->validated();
        return response()->json(Distributor::select('id', 'name', 'email')->where('name', 'LIKE', '%'.$data['query'].'%')->orWhere('email', 'LIKE', '%'.$data['query'].'%')->get());
    }

    public function fetchDistributorIdByRef ($subdomain, $ref) {
        $data = Validator::make(['ref' => $ref], ['ref' => 'required|exists:distributors,ref'])->validated();
        return response()->json(Distributor::select('id')->where('ref', $data['ref'])->first());
    }

    public function suspend (SuspendDistributorRequest $request) {
        $data = $request->validated();

        Distributor::where('id', $data['distributor_id'])->update(['suspended' => true]);
        return response()->redirectTo('/distributors');
    }

    public function verify (ValidateDistributorRequest $request) {
        $data = $request->validated();

        $distributor = Distributor::with(["orders" => function ($query) {
            $query->select("id", "distributor_id")->where("status", 1);
        }, "orders.distributor_packages" => function ($query) {
            $query->select("distributor_packages.id");
        }, "orders.distributor_packages.productOptions" => function ($query) {
            $query->select("product_options.id", "product_id", "variation", "wholesale_price", "selling_price", "wholesale_min");
        }, "orders.distributor_packages.productOptions.product" => function ($query) {
            $query->select("id", "name", "product_category_id", "description", "ingredients");
        }, "orders.distributor_packages.productOptions.product.product_category" => function ($query) {
            $query->select("id", "name");
        }, "orders.distributor_packages.productOptions.product.product_category.image" => function ($query) {
            $query->select("imageable_id", "url");
        }, "orders.distributor_packages.productOptions.product.images" => function ($query) {
            $query->select("imageable_id", "url");
        }])->where("id", $data["distributor_id"])->first();

        $distributor_orders = $distributor->orders;

        $tenant = Tenant::create(["distributor_id" => $distributor->id]);
        $tenant->domains()->create(["domain" => $distributor->domain.".".config("app.domain")]);
        // Artisan::call("tenants:migrate");

        $tenant->run(function () use ($distributor_orders) {
            foreach ($distributor_orders as $order) {
                foreach ($order->distributor_packages as $package) {
                    foreach ($package->productOptions as $option) {
                        $product = null;
                        $category = null;
                        $product_option = null;
                        if(!($category = ProductCategory::where("name", $option->product->product_category->name)->first())) {
                            $category = ProductCategory::create(["name" => $option->product->product_category->name, "slug" => Str::slug($option->product->product_category->name)]);
                            
                            $i = new Image();
                            $i->url = $option->product->product_category->image->url;
                            $category->image()->save($i);
                        }
                        
                        if(!($product = Product::where("name", $option->product->name)->first())) {
                            $product = Product::create(["name" => $option->product->name, "slug" => Str::slug($option->product->name), "description" => $option->product->description, "ingredients" => $option->product->ingredients, "product_category_id" => $category->id]);
                        
                            //Insert images
                            $images = [];
                            foreach ($option->product->images as $image) {
                                $i = new Image();
                                $i->url = $image->url;
                                array_push($images, $i);
                            }
                            $product->images()->saveMany($images);
                        }
                        
                        if(!($product_option = ProductOption::where("variation", $option->variation)->where("product_id", $product->id))->first()) {
                           $product_option = ProductOption::create(["variation" => $option->variation, "buying_price" => $option->wholesale_price, "selling_price" => $option->selling_price, "product_id" => $product->id, "stock" => $option->wholesale_min * $package->pivot->quantity]);
                        } else {
                            $product_option->stock += $option->wholesale_min * $package->pivot->quantity;
                            $product_option->save();
                        }
                    }
                }
            }
        });

        $distributor->verified = true;
        $distributor->save();

        //Check for parent 
        if($distributor->parent_distributor_id) {
            $config = BinapointsConfiguration::latest();

            $depth = 1;
            $parent = $distributor->parent_distributor_id;
            while($depth < 4 && $parent) {
                $d = Distributor::find($parent);
                $d->binapoints += $config->awarded / $depth;
                $d->save();

                $depth++;
                $parent = $d->parent_distributor_id;
            }
        }

        return response()->redirectTo('/distributors');
    }

}
