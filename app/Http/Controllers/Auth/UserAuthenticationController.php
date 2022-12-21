<?php

namespace App\Http\Controllers\Auth\Admin;

use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Providers\RouteServiceProvider;
use App\Http\Requests\Auth\LoginRequest;

class AuthenticationController extends Controller
{
    public function create () {
        return Inertia::render('Auth/Login', [
            'canResetPassword' => Route::has('password.request'),
            'status' => session('status'),
        ]);
    }

    public function login(LoginRequest $request) {
        if(Auth::guard()->attempt($request->safe()->only('email', 'password'))) {
            $request->session()->regenerate();
            return redirect()->intended(RouteServiceProvider::HOME);
        }
        return response()->redirectTo('/login');
    }

    public function logout (Request $request) {
        Auth::guard()->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
