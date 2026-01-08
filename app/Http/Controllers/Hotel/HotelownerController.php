<?php

namespace App\Http\Controllers\Hotel;

use App\Http\Controllers\Controller;
use App\Models\Hotel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HotelownerController extends Controller
{
    public function login(){
       
       return view('Hotel.Auth.hotellogin');
    }
    
    public function store(Request $request){

    //  $userType = $request->input('user_type');  // e.g., 'admin', 'customer', 'vendor'

    // // Determine which guard to use
    // if ($userType == 'hotels') {
    //     $guard = 'hotels';
    // } elseif ($userType == 'staffs') {
    //     $guard = 'staffs';
    // } else {
       
    // }

    //     $credentials=$request->validate([
    //         'email'=>'required',
    //         'password'=>'required'
    //     ]);
        
    //    if( Auth::guard($guard)->attempt($credentials)){
        
    //      if ($guard == 'hotels') {
    //         return redirect()->route('hotel.dashboard')->with('success','login successfull');
    //      } else {
    //         return redirect()->route('staff.dashboard')->with('success','login successfull');
    //      }
         
    //    } else{

       
    //     return redirect()->route('hotel.login')->with('fail','invalid credential');
    //    }

      $credentials = $request->validate([
        'email'    => 'required|email',
        'password' => 'required'
    ]);

    // Try login as hotel
    if (Auth::guard('hotels')->attempt($credentials)) {
        return redirect()
            ->route('hotel.dashboard')
            ->with('success', 'Login successful');
    }

    // Try login as staff
    if (Auth::guard('staffs')->attempt($credentials)) {
        return redirect()
            ->route('staff.dashboard')
            ->with('success', 'Login successful');
    }
        if (!Auth::attempt($request->only('email', 'password'))) {
        return back()
            ->withInput()
            ->withErrors([
                'email' => 'Invalid email or password.',
            ]);
    }

    // If neither guard works
    return redirect()
        ->back()
        ->with('fail', 'Invalid credentials');
        
    }
    
   public function show(){
        $user=Auth::guard('hotels')->user();
      
        $customers=$user->customers()->latest()->paginate(5);
        $bookings=$user->bookings()->latest()->get();
        $staffs=$user->staffs()->get();
        return view('Hotel.layouts.hoteldashboard',compact('customers','bookings','staffs'));
    }
    public function staffShow(){
        $user=Auth::guard('staffs')->user();
        $hotel=$user->hotels;
     
        $customers=$hotel->customers()->latest()->paginate(5);
       
        $bookings=$hotel->bookings()->latest()->get();
        
        $staffs=$hotel->staffs()->get();
        return view ('Staff.layouts.staffdashboard',compact('customers','bookings','staffs'));
    }
    public function logout(Request $request){
         Auth::guard('hotels','staffs')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/hotel')->with('success','logout successfully');
    }
  
}
