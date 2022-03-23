<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\Permission;
use App\Http\Requests\Role\RoleStoreRequest;
use App\Http\Requests\Role\RoleUpdateRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = Role::with('permissions')->orderBy('created_at', 'desc')->simplePaginate(20);
        
        return view('pages.admin.role.index', compact('roles'))->with('i', (request()->input('page', 1) - 1) * 20);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $permissions = Permission::select('name', 'id')->get();
        
        return view('pages.admin.role.create', compact('permissions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RoleStoreRequest $request)
    {
        $permissions = Permission::find($request['permissions']);

        $role = new Role();
        $role->name = $request['name'];
        $role->slug = Str::slug($role->name);
        $role->save();

        if (!$role->save()) {
            return redirect()->back()->with('error', 'Role dont created successfully.');
        }

        $role->permissions()->attach($permissions);

        return redirect()->route('roles.index')->with('success', 'Role created successfully.');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function show(Role $role)
    {
        return view('pages.admin.role.show', compact('role'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role)
    {
        $permissions = $role->getRolesById();

        return view('pages.admin.role.edit', compact('role', 'permissions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function update(RoleUpdateRequest $request, Role $role)
    {
        $permissions = Permission::find($request['permissions']);

        $role->name = $request['name'];
        $role->slug = Str::slug($role->name);
        $role->update();

        if (!$role->update()) {
            return redirect()->back()->with('error', 'Role dont updated successfully.');
        }

        $role->permissions()->sync($permissions);

        return redirect()->route('roles.index')->with('success', 'Role updated successfully.');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role)
    {
        $role->permissions()->detach();
        $role->delete();

        return redirect()->route('roles.index')->with('success', 'Role deleted.');
    }
}
