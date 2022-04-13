<?php

namespace App\Services\User;

use App\Models\User;
use App\Models\Role;
use App\Models\Permission;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\User\UserStoreRequest;
use App\Services\Dto\UserData;
use App\Services\Dto\RoleData;
use App\Services\Dto\PermissionData;
use App\Services\Role\RoleService;
use App\Services\Permission\PermissionService;
use Illuminate\Http\Request;
use App\Enums\UserAccount;
use App\Enums\UserStatus;


final class UserService
{
    /**
     * @param Request $request
     * @return User
     */
    public function save(Request $request): User
    {
        $role = (new RoleService())->getRoleById($request['role']);
        $permissions = (new PermissionService())->getPermissionById($request['permissions']);

        $userData = UserData::fromRequest($request);
        $user = new User();
        $user->name = $userData->name;
        $user->email = $userData->email;
        if (null != $request['password']) {
            $user->password = Hash::make($userData->password);
        }
        $user->account = $userData->account;
        $user->status = $userData->status;
        $user->phone = $userData->phone;
        $user->telegram_username = $userData->telegram_username;
        $user->save();

        if (!$user->save()) {
            // throw new \Illuminate\Database\QueryException('User dont create or update.');
        }

        $user->roles()->attach($role);
        $user->permissions()->attach($permissions);

        return $user;
    }

    /**
     * @param Request $request
     * @param User $user
     * @return User
     */
    public function update(Request $request, User $user): User
    {
        $role = (new RoleService())->getRoleById($request['role']);
        $permissions = (new PermissionService())->getPermissionById($request['permissions']);

        $userData = UserData::fromRequest($request);

        $user->name = $userData->name;
        $user->email = $userData->email;
        if (null != $request['password']) {
            $user->password = Hash::make($userData->password);
        }
        $user->account = $userData->account;
        $user->status = $userData->status;
        $user->phone = $userData->phone;
        $user->telegram_username = $userData->telegram_username;

        $user->update();
        if (!$user->update()) {
            // throw new \Illuminate\Database\QueryException('User dont create or update.');
        }

        $user->roles()->sync($role);
        $user->permissions()->sync($permissions);

        return $user;
    }

    /**
     * @param User $user
     * @return bool
     */
    public function destroy(User $user)
    {
        $user = User::findOrFail($user->id);
        $user->roles()->detach();
        $user->permissions()->detach();
        $user->delete();

        return true;
    }

    /**
     * @return \Illuminate\Contracts\Pagination\Paginator
     */
    public function getUserWithRoles()
    {
        return User::with(['roles'])->simplePaginate(20);
    }

    /**
     * @return int
     */
    public function getUserQuantityProducts(): int
    {
        return count(auth()->user()->products);
    }

    /**
     * @param User $user
     * @return int
     */
    public function userQuantityProductsLimit(User $user): int
    {
        if ($user->account == UserAccount::FREE) {

            return UserAccount::free(UserAccount::FREE);

        } elseif ($user->account == UserAccount::PAID) {

            return UserAccount::paid(UserAccount::PAID);

        } else {

            return UserAccount::unlimit(UserAccount::UNLIMIT);
        }
    }

    /**
     * @return bool
     */
    public function isCanCreateProduct(): bool
    {
        $userProducts = $this->getUserQuantityProducts();
        $limit = $this->userQuantityProductsLimit(auth()->user());

        return $userProducts < $limit ? true : false;
    }
}
