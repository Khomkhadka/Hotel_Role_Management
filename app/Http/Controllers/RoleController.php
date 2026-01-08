<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Str;

class RoleController extends Controller implements HasMiddleware
{
     public static function middleware(): array
    {
        return [
               new Middleware('permission:view-roles', only: ['index']),
               new Middleware('permission:create-role', only: ['create']),
               new Middleware('permission:edit-role', only: ['edit']),
               new Middleware('permission:delete-role', only: ['destroy']),
        ];
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roles = Role::where('guard_name','web')->get();
        return view('roles.index',[
            'roles' => $roles
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $permissions = Permission::where('guard_name','web')->orderBy('name','ASC')->get();
        
        return view('roles.create',[
            'permissions' => $permissions
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {     
          $validator = Validator::make($request->all(),[
            'display_name'=> 'required|unique:roles|min:3'
        ]);
       
        if ($validator->passes()) {
           $role = Role::create([
            'display_name'=> $request->display_name,
            'name' => Str::slug($request->display_name),
        ]);
          
            if (!empty($request->permission)){
                foreach ($request->permission as $name){
                   $role->givePermissionTo($name);
                }

            }
            return redirect()->route('roles.index')->with('success','roles added successfully');
        }else{
             return redirect()->route('roles.create')->withInput()->withErrors($validator);
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
        $permissions = Permission::where('guard_name','web')->orderBy('name','ASC')->get();
        
        return view('roles.edit',[
            'permissions' => $permissions,
            'hasPermissions'=> $hasPermissions,
            'role'=>$role
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {   
        $role = Role::findOrFail($id);
           $validator = Validator::make($request->all(),[
            'display_name'=> 'required|unique:roles,name,'.$id.'|min:3'
            
        ]);
        if ($validator->passes()) {
           
          $role->display_name = $request->display_name;
          $role->name = Str::slug($request->display_name);
          $role->save();
            if (!empty($request->permission)){
                if ($request->permission){
                   $role->syncPermissions($request->permission);

                }else{
                     $role->syncPermissions([]);
                }

            }
            return redirect()->route('roles.index')->with('success','role updated successfully');
        }else{
             return redirect()->route('roles.edit',$id)->withInput()->withErrors($validator);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $role = Role::findOrFail($id);
        $role->delete();
         return redirect()->route('roles.index')->with('success','role deleted successfully');
    }
}
