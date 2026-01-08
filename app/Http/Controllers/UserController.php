<?php

namespace App\Http\Controllers;

use App\Models\Hotel;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Role;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class UserController extends Controller implements HasMiddleware
{
     public static function middleware(): array
    {
        return [
               new Middleware('permission:view-users', only: ['index']),
               new Middleware('permission:create-user', only: ['create']),
               new Middleware('permission:edit-user', only: ['edit']),
               new Middleware('permission:delete-user', only: ['destroy']),
        ];
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::latest()->paginate(10);
         $roles = Role::where('guard_name','web')->orderBy('name','ASC')->get();
        return view('users.index',[
            'users' => $users,
            'roles'=>$roles
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
         $roles = Role::where('guard_name','web')->orderBy('name','ASC')->get();
        $hotels = Hotel::all();
        return view('users.create',[
            'roles' => $roles,
            'hotels' => $hotels
        ]);
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
            // Validation
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email',
        'address' => 'required|string|max:255',
        'contact' => 'required|string|min:10|max:20',
        'dob' => 'nullable|date',
        'password' => 'required|confirmed|min:6',
        'role' => 'required|exists:roles,name',
        'status' => 'required|in:active,inactive',
        'remark' => 'nullable|string|max:500',
    ], [
        'hotel_id.required_if' => 'Hotel is required when role is Staff.',
    ]);

    // Create User
    $user = User::create([
        'name' => $request->name,
        'email' => $request->email,
        'address' => $request->address,
        'contact' => $request->contact,
        'dob' => $request->dob,
        'password' => Hash::make($request->password),
        'status' => $request->status,
        'remark' => $request->remark,
    ]);

    // Assign Role
    $user->assignRole($request->role);

    // Assign hotel ONLY if role = staff
    if ($request->role === 'staff' && $request->hotel_id) {
        $hotel = Hotel::find($request->hotel_id);
        if ($hotel) {
            $hotel->user_id = $user->id; // assuming Hotel has user_id for staff
            $hotel->save();
        }
    }

    return redirect()->route('users.index')->with('success', 'User created successfully.');

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
        $user = User::findOrFail($id);
        $roles = Role::where('guard_name','web')->orderBy('name','ASC')->get();
        return view('users.edit',[
            'user'=> $user,
            'roles'=>$roles
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
         $user = User::findOrFail($id);
         $data = $request->validate([
            'name' => 'required|string|min:3|max:255',
             'email'=>'required|email|string|unique:users,email,'.$id.',id',
             'address' => 'required|string|max:500',
             'contact' => 'required|string|min:10|max:15',
             'password' => 'nullable|string|min:5|confirmed', 
             'status' => 'required|string|in:active,inactive',
             'dob' => 'nullable|date',
             'remarks' => 'nullable|string|max:500', 
        ]);
        if (!empty($data['password'])) {
        $data['password'] = Hash::make($data['password']);
         } else {
        unset($data['password']);
         }

        $user->update($data);

        $user->syncRoles($request->role);
        
         return redirect()
        ->route('users.index')
        ->with('success', 'User updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
         $user = User::findOrFail($id);
        $user->delete();
         return redirect()->route('users.index')->with('success','role deleted successfully');
    }
}
