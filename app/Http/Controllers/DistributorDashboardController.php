<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\User;
use Inertia\Inertia;
use App\Models\Image;
use App\Models\Order;
use App\Models\Tenant;
use App\Models\Country;
use App\Models\Product;
use App\Helpers\Billing;
use App\Models\Discount;
use App\Models\Distributor;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\ProductOption;
use Illuminate\Support\Carbon;
use App\Models\ProductCategory;
use App\Models\DistributorOrder;
use App\Models\MpesaTransaction;
use App\Models\DistributorPackage;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\QueryPayment;
use App\Events\MpesaPaymentCaptured;
use Illuminate\Support\Facades\Auth;
use App\Models\DistributorTransaction;
use Illuminate\Auth\Events\Registered;
use App\Http\Requests\MakePaymentRequest;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\StoreDiscountRequest;
use App\Http\Requests\RegisterDistributorRequest;
use App\Http\Requests\CapturePaypalPaymentRequest;

class DistributorDashboardController extends Controller
{
    public function index () { 
        $products_meta = null;
        $product_options_meta = null;
        $customers_meta = null;
        $customer_orders_meta = null;

        $tenant = Tenant::where("data->distributor_id", auth("distributor")->id())->first();
        
        $tenant->run(function () use (&$products_meta, &$product_options_meta, &$customers_meta, &$customer_orders_meta) {
            $products_meta = Product::select(DB::raw("COUNT(*) as products_count, SUM(views) as product_views"))->first();
        
            $product_options_meta = ProductOption::select(DB::raw("SUM(sold) as total_sold"))->first();
        
            $customers_meta = User::select(DB::raw("COUNT(*) as total_customers"))->first();
        
            $customer_orders_meta = Order::select(DB::raw("created_at, COUNT(*) as total_orders, SUM(if(status = true, 1, 0)) as total_paid, YEAR(created_at) year, MONTH(created_at) month, DAY(created_at) day"))
        ->groupBy("day")
        ->get();
        });

        return Inertia::render("Distributor/Dashboard", [
            "products_meta" => $products_meta,
            "product_options_meta" => $product_options_meta,
            "customers_meta" => $customers_meta,
            "customer_orders_meta" => $customer_orders_meta,
        ]);
    }

    public function fetchPackages () {
        return Inertia::render("Distributor/Packages", [
            'packages' => DistributorPackage::select("id", "name", "slug", "description", "image_path")->with(["productOptions" => function ($query) {
                $query->select("product_options.id", "wholesale_price as price", "variation", "wholesale_min as min", "product_id");
            }, "productOptions.product" => function ($query) {
                $query->select("id", "name");
            }, "discounts" => function ($query) {
                $query->select("id", "percentage", "distributor_package_id")->where('start_date', '<=', Carbon::now()->toDateString())->where('end_date', '>', Carbon::now()->toDateString())->first();
            }])->get()
        ]);
    }

    public function showPackage ($subdomain, $slug) {
        $data = Validator::make(['slug' => $slug], ['slug' => 'required|string|exists:distributor_packages,slug'])->validated();
        return Inertia::render("Distributor/PackageView", [
            "distributor_package" => DistributorPackage::select("id", "name", "description", "image_path", "slug")->where("slug", $data["slug"])->with(["productOptions" => function ($query) {
                $query->select("product_options.id", "variation", "wholesale_price as price", "product_id", "wholesale_min as min");
            }, "productOptions.product" => function ($query) {
                $query->select("id", "name", "slug");
            }, "discounts" => function ($query) {
                $query->select("id", "percentage", "distributor_package_id")->where('start_date', '<=', Carbon::now()->toDateString())->where('end_date', '>', Carbon::now()->toDateString())->first();
            }])->first()
        ]);
    }

    public function checkout () {
        return Inertia::render("Distributor/Checkout");
    }

    public function invoice ($subdomain, $ref) {
        $data = Validator::make(['ref' => $ref], ['ref' => 'required|string|exists:distributor_orders,ref'])->validated();
        return Inertia::render("Distributor/Invoice", [
            'order' => DistributorOrder::select("id", "ref", "distributor_id", "location", "phone_number", "status", "created_at")->where("ref", $data["ref"])->with(["distributor_packages" => function ($query) {
                $query->select("distributor_packages.id", "name", "distributor_order_distributor_package.quantity");
            },
            "distributor_packages.productOptions" => function ($query) {
                $query->select("product_options.id", "wholesale_price as price", "wholesale_min as min");
            },
            "distributor_packages.discounts" => function ($query) {
                $query->select("id", "percentage")->where('start_date', '<=', Carbon::now()->toDateString())->where('end_date', '>', Carbon::now()->toDateString())->first();
            },
            "distributor" => function ($query) {
                $query->select("id", "first_name", "last_name");
            }])->first()
        ]);
    }

