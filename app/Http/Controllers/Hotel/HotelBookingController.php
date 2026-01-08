<?php

namespace App\Http\Controllers\Hotel;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Customer;
use App\Models\Package;
use Illuminate\Http\Request;

class HotelBookingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $hotelId = auth('hotels')->id();
        $bookings = Booking::where('hotel_id',$hotelId)
        ->orderBy('name','ASC')
        ->paginate(10);
       return view('Hotel.hotel_booking.index',compact('bookings'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $hotelId = auth('hotels')->id();
        $customers = Customer::where('hotel_id',$hotelId)->get();
        $packages = Package::where('hotel_id',$hotelId)->get();
         return view('Hotel.hotel_booking.create',[
            'hotelId'=>$hotelId,
            'customers'=>$customers,
            'packages'=>$packages
         ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
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
        return redirect()->route('hotel_bookings.index')->with('success','booking created');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $hotelId = auth('hotels')->id();
        $customers = Customer::where('hotel_id',$hotelId)->orderBy('customer_name','ASC')->get();
        $packages = Package::where('hotel_id',$hotelId)->orderBy('name','ASC')->get();
        $booking = Booking::findOrFail($id);
        return view('Hotel.hotel_booking.edit',[
            'booking'=>$booking,
            'hotelId'=>$hotelId,
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
        return redirect()->route('hotel_bookings.index')->with('success','Booking updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
         $booking=Booking::findOrFail($id);  
        $booking->delete();
        return redirect()->route('hotel_bookings.index')->with('success','Booking deleted');
    }
}
