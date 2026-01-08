<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Customer;
use App\Models\Hotel;
use App\Models\Package;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class BookingController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
               new Middleware('permission:view bookings', only: ['index']),
               new Middleware('permission:create booking', only: ['create']),
               new Middleware('permission:edit booking', only: ['edit']),
               new Middleware('permission:delete booking', only: ['destroy']),
        ];
    }
    /**
     * Display a listing of the resource.
     */
        public function index()
        {
            //
            $bookings = Booking::with('hotels','packages','customers')->orderBy('booked_date', 'desc')->paginate(12);
        
            return view('bookings.index',compact('bookings'));
        }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $bookings = Booking::get();
         $hotels = Hotel::orderBy('name','ASC')->get();
        $customers = Customer::orderBy('customer_name','ASC')->get();
        $packages = Package::orderBy('name','ASC')->get();
       
        return view('bookings.create',compact('bookings','hotels','customers','packages'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
         
        $data =  $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'hotel_id' => 'required|exists:hotels,id',
            'package_id' => 'required|exists:packages,id',
            'booked_date' => 'required|date',
            'checkin' => 'required|date|after_or_equal:booked_date',
            'checkout' => 'required|date|after:checkin',
            'note' => 'required|string',
        ]);
        
        Booking::create($data);
        return redirect()->route('bookings.index')->with('success','booking created');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $booking = Booking::findOrFail($id);
        return view('bookings.show',[
            'booking'=> $booking
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $hotels = Hotel::orderBy('name','ASC')->get();
        $customers = Customer::orderBy('customer_name','ASC')->get();
        $packages = Package::orderBy('name','ASC')->get();
        $booking = Booking::findOrFail($id);
        return view('bookings.edit',[
            'booking'=>$booking,
            'hotels'=>$hotels,
            'customers'=>$customers,
            'packages'=>$packages
    ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $booking = Booking::findOrFail($id);        
        $data = $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'hotel_id' => 'required|exists:hotels,id',
            'package_id' => 'required|exists:packages,id',
            'booked_date' => 'required|date',
            'checkin' => 'required|date|after_or_equal:booked_date',
            'checkout' => 'required|date|after:checkin',
            'note' => 'required|string',
        ]);
        $booking->update($data);
        return redirect()->route('bookings.index')->with('success','Booking updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $booking=Booking::findOrFail($id);  
        $booking->delete();
        return redirect()->route('bookings.index')->with('success','Booking deleted');
    }
}
