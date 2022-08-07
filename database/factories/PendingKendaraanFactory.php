<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PendingKendaraan>
 */
class PendingKendaraanFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'kendaraan_id' => $this->faker->numberBetween(1,15),
            'driver_id' => $this->faker->numberBetween(1,10)
        ];
    }
}
