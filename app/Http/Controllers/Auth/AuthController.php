<?php

namespace App\Http\Controllers\Auth;

use App\Models\Hotel;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /**
     * Handle the incoming request.
     */
    // public function __invoke(Request $request)
    // {
    //     $validated = $request->validate([
    //           'name' => 'required|string|min:3|max:255',
    //          'email'=>'required|email|string|unique:hotels,email',
    //          'hotelowner'=>'required|string|min:3|max:255',
    //          'type' => 'required|string|in:Hotel,Restaurant',
    //          'address' => 'required|string|max:500',
    //          'contact' => 'required|numeric|digits_between:10,15',
    //          'password' => 'required|string|min:5|confirmed', 
    //          'status' => 'required|string|in:active,inactive',
    //          'remake' => 'nullable|string|max:500', 
    //          'user_id' => 'required|exists:users,id'
    //     ]);

    //       //create the user
    //       $hotel = Hotel::create([
    //             'name' =>$validated['name'],
    //             'email' => $validated['email'],
    //             'password' => Hash::make($validated['password']),
    //           ]);

    //      //login the hotel
    //      Auth::login($hotel);

    //      //redirect to home
    //      return redirect('/')->with('success', 'welcome to hotel management');
  
    // }

   
}
