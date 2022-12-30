<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use Inertia\Inertia;
use App\Models\Order;
use App\Models\Product;
use App\Helpers\Billing;
use App\Models\Discount;
use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Models\ProductCategory;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;
use App\Http\Requests\MakePaymentRequest;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\CapturePaypalPaymentRequest;

class ShopController extends Controller
{
    public function index()
    {
        return Inertia::render(
            'Shop/Index',
            [
                'categories' => ProductCategory::select('id', 'name')->with(['image' => function ($query) {
                    $query->select('imageable_id', 'url');
                }])->withCount('products')->get(),
                'products' => Product::has('product_options', '>', 1)->select('id', 'name', 'slug')->with([
                    'product_options' => function ($query) {
                        $query->select('id', 'product_id', 'selling_price')->first();
                    },
                    'images' => function ($query) {
                        $query->select('imageable_id', 'url');
                    },
                    'discounts' => function ($query) {
                        $query->select('id', 'product_id', 'percentage', 'end_date')->where('start_date', '<=', Carbon::now()->toDateString())->where('end_date', '>', Carbon::now()->toDateString())->first();
                    }
                ])->get(),
                'discounts' => Discount::select('id', 'percentage', 'product_id', 'end_date')->where('start_date', '<=', Carbon::now()->toDateString())->where('end_date', '>', Carbon::now()->toDateString())->with(['product' => function ($query) {
                    $query->select('id', 'name', 'slug');
                }, 'product.images' => function ($query) {
                    $query->select('imageable_id', 'url')->first();
                }, 'product.product_options' => function ($query) {
                    $query->select('id', 'product_id', 'selling_price')->first();
                }])->get(),
            ]
        );
    }

    public function fetchProducts () {
        return Inertia::render('Shop/Products', [
            'categories' => ProductCategory::select('id', 'name')->with(['image' => function ($query) {
                $query->select('imageable_id', 'url');
            }])->withCount('products')->get(),
            'products' => Product::has('product_options', '>', 1)->select('id', 'name', 'slug', 'product_category_id')->with([
                'product_options' => function ($query) {
                    $query->select('id', 'product_id', 'selling_price')->first();
                },
                'images' => function ($query) {
                    $query->select('imageable_id', 'url');
                },
                'discounts' => function ($query) {
                    $query->select('id', 'product_id', 'percentage', 'end_date')->where('start_date', '<=', Carbon::now()->toDateString())->where('end_date', '>', Carbon::now()->toDateString())->first();
                },
                'product_category' => function ($query) {
                    $query->select('id', 'name');
                }
            ])->get(),
            'discounts' => Discount::select('id', 'percentage', 'product_id', 'end_date')->where('start_date', '<=', Carbon::now()->toDateString())->where('end_date', '>', Carbon::now()->toDateString())->with(['product' => function ($query) {
                $query->select('id', 'name', 'slug');
            }, 'product.images' => function ($query) {
                $query->select('imageable_id', 'url')->first();
            }, 'product.product_options' => function ($query) {
                $query->select('id', 'product_id', 'selling_price')->first();
            }])->get(),
        ]);
    }

    public function show($subdomain, $slug)
    {
        $data = Validator::make(['slug' => $slug], ['slug' => 'required|string|exists:products,slug'])->validated();

        $product = Product::select('id', 'slug', 'product_category_id', 'name', 'description', 'ingredients')->with(['product_category' => function ($query) {
            $query->select('id', 'name');
        }, 'product_options' => function ($query) {
            $query->select('id', 'product_id', 'variation', 'selling_price');
        }, 'images' => function ($query) {
            $query->select('imageable_id', 'url');
        }])->where('slug', $data['slug'])->first();

        $product->views = ++$product->views;
        $product->save();

        $related = Product::select('id', 'slug', 'product_category_id', 'name')->where('slug', $data['slug'])->where('slug', '!=', $product->slug)->with(['product_options' => function ($query) {
            $query->select('id', 'product_id', 'variation', 'selling_price');
        }, 'images' => function ($query) {
            $query->select('imageable_id', 'url');
        }])->limit(3)->get();

        $categories = ProductCategory::select('id', 'name', 'slug')->with(['image' => function ($query) {
            $query->select('imageable_id', 'url');
        }])->withCount('products')->get();

        return Inertia::render('Shop/ProductView', [
            'product' => $product,
            'related' => $related,
            'categories' => $categories
        ]);
    }

