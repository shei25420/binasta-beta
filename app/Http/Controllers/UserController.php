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
        return Inertia::render('Users/Orders', [
            'orders' => Order::select('ref', 'location', 'phone_number', 'status', 'created_at')->where('user_id', auth()->id())->get()
        ]);
    }
}
