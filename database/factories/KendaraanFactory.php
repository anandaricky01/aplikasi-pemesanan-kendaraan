<?php

namespace Database\Factories;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Kendaraan>
 */
class KendaraanFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'plat_no' => $this->faker->numerify('N #### ') . strtoupper(Str::random(3)),
            'status_kendaraan_id' => $this->faker->numberBetween(1,3)
        ];
    }
}
