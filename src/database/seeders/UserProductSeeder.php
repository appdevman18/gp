<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users_products')->insert(
            [
                'user_id'    => rand(1, 21),
                'product_id' => rand(1, 100),
            ]
        );
    }
}
