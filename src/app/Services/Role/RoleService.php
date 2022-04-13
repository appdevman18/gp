<?php

namespace App\Services\Role;

use App\Models\Role;
use App\Services\Dto\RoleData;
use App\Services\Permission\PermissionService;
use Illuminate\Http\Request;


final class RoleService
{
    /**
     * @param Request $request
     * @return Role
     */
    public function save(Request $request): Role
    {
        $permissions =(new PermissionService())->getPermissionById($request['permissions']);

        $roleData = RoleData::fromRequest($request);
        $role = new Role();

        $role->name = $roleData->name;
        $role->slug = $roleData->slug;
        $role->save();

        if (!$role->save()) {
            return false;
        }

        $role->permissions()->attach($permissions);

        return $role;
    }

    /**
     * @param Request $request
     * @param Role $role
     * @return Role
     */
    public function update(Request $request, Role $role): Role
    {
        $permissions =(new PermissionService())->getPermissionById($request['permissions']);

        $roleData = RoleData::fromRequest($request);

        $role->name = $roleData->name;
        $role->slug = $roleData->slug;
        $role->update();

        if (!$role->update()) {
            return false;
        }

        $role->permissions()->sync($permissions);

        return $role;
    }

    /**
     * @param Role $role
     * @return bool
     */
    public function destroy(Role $role)
    {
        $role->permissions()->detach();
        $role->delete();

        return true;
    }

    /**
     * @return mixed
     */
    public function getRolesByNameId()
    {
        return Role::select('name', 'id')->get();
    }

    /**
     * @param $roleId
     * @return mixed
     */
    public function getRoleById($roleId)
    {
        return Role::findOrFail($roleId);
    }

    /**
     * @return mixed
     */
    public function getRolesByNamePaginate()
    {
        return Role::orderBy('name', 'asc')->simplePaginate(20);
    }

}
