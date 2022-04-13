<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use App\Models\Permission;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\User\UserStoreRequest;
use App\Http\Requests\User\UserUpdateRequest;
use Illuminate\Support\Facades\Hash;
use App\Services\User\UserService;
use App\Services\Role\RoleService;
use App\Services\Permission\PermissionService;


class UserController extends Controller
{
    public function __construct(private UserService $userService, private RoleService $roleService, private PermissionService $permissionService) {}

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $users = $this->userService->getUserWithRoles();

        return view('pages.admin.users.index', compact('users'))->with('i',
            (request()->input('page', 1) - 1) * 20);
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        $roles = $this->roleService->getRolesByNameId();
        $permissions = $this->permissionService->getPermissionsByNameId();

        return view('pages.admin.users.create', compact('roles', 'permissions'));
    }

    /**
     * @param UserStoreRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(UserStoreRequest $request)
    {
        $this->userService->save($request);

        return redirect()->route('users.index')->with('success', 'User created successfully.');
    }


    /**
     * @param User $user
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function show(User $user)
    {
        return view('pages.admin.users.show', compact('user'));
    }

    /**
     * @param User $user
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit(User $user)
    {
        $roles = $this->roleService->getRolesByNameId();
        $permissions = $this->permissionService->getPermissionsByNameId();

        return view('pages.admin.users.edit', compact('user', 'roles', 'permissions'));
    }

    /**
     * @param UserUpdateRequest $request
     * @param User $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UserUpdateRequest $request, User $user)
    {
        $this->userService->update($request, $user);

        return redirect()->route('users.index')->with('success', 'User updated successfully.');
    }

    /**
     * @param User $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(User $user)
    {
        $this->userService->destroy($user);

        return redirect()->route('users.index')->with('success', 'User deleted.');
    }
}
