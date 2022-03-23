<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Enums\UserAccount;
use App\Enums\UserStatus;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role = Role::where('slug', 'admin')->first();
        $createTasks = Permission::where('slug', 'create-links')->first();
        $manageUsers = Permission::where('slug', 'manage-users')->first();

        $user = new User();
        $user->name = 'Administrator';
        $user->email = 'hope_g@mail.ru';
        $user->password = Hash::make('admin');
        // $user->account = (UserAccount::UNLIMIT)->value;
        // $user->status = (UserStatus::ACTIVE)->value;
        $user->save();
        $user->roles()->attach($role);
        $user->permissions()->attach($createTasks);
        $user->permissions()->attach($manageUsers);
    }
}
