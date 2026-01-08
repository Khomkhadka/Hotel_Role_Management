<?php

namespace App\Http\Controllers;

use App\Models\Hotel;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Hash;

class HotelController extends Controller implements HasMiddleware
{
     public static function middleware(): array
    {
        return [
               new Middleware('permission:view-hotels', only: ['index']),
               new Middleware('permission:create-hotel', only: ['create']),
               new Middleware('permission:edit-hotel', only: ['edit']),
               new Middleware('permission:delete-hotel', only: ['destroy']),
        ];
    }

    public function admindashboard(){
        $hotels=Hotel::latest()->get();
        $users=User::latest()->get();
        return view ('dashboard',compact('hotels','users'));
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $hotels = Hotel::orderBy('name','ASC')->paginate(10);
       
        return view('hotels.index',compact('hotels'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $hotels = Hotel::get();
        
        return view('hotels.create',[
            'hotels'=>$hotels
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $data = $request -> validate([
            'name' => 'required|string|min:3|max:255',
             'email'=>'required|email|string|unique:hotels,email',
             'type' => 'required|string|in:Hotel,Restaurant',
             'address' => 'required|string|max:500',
             'contact' => 'required|string|min:10|max:20',
             'password' => 'required|string|min:5|confirmed', 
             'status' => 'required|string|in:active,inactive',
             'remake' => 'nullable|string|max:500', 
            //  'user_id' => 'required|exists:users,id',
        ]);
        $hotel = Hotel::create([
          'name'=>$request->name,
          'email'=>$request->email,
          'type'=>$request->type,
          'address'=>$request->address,
          'contact'=>$request->contact,
          'password'=>Hash::make($request->password),
            'status'=>$request->status,
            'remake'=>$request->remake,
            // 'user_id'=>$request->user_id,
          ]);

            // 🔥 ASSIGN HOTEL ROLE
            // $hotel->assignRole('hotel-admin');

        return redirect()->route('hotels.index')->with('success','hotel created');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $hotels = Hotel::findOrFail($id);
        return view('hotels.show',[
            'hotels'=> $hotels
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // //
        // $users = User::get();
        $hotels = Hotel::findOrFail($id);
        return view('hotels.edit',[
            'hotels'=>$hotels,
            // 'users' =>$users
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $hotels = Hotel::findOrFail($id);    
        $data = $request -> validate([
            'name' => 'required|string|min:3|max:255',
             'email'=>'required|email|string|unique:hotels,email,'.$hotels->id,
             'type' => 'required|string|in:Hotel,Restaurant',
             'address' => 'required|string|max:500',
             'contact' => 'required|string|min:10|max:15',
             'password' => 'nullable|string|min:5|confirmed', 
             'status' => 'required|string|in:active,inactive',
             'remake' => 'nullable|string|max:500', 
            //  'user_id' => 'required|exists:users,id',
        ]);

        // Handle password only if provided
        if (!empty($data['password'])) {
        $data['password'] = bcrypt($data['password']);
        } else {
        unset($data['password']); // leave old password intact
        } 
        $hotels->update($data);
        return redirect()->route('hotels.index')->with('success','hotel updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $hotels = Hotel::findOrFail($id);
        $hotels->delete();
        return redirect()->route('hotels.index')->with('success','hotel deleted');
    }
}
