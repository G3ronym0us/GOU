<?php

namespace Database\Factories;

use App\Models\PushNotification;
use Illuminate\Database\Eloquent\Factories\Factory;

class PushNotificationFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = PushNotification::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->sentence(3, true),
            'content' => $this->faker->paragraph(6, true),
            'destination' => $this->faker->sentence(3, true)
        ];
    }
}
