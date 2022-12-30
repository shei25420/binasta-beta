<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\StoreUserRequest;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Inertia\Inertia;

class UserController extends Controller
{
    // Admin Functions
    public function index () {
        return Inertia::render('Admin/Users', ['users' => User::select('email', 'created_at')->withCount('orders')->get()]);
    }

    public function store (StoreUserRequest $request) {
        $data = $request->validated();
        $data['password'] = bcrypt($data['password']);

        User::create($data);
        return response()->redirectTo('/users');
    }

    public function search ($subdomain, $query) {
        $data = Validator::make(['query' => $query], ['query' => 'required|string'])->validated();
        return response()->json(['results' => User::select('id', 'email')->where('email', 'like', '%'.$data['query'].'%')->get()]);
    }

    public function destroy ($subdomain, $id) {
        $id = Validator::make(['id' => $id], ['id' => 'required|numeric|exists:users,id'])->validated()['id'];
        User::where('id', $id)->delete();

        return response()->redirectTo('/users');
    }

    // User Functions
    public function orders () {
        return Inertia::render('User/Orders', [
            'orders' => Order::select('ref', 'location', 'phone_number', 'status', 'created_at')->where('user_id', auth()->id())->get()
        ]);
    }

    public function fetchOrderProducts ($subdomain, $ref) {
        $data = Validator::make(["ref" => $ref], ["ref" => "required|string|exists:orders,ref"])->validated();

        $order = Order::select("id")->where("ref", $data["ref"])->where("user_id", auth()->id())->with(["product_options" => function ($query) {
            $query->select("product_options.id", "variation", "selling_price", "product_id");
        }, "product_options.product" => function ($query) {
            $query->select("id", "name", "product_category_id");
        }, "product_options.product.product_category" => function ($query) {
            $query->select("id", "name");
        }])->first();
        
        return response()->json(["productOptions" => $order->product_options]);
    }
}
