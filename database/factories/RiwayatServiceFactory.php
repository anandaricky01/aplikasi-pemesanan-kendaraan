<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\RiwayatService>
 */
class RiwayatServiceFactory extends Factory
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
            'tanggal_service' => $this->faker->dateTimeBetween('-7 month', 'now'),
            'tanggal_keluar' => $this->faker->dateTimeBetween('now')
        ];
    }
}
