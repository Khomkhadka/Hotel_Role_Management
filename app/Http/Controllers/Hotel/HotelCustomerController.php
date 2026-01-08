<?php

namespace App\Http\Controllers\Hotel;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Hotel;
use Illuminate\Http\Request;

class HotelCustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
         $hotelId = auth('hotels')->id();

    $customers = Customer::where('hotel_id', $hotelId)
        ->orderBy('name', 'ASC')
        ->paginate(12);             
        return view('Hotel.hotel_customer.index',compact('customers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {      
         $hotelId = auth('hotels')->id();

         return view('Hotel.hotel_customer.create',[
            'hotelId'=>$hotelId,
         ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request -> validate([
            'customer_name' => 'required|string|min:3|max:255',
            'email' => 'required|email|string|unique:customers,email',
            'customer_address'=>'required|string|min:4|max:225',
            'contact'=>'required|string|min:10|max:15',
            'dob'=>'date',
            'hotel_id'=>'nullable|integer|exists:hotels,id'
        ]);
        Customer::create($data);
        return redirect()->route('hotel_customers.index')->with('success','customer created');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //    $customers = Customer::findOrFail($id);

        // return view('hotel_customers.show',[
        //     'customers'=> $customers
        // ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
           $customers = Customer::findOrFail($id);
          $hotelId = auth('hotels')->id();
        return view('Hotel.hotel_customer.edit',[
            'customers' => $customers,
            'hotelId'=> $hotelId
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
          $customers = Customer::findOrfail($id);

         $data = $request->validate([
            'customer_name' => 'required|string|min:3|max:255',
            'email' => 'required|email|string|unique:customers,email,'. $customers->id,
            'customer_address'=>'required|string|min:4|max:225',
            'contact'=>'required|string|min:10|max:15',
            'dob'=>'date',
            'hotel_id'=>'nullable|integer|exists:hotels,id'
         ]);
         $customers->update($data);
         return redirect()->route('hotel_customers.index',compact('customers'))->with('success','customer updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
         $customers = Customer::findOrFail($id);
        $customers->delete();
        return redirect()->route('hotel_customers.index')->with('success','customer deleted');
    }
}
