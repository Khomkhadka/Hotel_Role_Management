<?php

namespace App\Http\Controllers\Hotel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class HotelRoleController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $hotel = Auth::guard('hotels')->user();
        // $roles = Role::with('permissions')->where('hotel_id', $hotel->id)->where('guard_name', 'staffs')->orderBy('name', 'ASC')->paginate(10);
        
        $roles = $hotel->roles()->paginate(10);
        
        return view('Hotel.hotel_role.index', [
            'roles' => $roles,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $permissions = Permission::orderBy('name', 'ASC')->where('guard_name', 'staffs')->get();
        return view('Hotel.hotel_role.create', [
            'permissions' => $permissions
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'display_name' => 'required|min:3',
            'permission' => 'array',
            'permission.*' => 'string|exists:permissions,name'
        ]);
        if ($validator->passes()) {

            // $slug = Str::slug($request->display_name);
                $slug = "hotel-". Auth::guard('hotels')->user()->id . "-".Str::slug($request->display_name);
            
        
            $role = Role::create([
                'display_name' => $request->display_name,
                'name' => $slug,
                'guard_name' => 'staffs',
            ]);

            if (!empty($request->permission)) {
                foreach ($request->permission as $name) {
                    $role->givePermissionTo($name);
                }
            }
            $hotel = Auth::guard('hotels')->user();

            $hotel->roles()->attach($role->id);

            //    $hotel_id = Auth::guard('hotels')->user()->id;
            // $role->hotels()->attach($hotel_id);
            return redirect()->route('hotel_roles.index')->with('success', 'roles added successfully');
        } else {
            return redirect()->route('hotel_roles.create')->withInput()->withErrors($validator);
        }
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
        $role = Role::findOrFail($id);
        $hasPermissions = $role->permissions->pluck('name');
        $permissions = Permission::orderBy('name', 'ASC')->where('guard_name', 'staffs')->get();



        return view('Hotel.hotel_role.edit', [
            'permissions' => $permissions,
            'hasPermissions' => $hasPermissions,
            'role' => $role
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
       
        $role = Role::findOrFail($id);
        $validator = Validator::make($request->all(), [
            'display_name' => 'required|unique:roles,name,' . $id . '|min:3'
        ]);
        if ($validator->passes()) {

            $role->display_name = $request->display_name;
            $role->name = Str::slug($request->display_name);
            $role->save();
            if (!empty($request->permission)) {
                if ($request->permission) {
                    $role->syncPermissions($request->permission);
                } else {
                    $role->syncPermissions([]);
                }
            }
            return redirect()->route('hotel_roles.index')->with('success', 'role updated successfully');
        } else {
            return redirect()->route('hotel_roles.edit', $id)->withInput()->withErrors($validator);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $role = Role::findOrFail($id);
        $role->delete();
        return redirect()->route('hotel_roles.index')->with('success', 'role deleted successfully');
    }
}
