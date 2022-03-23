<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $manager = new Role();
        $manager->name = 'Admin';
        $manager->slug = 'admin';
        $manager->save();
        $customer = new Role();
        $customer->name = 'Manager';
        $customer->slug = 'manager';
        $customer->save();
        $customer = new Role();
        $customer->name = 'Customer';
        $customer->slug = 'customer';
        $customer->save();
    }
}
