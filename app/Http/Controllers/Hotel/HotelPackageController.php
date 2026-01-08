<?php

namespace App\Http\Controllers\Hotel;

use App\Http\Controllers\Controller;
use App\Models\Hotel;
use App\Models\Package;
use Illuminate\Http\Request;

class HotelPackageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $hotelId = auth('hotels')->id();

        $packages = Package::where('hotel_id',$hotelId)
        ->orderBy('name','ASC')
        ->paginate(10);
        return view('Hotel.hotel_package.index',compact('packages'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
         $hotelId = auth('hotels')->id();
        return view('Hotel.hotel_package.create', [
            'hotelId'=> $hotelId
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
         $data = $request->validate([
            'name' =>'required|string|min:3|max:255',
            'description' => 'nullable|string|max:1000',
            'price' => 'required|numeric|min:0',
            'status' => 'required|in:active,inactive',
            'hotel_id' => 'nullable|integer|exists:hotels,id',
        ]);
        Package::create($data);
        return redirect()->route('hotel_packages.index')->with('success','package created'); 
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        //   $package = Package::findOrFail($id);
        // return view('Hotel.hotel_packages.show',[
        //     'package'=> $package
        // ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
         $package = Package::findOrFail($id);
        $hotelId = auth('hotels')->id();
        return view('Hotel.hotel_package.edit',[
            'package'=>$package,
            'hotelId'=>$hotelId
           ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $package = Package::findOrFail($id);
        $data = $request->validate([
            'name' =>'required|string|min:3|max:255',
            'description' => 'nullable|string|max:1000',
            'price' => 'required|numeric|min:0',
            'status' => 'required|in:active,inactive',
            'hotel_id' => 'nullable|integer|exists:hotels,id',
        ]);
        $package->update($data);
        return redirect()->route('hotel_packages.index')->with('success','package updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $package=Package::findOrFail($id);
        $package->delete();
        return redirect()->route('hotel_packages.index')->with('success','package deleted');
    }
}
