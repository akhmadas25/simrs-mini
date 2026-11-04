<?php

namespace Database\Factories;

use App\Models\Dokter;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Dokter>
 */
class DokterFactory extends Factory
{
    public function definition(): array
    {
        return [
            'nama' => 'dr. '.fake()->name(),
            'spesialisasi' => fake()->randomElement(array_keys(Dokter::SPESIALISASI)),
            'no_str' => fake()->unique()->numerify('################'),
            'no_telepon' => fake()->numerify('08##########'),
        ];
    }
}
