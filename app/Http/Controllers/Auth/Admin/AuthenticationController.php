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

    public function login($subdomain, LoginRequest $request) {
        $guard = '';
        if($subdomain == "management") $guard = "admin";
        else if($subdomain == "distributor") $guard = "distributor";

        if(Auth::guard($guard)->attempt($request->safe()->only('email', 'password'))) {
            $request->session()->regenerate();
            return redirect()->intended(RouteServiceProvider::HOME);
        }

        return response()->redirectTo('/login');
    }

    public function logout ($subdomain, Request $request) {
        $guard = '';
        if($subdomain == "management") $guard = "admin";
        else if($subdomain == "distributor") $guard = "distributor";

        Auth::guard($guard)->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
