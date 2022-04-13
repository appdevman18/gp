<?php

namespace App\Services\Permission;

use App\Models\Permission;
use App\Services\Dto\PermissionData;
use App\Services\Role\RoleService;
use Illuminate\Http\Request;


final class PermissionService
{
    /**
     * @param Request $request
     * @return Permission
     */
    public function save(Request $request): Permission
    {
        $roles = (new RoleService())->getRoleById($request['roles']);

        $permissionData = PermissionData::fromRequest($request);
        $permission = new Permission();

        $permission->name = $permissionData->name;
        $permission->slug = $permissionData->slug;
        $permission->save();

        if (!$permission->save()) {
            return 'false';
        }

        $permission->roles()->attach($roles);

        return $permission;
    }

    /**
     * @param Request $request
     * @param Permission $permission
     * @return Permission
     */
    public function update(Request $request, Permission $permission): Permission
    {
        $roles = (new RoleService())->getRoleById($request['roles']);

        $permissionData = PermissionData::fromRequest($request);

        $permission->name = $permissionData->name;
        $permission->slug = $permissionData->slug;
        $permission->update();

        if (!$permission->update()) {
            return 'false';
        }

        $permission->roles()->sync($roles);

        return $permission;
    }

    /**
     * @param Permission $permission
     * @return bool
     */
    public function destroy(Permission $permission)
    {
        $permission->roles()->detach();
        $permission->delete();

        return true;
    }

    /**
     * @return mixed
     */
    public function getPermissionsByNameId()
    {
        return Permission::select('name', 'id')->get();
    }

    /**
     * @param $permissionId
     * @return mixed
     */
    public function getPermissionById($permissionId)
    {
        return Permission::findOrFail($permissionId);
    }

    /**
     * @return mixed
     */
    public function getPermissionsByNamePaginate()
    {
        return Permission::orderBy('name', 'asc')->simplePaginate(20);
    }

}
