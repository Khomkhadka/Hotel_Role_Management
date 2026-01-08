<?php

namespace App\Http\Controllers;

use App\Models\Hotel;
use App\Models\Package;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Auth;


class PackageController extends Controller implements HasMiddleware
{
      public static function middleware(): array
    {
        return [
               new Middleware('permission:view packages', only: ['index']),
               new Middleware('permission:create package', only: ['create']),
               new Middleware('permission:edit package', only: ['edit']),
               new Middleware('permission:delete package', only: ['destroy']),
        ];
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
        // $packages = Package::with('hotels')->orderBy('name','ASC')->paginate(12);

        
        // return view('packages.index', compact('packages'));
         $user = Auth::user();

    if ($user->hasRole('super_admin')) {
        $packages = Package::with('hotels')->orderBy('name','ASC')->paginate(12);
    } elseif ($user->hasRole('admin') || $user->hasRole('staff')) {
        $packages = Package::where('hotel_id', $user->hotel_id)
                            ->with('hotels')
                            ->orderBy('name','ASC')
                            ->paginate(12);
    } else {
        abort(403, 'Unauthorized');
    }

    return view('packages.index', compact('packages'));
        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $hotels = Hotel::all();
        return view('packages.create', compact('hotels'));
        

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $data = $request->validate([
            'name' =>'required|string|min:3|max:255',
            'description' => 'nullable|string|max:1000',
            'price' => 'required|numeric|min:0',
            'status' => 'required|in:active,inactive',
            'hotel_id' => 'nullable|integer|exists:hotels,id',
        ]);
        Package::create($data);
        return redirect()->route('packages.index')->with('success','package created');  

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $package = Package::findOrFail($id);
        return view('packages.show',[
            'package'=> $package
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $package = Package::findOrFail($id);
        $hotels = Hotel::get();
        return view('packages.edit',['package'=>$package,
    'hotels' => $hotels]);
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
        return redirect()->route('packages.index')->with('success','package updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $package=Package::findOrFail($id);
        $package->delete();
        return redirect()->route('packages.index')->with('success','package deleted');
    }
}