    public function register () {
        return Inertia::render("Distributor/Register", [
            "countries" => Country::select("id", "name")->get(),
        ]);
    }

    public function storeDistributor (RegisterDistributorRequest $request) {
        $data = $request->validated();

        $ref = Str::random(8);
        while(Distributor::where("ref", $ref)->exists()) $ref = Str::random(8);

        $data["ref"] = $ref;
        $data["password"] = bcrypt($data["password"]);
        $user = Distributor::create($data);
        event(new Registered($user));
        Auth::login($user);

        return response()->redirectTo("/distributor_packages");
    }

    public function makePayment (MakePaymentRequest $request) {
        $data = $request->validated();

        $order = DistributorOrder::with(["distributor_packages" => function ($query) {
            $query->select("distributor_packages.id", "name", "quantity");
        }, "distributor_packages.productOptions" => function ($query) {
            $query->select("product_options.id", "wholesale_price", "wholesale_min");
        }, "distributor_packages.discounts" => function ($query) {
            $query->select("id", "percentage")->where('start_date', '<=', Carbon::now()->toDateString())->where('end_date', '>', Carbon::now()->toDateString())->latest();
        }])->where("ref", $data["order_ref"])->where("distributor_id", auth("distributor")->id())->firstOrFail();

        $data["order"] = $order;
        $data["distributor"] = true;
        $gateway = (new Billing())->payment_gateway($data['payment_type']);

        $response = $gateway->process_payment($data, true);
        switch($data['payment_type']) {
            case 'mpesa':
                if((int)$response->ResponseCode === 0) {
                    MpesaTransaction::create(['order_id' => $order->id, 'merchant_request_id' => $response->MerchantRequestID]);
                    return response()->json(['status' => 1]);
                }
                break;
            case 'paypal':
                if(isset($response->debug_id)) break;
                return response()->json(['orderId' => $response->id]);
            default:
                break;
        }

        return response()->json(['message' => 'error processing payment. please try again'], 500);
    }

    public function capturePaypalPayment (CapturePaypalPaymentRequest $request) {
        $data = $request->validated();

        $order = DistributorOrder::where("ref", $data["order_ref"])->with(["distributor" => function ($query) {
            $query->select("id", "verified");
        }, "distributor_packages" => function ($query) {
            $query->select("distributor_packages.id");
        }, "distributor_packages.productOptions" => function ($query) {
            $query->select("product_options.id", "product_id", "variation", "wholesale_price", "selling_price", "wholesale_min");
        }, "distributor_packages.productOptions.product" => function ($query) {
            $query->select("id", "name", "product_category_id", "description", "ingredients");
        }, "distributor_packages.productOptions.product.product_category" => function ($query) {
            $query->select("id", "name");
        }, "distributor_packages.productOptions.product.product_category.image" => function ($query) {
            $query->select("imageable_id", "url");
        }, "distributor_packages.productOptions.product.images" => function ($query) {
            $query->select("imageable_id", "url");
        }])->where("distributor_id", auth()->id())->first();
        
        DistributorTransaction::create(["ref" => $data["ref"], "paymnet_type" => 1, "distributor_order_id" => $order->id]);
        foreach ($order->distributor_packages as $package) {
            foreach ($package->productOptions as $option) {
                $option->sold += $option->wholesale_min * $package->pivot->quantity;
                $option->stock -= $option->wholesale_min * $package->pivot->quantity;
                $option->save();
            }
        }
        
        $order->status = 1;
        $order->save();

        if($order->distributor->verified) {
            $tenant = Tenant::where("data->distributor_id", auth()->id())->first();
            
            $tenant->run(function () use ($order) {
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
            });
        }

        return response()->redirectTo("/orders");
    }

