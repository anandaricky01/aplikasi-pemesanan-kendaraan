<?php

namespace Database\Factories;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\RiwayatKendaraan>
 */
class RiwayatKendaraanFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'kode_kegiatan' => $this->faker->numerify('ST-###/K/#/') . strtoupper(Str::random(7)),
            'kendaraan_id' => $this->faker->numberBetween(1,15),
            'driver_id' => $this->faker->numberBetween(1,10),
            'bbm_liter' => $this->faker->numberBetween(12,20),
            'tanggal_digunakan' => $this->faker->dateTimeBetween('-1 week', 'now'),
            'tanggal_selesai' => $this->faker->dateTimeBetween('now','+1 week'),
            'tujuan' => $this->faker->address()
        ];
    }
}
