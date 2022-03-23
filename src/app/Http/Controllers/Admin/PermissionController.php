<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\Permission;
use App\Http\Requests\Permission\PermissionStoreRequest;
use App\Http\Requests\Permission\PermissionUpdateRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $permissions = Permission::orderBy('name', 'asc')->simplePaginate(20);
        
        return view('pages.admin.permission.index', compact('permissions'))->with('i', (request()->input('page', 1) - 1) * 20);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::select('name', 'id')->get();
        
        return view('pages.admin.permission.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PermissionStoreRequest $request)
    {
        $roles = Role::find($request['roles']);

        $permission = new Permission();
        $permission->name = $request['name'];
        $permission->slug = Str::slug($permission->name);
        $permission->save();

        if (!$permission->save()) {
            return redirect()->back()->with('error', 'Permission dont created successfully.');
        }

        $permission->roles()->attach($roles);

        return redirect()->route('permissions.index')->with('success', 'Permission created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function show(Permission $permission)
    {
        return view('pages.admin.permission.show', compact('permission'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function edit(Permission $permission)
    {
        $roles = $permission->getRolesById();

        return view('pages.admin.permission.edit', compact('permission', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function update(PermissionUpdateRequest $request, Permission $permission)
    {
        $roles = Role::find($request['roles']);

        $permission->name = $request['name'];
        $permission->slug = Str::slug($permission->name);
        $permission->update();

        if (!$permission->update()) {
            return redirect()->back()->with('error', 'Permission dont updated successfully.');
        }

        $permission->roles()->sync($roles);

        return redirect()->route('permissions.index')->with('success', 'Permission updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function destroy(Permission $permission)
    {
        $permission->roles()->detach();
        $permission->delete();

        return redirect()->route('permissions.index')->with('success', 'Permission deleted.');
    }
}
