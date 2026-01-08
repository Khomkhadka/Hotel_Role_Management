<?php

namespace App\Http\Controllers\HotelAuth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthenticatedSessionController extends Controller
{
    public function store(LoginRequest $request)
    {
        $request->authenticate();

        $request->session()->regenerate();

        // LOG IN USING THE HOTEL GUARD
        if (Auth::guard('hotel')->attempt($request->only('email', 'password'))) {
            return redirect()->intended('/hotel/dashboard');
        }

        return back()->withErrors(['email' => 'Invalid credentials']);
    }

    public function destroy(Request $request)
    {
        Auth::guard('hotels')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/hotel')->with('success','logout successfully');
    }
}

