<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use App\Models\Price;
use App\Models\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role = Role::where('slug', 'customer')->first();
        $createTasks = Permission::where('slug', 'create-links')->first();
        // $manageUsers = Permission::where('slug', 'manage-users')->first();

        // $user = new User();
        // $user->name = 'Administrator';
        // $user->email = 'hope_g@mail.ru';
        // $user->password = Hash::make('test');
        // $user->save();
        // $user->roles()->attach($role);
        // $user->permissions()->attach($createTasks);
        // $user->permissions()->attach($manageUsers);

        User::factory()
            ->count(20)
            ->hasAttached($role)
            ->hasAttached($createTasks)
            ->has(Product::factory(5)->has(Price::factory(10)))
            ->create();
    }
}
