<?php

namespace Database\Factories;

use App\Models\Dokter;
use App\Models\Pasien;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Pasien>
 */
class PasienFactory extends Factory
{
    public function definition(): array
    {
        $jenisKelamin = fake()->randomElement(array_keys(Pasien::JENIS_KELAMIN));

        return [
            'no_rm' => fake()->unique()->numerify('RM-######'),
            'nik' => fake()->unique()->numerify('3###############'),
            'nama' => fake()->name($jenisKelamin === 'L' ? 'male' : 'female'),
            'jenis_kelamin' => $jenisKelamin,
            'tanggal_lahir' => fake()->dateTimeBetween('-80 years', '-1 year'),
            'golongan_darah' => fake()->randomElement(array_keys(Pasien::GOLONGAN_DARAH)),
            'no_telepon' => fake()->numerify('08##########'),
            'alamat' => fake()->address(),
            'dokter_id' => Dokter::factory(),
        ];
    }
}
