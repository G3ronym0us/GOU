<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Admin',
            'lastname' => 'Admin',
            'phone' => '04249428608',
            'email' => 'admin@user.com',
            'password' => Hash::make('password'),
            'active' => 1,
        ]);
    }
}
