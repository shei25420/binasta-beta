<?php

namespace App\Http\Controllers;

use App\Helpers\Billing;
use App\Http\Requests\MakePaymentRequest;
use Carbon\Carbon;
use App\Models\User;
use Inertia\Inertia;
use App\Models\Product;
use App\Models\Discount;
use App\Models\Order;
use Illuminate\Http\Request;
use App\Models\ProductCategory;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Validator;

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
                ])->get(),
                'discounts' => Discount::select('id', 'percentage', 'product_id')->where('start_date', '>=', Carbon::now()->toDateString())->where('end_date', '>', Carbon::now()->toDateString())->with(['product' => function ($query) {
                    $query->select('id', 'name', 'slug');
                }, 'product.images' => function ($query) {
                    $query->select('imageable_id', 'url')->first();
                }, 'product.product_options' => function ($query) {
                    $query->select('id', 'product_id', 'selling_price')->first();
                }])->get(),
            ]
        );
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

        $gateway = (new Billing())->payment_gateway($data['payment_type']);
        dd($gateway->process_payment($data));
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