    public function checkout () {
        return Inertia::render('Shop/Checkout');
    }

    public function invoice ($subdomain, $ref) {
        $data = Validator::make(['ref' => $ref], ['ref' => 'required|string|exists:orders,ref'])->validated();

        return Inertia::render('Shop/Invoice', [
            'order' => Order::where('ref', $data['ref'])->with(['product_options' => function ($query) {
                $query->select('product_options.id', 'product_id', 'variation', 'selling_price');
            }, 'product_options.product' => function ($query) {
                $query->select('id', 'name');
            }, 'user' => function ($query) {
                $query->select('id', 'email');
            }])->first()
        ]);
    }

    public function makePayment (MakePaymentRequest $request) {
        $data = $request->validated();


        $order = Order::select("id", 'ref', 'created_at')->where("ref", $data['order_ref'])->where('user_id', auth()->id())->with(['product_options' => function ($query) {
            $query->select("product_options.id", "selling_price", "product_id");
        }, 'product_options.product' => function ($query) {
            $query->select('id', 'name');
        }, 'product_options.product.discounts' => function ($query) {
            $query->select("id", "percentage", "product_id")
            ->where('start_date', '<=', Carbon::now()->toDateString())
            ->where('end_date', '>', Carbon::now()->toDateString())
            ->where('status', true);
        }])->firstOrFail();

        $data["order"] = $order;
        $gateway = (new Billing())->payment_gateway($data['payment_type']);

        $response = $gateway->process_payment($data);
        switch($data['payment_type']) {
            case 'mpesa':
                break;
            case 'paypal':
                if(isset($response->name) && $response->name == "INVALID_REQUEST") break;
                return response()->json(['orderId' => $response->id]);
            default:
                break;
        }

        return response()->json(['message' => 'error processing payment. please try again'], 500);
    }

    public function capturePaypalPayment (CapturePaypalPaymentRequest $request) {
        $data = $request->validated();

        $order = Order::where("ref", $data["order_ref"])->with(["product_options" => function ($query) {
            $query->select("product_options.id", "stock", "sold");
        }])->where("user_id", auth()->id())->firstOrFail();
        DB::transaction(function () use ($data, $order) {
            Transaction::create(["ref" => $data["ref"], "paymnet_type" => 1, "order_id" => $order->id]);
            foreach ($order->product_options as $option) {
                $option->sold++;
                $option->stock--;
                $option->save();
            }
            $order->status = 1;
            $order->save();
        }, 5);

        return Inertia::location("http://dashboard.".config("app.domain")."/orders");
    }

    public function register (Request $request) {
        $request->validate([
            'email' => 'required|string|email|max:255|unique:users',
            'password' => ['required', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));
        Auth::login($user);

        return Inertia::render('Shop/Checkout');
    }

    private function fetch_products_by_category($slug)
    {
        $data = Validator::make(['slug' => $slug], ['slug' => 'required|string|exists:product_categories,name'])->validated();

        $category = ProductCategory::select('id')->with(['products' => function ($query) {
            $query->select('product_category_id', 'slug', 'name');
        }, 'products.product_options' => function ($query) {
            $query->select('product_id', 'selling_price')->first();
        }, 'products.product_category' => function ($query) {
            $query->select('id', 'slug', 'name');
        }])->where('name', $data['slug'])->first();

        return $category->products;
    }

    private function fetch_all_products()
    {
        return Product::select('product_category_id', 'slug', 'name')->with(['product_category' => function ($query) {
            $query->select('id', 'name', 'slug');
        }, 'product_options' => function ($query) {
            $query->select('product_id', 'selling_price');
        }]);
    }
}
