<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\Permission;
use App\Http\Requests\Permission\PermissionStoreRequest;
use App\Http\Requests\Permission\PermissionUpdateRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Services\Role\RoleService;
use App\Services\Permission\PermissionService;

class PermissionController extends Controller
{
    public function __construct(private RoleService $roleService, private PermissionService $permissionService) {}

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $permissions = $this->permissionService->getPermissionsByNamePaginate();

        return view('pages.admin.permission.index', compact('permissions'))->with('i', (request()->input('page', 1) - 1) * 20);
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        $roles = $this->roleService->getRolesByNameId();

        return view('pages.admin.permission.create', compact('roles'));
    }

    /**
     * @param PermissionStoreRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(PermissionStoreRequest $request)
    {
        $this->permissionService->save($request);

        return redirect()->route('permissions.index')->with('success', 'Permission created successfully.');
    }

    /**
     * @param Permission $permission
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function show(Permission $permission)
    {
        return view('pages.admin.permission.show', compact('permission'));
    }

    /**
     * @param Permission $permission
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit(Permission $permission)
    {
        $roles = $this->roleService->getRolesByNameId();

        return view('pages.admin.permission.edit', compact('permission', 'roles'));
    }

    /**
     * @param PermissionUpdateRequest $request
     * @param Permission $permission
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(PermissionUpdateRequest $request, Permission $permission)
    {
        $this->permissionService->update($request, $permission);

        return redirect()->route('permissions.index')->with('success', 'Permission updated successfully.');
    }

    /**
     * @param Permission $permission
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Permission $permission)
    {
        $this->permissionService->destroy($permission);

        return redirect()->route('permissions.index')->with('success', 'Permission deleted.');
    }
}