    public function captureMpesaPayment (Request $request) {
        $data = json_decode($request->getContent());
        
        try {
            $transaction = MpesaTransaction::where('merchant_request_id', $data->Body->stkCallback->MerchantRequestID)->with(['distributorOrder' => function ($query) {
                $query->select('id', 'distributor_id');
            }, 'distributorOrder.distributor' => function ($query) {
                $query->select('id');
            }])->first();
            
            $message = $data->Body->stkCallback->ResultDesc;
            $status = (int)$data->Body->stkCallback->ResultCode;
            
            $order = $transaction->distributorOrder;
            if($status === 0) {
                DistributorTransaction::create(["ref" => $data["ref"], "paymnet_type" => 1, "distributor_order_id" => $order->id]);
                foreach ($order->distributor_packages as $package) {
                    foreach ($package->productOptions as $option) {
                        $option->sold += $option->wholesale_min * $package->pivot->quantity;
                        $option->stock -= $option->wholesale_min * $package->pivot->quantity;
                        $option->save();
                    }
                }
                
                $order->status = 1;
                $order->save();
        
                if($order->distributor->verified) {
                    $tenant = Tenant::where("data->distributor_id", auth("distributor")->id())->first();
                    
                    $tenant->run(function () use ($order) {
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
                    });
                }
            }
            
            event(new MpesaPaymentCaptured($transaction->distributorOrder->distributor->id, $status, $transaction, true));
            // event(new MpesaPaymentCaptured($transaction->distributorOrder->distributor->id, $status, $message, true));
        } catch (Exception $ex) {
            event(new MpesaPaymentCaptured(auth("distributor")->id(), 1, $ex->getMessage(), true));
        }
    }

    public function queryMpesaPayment (QueryPayment $request) {
        $gateway = (new Billing())->payment_gateway('mpesa');

        dd($gateway->query_payment($request->validated()));
    }

    public function orders () {
        $orders = [];
        $tenant = Tenant::where("data->distributor_id", auth("distributor")->id())->first();

        $tenant->run(function () use (&$orders) {
            $orders = Order::select("id", "ref", "location", "status", "phone_number", "created_at")->get();
        });

        return Inertia::render("Distributor/Orders", [
            "orders" => $orders
        ]);
    }

    public function products () {
        return Inertia::render("Distributor/Products", [
            "products" => Product::select("id", "product_category_id", "name", "created_at")->with(["images" => function ($query) {
                $query->select("imageable_id", "url");
            }, "product_category" => function ($query) {
                $query->select("id", "name");
            }])->withCount("product_options")->get()
        ]);
    }

    public function discounts () {
        $discounts = [];
        $tenant = Tenant::where("data->distributor_id", auth()->id())->first();

        $tenant->run(function () use (&$discounts) {
            $discounts = Discount::select('id', 'product_id', 'percentage', 'active', 'start_date', 'end_date', 'created_at')->with(['product' => function ($query) {
                $query->select('id', 'name');
            }])->get();
        });
        return Inertia::render('Distributor/Discounts', ['discounts' => $discounts]);
    }

    public function storeDiscounts (StoreDiscountRequest $request) {
        $data = $request->validated();
        
        $tenant = Tenant::where("data->distributor_id", auth()->id())->first();

        $tenant->run(function () use ($data) {
            $data['start_date'] = new Carbon($data['start_date']);
            $data['end_date'] = new Carbon($data['end_date']);

            Discount::create($data);
        });
        return response()->redirectTo('/discounts');
    }

    public function users () {
        $tenant = Tenant::where("data->distributor_id", auth()->id())->first();

        $customers = [];
        $tenant->run(function (&$customers) {
            $customers = User::select('email', 'created_at')->withCount('orders')->get();
        });
    
        return Inertia::render("Distributor/Users", ["users" => $customers]);
    }

    public function myOrders () {
        $orders = DistributorOrder::select("ref", "location", "phone_number", "status", "amount", "created_at")->with(['distributor_packages' => function ($query) {
            $query->select('distributor_packages.id', 'name');
        }])->where('distributor_id', auth()->id())->get();

        return Inertia::render('Distributor/MyOrders', ['orders' => $orders]);
    }

    public function myInvoices () {
        return Inertia::render('Distributor/Invoices', [
            'invoices' =>DistributorTransaction::select("ref", "payment_type", "created_at")->whereHas('order.distributor', function ($query) {
                $query->where('distributor_id', auth("admin")->id());
            })->latest()->get()]);
    }
}
