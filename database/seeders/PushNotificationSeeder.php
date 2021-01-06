<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PushNotification;

class PushNotificationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        PushNotification::factory()->count(10)->create();
    }
}
