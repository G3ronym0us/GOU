<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('brands')->insert([
            'name' => 'Ford',
        ]);
        DB::table('brands')->insert([
            'name' => 'Chevrolet',
        ]);
        DB::table('brands')->insert([
            'name' => 'Nicsan',
        ]);
        DB::table('brands')->insert([
            'name' => 'Toyota',
        ]);
    }
}
