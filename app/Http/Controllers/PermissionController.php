<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Permission;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Str;

class PermissionController extends Controller implements HasMiddleware
{
      public static function middleware(): array
    {
        return [
               new Middleware('permission:view-permissions', only: ['index']),
               new Middleware('permission:create-permission', only: ['create']),
               new Middleware('permission:edit-permission', only: ['edit']),
               new Middleware('permission:delete-permission', only: ['destroy']),
        ];
    }
    /**
     * Display a listing of the resource.
     */
    // public function index()
    // {
    //     $hotel_permissions = Permission::where('guard_name','staffs')->orderBy('created_at','DESC')->paginate(10);
    //     $admin_permissions = Permission::where('guard_name','web')->orderBy('created_at','DESC')->paginate(10);
    //     return view('permissions.list',[
    //         'admin_permissions' => $admin_permissions,
    //         'hotel_permissions' => $hotel_permissions
    //     ]);
    // }
    public function index(Request $request)
{
    // Determine active tab (default: hotel)
    $tab = $request->get('tab', 'hotel');

    // Fetch permissions based on tab
    $permissions = Permission::where('guard_name', $tab === 'admin' ? 'web' : 'staffs')
        ->orderBy('name','ASC')
        ->paginate(10)
        ->withQueryString(); // keeps tab param during pagination

    return view('permissions.list', compact('permissions', 'tab'));
}


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('permissions.create');
       
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'display_name'=> 'required|unique:permissions|min:3',
            'guard_name'=>'required|in:staffs,web',
        ]);
        if ($validator->passes()) {
            Permission::create([
                'display_name' => $request->display_name,
                'name'=>Str::slug($request->display_name),
                'guard_name'=>$request->guard_name
        ]);
            return redirect()->route('permissions.index')->with('success','permission added successfully');
        }else{
             return redirect()->route('permissions.create')->withInput()->withErrors($validator);
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
         return view('permissions.edit',[
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
            'display_name'=> 'required|unique:permissions,name,'.$id.',id|min:3',
            // 'guard_name'=>'required|in:staffs,web',
        ]);
        
        if ($validator->passes()) {
            // Permission::create(['name' => $request->name]);
            $permission->display_name = $request->display_name;
            $permission->name = Str::slug($request->display_name);
            
            $permission->save();
            return redirect()->route('permissions.index')->with('success','permission updated successfully');
        }else{
             return redirect()->route('permissions.edit',$id)->withInput()->withErrors($validator);
        }
         
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
         $permission = Permission::findOrFail($id);
         $permission->delete();
         return redirect()->route('permissions.index')->with('success','permission deleted successfully');
    }
}
