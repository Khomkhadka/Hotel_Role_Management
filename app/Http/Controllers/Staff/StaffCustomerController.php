<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Hotel;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Auth;

class StaffCustomerController extends Controller implements HasMiddleware
{

    public static function middleware(): array
    {
        return [
               new Middleware('can:view-customers', only: ['index']),
               new Middleware('can:create-customer', only: ['create']),
               new Middleware('can:edit-customer', only: ['edit']),
               new Middleware('can:delete-customer', only: ['destroy']),
        ];
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
    $hotelId = auth('staffs')->user()->hotel_id;

    $customers = Customer::where('hotel_id', $hotelId)
        ->orderBy('name', 'ASC')
        ->paginate(12);             
        return view('Staff.staff_customer.index',compact('customers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {      
         $hotelId = auth('staffs')->user()->hotel_id;

         return view('Staff.staff_customer.create',[
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
        return redirect()->route('staff_customers.index')->with('success','customer created');

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
           $hotelId = auth('staffs')->user()->hotel_id;
        return view('Staff.staff_customer.edit',[
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
         return redirect()->route('staff_customers.index',compact('customers'))->with('success','customer updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
         $customers = Customer::findOrFail($id);
        $customers->delete();
        return redirect()->route('staff_customers.index')->with('success','customer deleted');
    }
}
