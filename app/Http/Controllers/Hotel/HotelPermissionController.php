<?php

namespace App\Http\Controllers\Hotel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Permission;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;


class HotelPermissionController extends Controller   //implements HasMiddleware
{
      public static function middleware(): array
    {
        return [
               new Middleware('permission:view permissions', only: ['index']),
               new Middleware('permission:create permission', only: ['create']),
               new Middleware('permission:edit permission', only: ['edit']),
               new Middleware('permission:delete permission', only: ['destroy']),
        ];
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $permissions = Permission::where('guard_name','staffs')->paginate(10);
        return view('Hotel.hotel_permission.index',[
            'permissions' => $permissions
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('Hotel.hotel_permission.create');
       
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'name'=> 'required|unique:permissions|min:3'
        ]);
        if ($validator->passes()) {
            Permission::create(['guard_name' => "staffs",'name' => $request->name]);
            return redirect()->route('hotel_permissions.index')->with('success','permission added successfully');
        }else{
             return redirect()->route('hotel_permissions.create')->withInput()->withErrors($validator);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $permissions = Permission::findOrFail($id);
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
         $permission = Permission::findOrFail($id);
         return view('Hotel.hotel_permission.edit',[
            'permission' => $permission
         ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
         $permission = Permission::findOrFail($id);
          $validator = Validator::make($request->all(),[
            'name'=> 'required|unique:permissions,name,'.$id.',id|min:3'
        ]);
        if ($validator->passes()) {
            // Permission::create(['name' => $request->name]);
            $permission->name = $request->name;
            $permission->save();
            return redirect()->route('hotel_permissions.index')->with('success','permission updated successfully');
        }else{
             return redirect()->route('hotel_permissions.edit',$id)->withInput()->withErrors($validator);
        }
         
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
         $permission = Permission::findOrFail($id);
         $permission->delete();
         return redirect()->route('hotel_permissions.index')->with('success','permission deleted successfully');
    }
}
