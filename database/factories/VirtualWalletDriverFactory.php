<?php

namespace Database\Factories;

use App\Models\VirtualWalletDriver;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Driver;

class VirtualWalletDriverFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = VirtualWalletDriver::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'driver_id' => $this->faker->numberBetween(3, Driver::count()),
            'total_pending' => $this->faker->randomFloat(2, 0, NULL),
            'total_commission' => $this->faker->randomFloat(2, 0, NULL),
            'total_paid' => $this->faker->randomFloat(2, 0, NULL),
            'last_payment' => $this->faker->date('Y-m-d','now')
        ];
    }
}
