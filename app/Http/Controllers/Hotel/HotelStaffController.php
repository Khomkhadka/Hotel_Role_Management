<?php

namespace App\Http\Controllers\Hotel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Staff;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class HotelStaffController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $hotelId = auth('hotels')->id();
        $hotelRoles = Role::where('guard_name', 'staffs')->get();
        $staffs = Staff::with('roles:id,name')->where('hotel_id', $hotelId)->paginate(10)->through(function ($staff) {
            return collect([
                'id' =>$staff->id,
                'name' => $staff->name,
                'email' => $staff->email,
                'address' => $staff->address,
                'roles' => implode($staff->roles()->pluck('name')->toArray()),
                'contact' => $staff->contact,
                'remake' => $staff->remake,
                'status' => $staff->status,
            ]);
        });
        // ->orderBy('name', 'ASC')
        // ->paginate(10);
        // dd($staffs);

        return view('Hotel.hotel_staff.index', compact('staffs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $hotelId = auth('hotels')->id();
        $hotelRoles = Role::where('guard_name', 'staffs')->get();
        return view('Hotel.hotel_staff.create', [
            'hotelId' => $hotelId,
            'roles' => $hotelRoles,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Staff::create([
            'name' => $request->name,
            'email' => $request->email,
            'address' => $request->address,
            'contact' => $request->contact,
            'password' => Hash::make($request->password),
            'status' => $request->status,
            'remake' => $request->remake,
            'hotel_id' => $request->hotel_id,
        ]);
        return redirect()->route('hotel_staffs.index')->with('success', 'staff created');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // Permission::create(['guard_name'=>'staffs','name'=> "check users"]);
        $staff = Staff::findOrFail($id);
        // dd($staff->permissions);
        $hotel = Auth::guard('hotels')->user();
         $roles = $hotel->roles()->get();
        // $hotelRoles = Role::where('guard_name', 'staffs')->get();
        $hotelId = auth('hotels')->id();
        return view('Hotel.hotel_staff.edit', [
            'staff' => $staff,
            'hotelId' => $hotelId,
            'roles' => $roles,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // dd($request->all());
        $staff = Staff::findOrFail($id);
        $data = $request->validate([
            'name' => 'required|string|min:3|max:255',
            'email' => 'required|email|string|unique:hotels,email,' . $staff->id,
            'address' => 'required|string|max:500',
            'contact' => 'required|string|min:10|max:15',
            'password' => 'nullable|string|min:5|confirmed',
            'status' => 'required|string|in:active,inactive',
            'remake' => 'nullable|string|max:500',
            'hotel_id' => 'required|exists:users,id',
            'role' => 'nullable|exists:roles,name'
        ]);

        // Handle password only if provided
        if (!empty($data['password'])) {
            $data['password'] = bcrypt($data['password']);
        } else {
            unset($data['password']); // leave old password intact
        }

        $staff->update($data);
        if ($data['role']) {
            // Remove all current roles
            $staff->roles()->detach();

            // Assign the new role
            $staff->assignRole($data['role']);
        }
        return redirect()->route('hotel_staffs.index')->with('success', 'staff updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $staff = Staff::findOrFail($id);
        $staff->delete();
        return redirect()->route('hotel_staffs.index')->with('success', 'staff deleted');
    }
}
