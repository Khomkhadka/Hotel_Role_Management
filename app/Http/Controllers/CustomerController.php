<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Hotel;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class CustomerController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
               new Middleware('permission:view customers', only: ['index']),
               new Middleware('permission:create customer', only: ['create']),
               new Middleware('permission:edit customer', only: ['edit']),
               new Middleware('permission:delete customer', only: ['destroy']),
        ];
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // get customer 
        $customers=Customer::with('hotels')->orderBy('name','ASC')->paginate(12);
        // 
        
        return view('customers.index',compact('customers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $hotels=Hotel::get();
        return view('customers.create',[
            'hotels'=>$hotels,  
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


       $staff =  Customer::create($data);
       $staff->assignRole('hotel-staff');

        return redirect()->route('customers.index')->with('success','customer created');
      
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $customers = Customer::findOrFail($id);

        return view('customers.show',[
            'customers'=> $customers
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $customers = Customer::findOrFail($id);
        return view('customers.edit',[
            'customers' => $customers
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
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
         return redirect()->route('customers.index',compact('customers'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $customers = Customer::findOrFail($id);
        $customers->delete();
        return redirect()->route('customers.index');
    }
}
