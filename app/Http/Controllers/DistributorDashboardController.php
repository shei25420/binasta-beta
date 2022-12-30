<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Country;
use App\Helpers\Billing;
use App\Models\Distributor;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\DistributorOrder;
use App\Models\DistributorPackage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\DistributorTransaction;
use Illuminate\Auth\Events\Registered;
use App\Http\Requests\MakePaymentRequest;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\RegisterDistributorRequest;
use App\Http\Requests\CapturePaypalPaymentRequest;

class DistributorDashboardController extends Controller
{
    public function fetchPackages () {
        return Inertia::render("Distributor/Packages", [
            'packages' => DistributorPackage::select("id", "name", "slug")->with(["productOptions" => function ($query) {
                $query->select("product_options.id", "wholesale_price as price", "variation", "wholesale_min as min", "product_id");
            }, "productOptions.product" => function ($query) {
                $query->select("id", "name");
            }, "productOptions.product.images" => function ($query) {
                $query->select("imageable_id", "url")->first();
            }, "discounts" => function ($query) {
                $query->select("id", "percentage", "distributor_package_id")->where('start_date', '<=', Carbon::now()->toDateString())->where('end_date', '>', Carbon::now()->toDateString())->first();
            }])->get()
        ]);
    }

    public function showPackage ($subdomain, $slug) {
        $data = Validator::make(['slug' => $slug], ['slug' => 'required|string|exists:distributor_packages,slug'])->validated();
        return Inertia::render("Distributor/PackageView", [
            "distributor_package" => DistributorPackage::select("id", "name", "slug")->where("slug", $data["slug"])->with(["productOptions" => function ($query) {
                $query->select("product_options.id", "variation", "wholesale_price as price", "product_id", "wholesale_min as min");
            }, "productOptions.product" => function ($query) {
                $query->select("id", "name", "slug");
            }, "productOptions.product.images" => function ($query) {
                $query->select("imageable_id", "url")->first();
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
            'order' => DistributorOrder::select("id", "ref", "distributor_id", "location", "phone_number", "created_at")->where("ref", $data["ref"])->with(["distributor_packages" => function ($query) {
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
        $gateway = (new Billing())->payment_gateway($data['payment_type']);

        $response = $gateway->process_payment($data, true);
        switch($data['payment_type']) {
            case 'mpesa':
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

        $order = DistributorOrder::where("ref", $data["order_ref"])->where("distributor_id", auth()->id())->first();
        DB::transaction(function () use ($order, $data) {
            DistributorTransaction::create(["ref" => $data["ref"], "paymnet_type" => 1, "distributor_order_id" => $order->id]);
            foreach ($order->distributor_packages as $package) {
                foreach ($package->productOptions as $option) {
                    $option->sold += $option->wholesale_min;
                    $option->stock -= $option->wholesale_min;
                    $option->save();
                }
            }
            $order->status = 1;
            $order->save();
        }, 5);

        return response()->redirectTo("/orders");
    }

    public function orders () {
        return Inertia::render("Distributor/Orders", [
            "orders" => DistributorOrder::select("id", "ref", "location", "status", "phone_number", "created_at")->where("distributor_id", auth()->id())->get()
        ]);
    }
}
