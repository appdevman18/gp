<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\Permission;
use App\Http\Requests\Role\RoleStoreRequest;
use App\Http\Requests\Role\RoleUpdateRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Services\Role\RoleService;
use App\Services\Permission\PermissionService;

class RoleController extends Controller
{
    public function __construct(private RoleService $roleService, private PermissionService $permissionService) {}

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $roles = $this->roleService->getRolesByNamePaginate();

        return view('pages.admin.role.index', compact('roles'))->with('i', (request()->input('page', 1) - 1) * 20);
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        $permissions = $this->permissionService->getPermissionsByNameId();

        return view('pages.admin.role.create', compact('permissions'));
    }

    /**
     * @param RoleStoreRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(RoleStoreRequest $request)
    {
        $this->roleService->save($request);

        return redirect()->route('roles.index')->with('success', 'Role created successfully.');

    }

    /**
     * @param Role $role
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function show(Role $role)
    {
        return view('pages.admin.role.show', compact('role'));
    }

    /**
     * @param Role $role
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit(Role $role)
    {
        $permissions = $this->permissionService->getPermissionsByNameId();

        return view('pages.admin.role.edit', compact('role', 'permissions'));
    }

    /**
     * @param RoleUpdateRequest $request
     * @param Role $role
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(RoleUpdateRequest $request, Role $role)
    {
        $this->roleService->update($request, $role);

        return redirect()->route('roles.index')->with('success', 'Role updated successfully.');

    }

    /**
     * @param Role $role
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Role $role)
    {
        $this->roleService->destroy($role);

        return redirect()->route('roles.index')->with('success', 'Role deleted.');
    }
}
