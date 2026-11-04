<?php

namespace Database\Seeders;

use App\Models\Dokter;
use App\Models\Pasien;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $daftarDokter = Dokter::factory()->count(12)->create();

        Pasien::factory()
            ->count(35)
            ->recycle($daftarDokter)
            ->state(new Sequence(fn (Sequence $urutan) => [
                'no_rm' => 'RM-'.str_pad($urutan->index + 1, 6, '0', STR_PAD_LEFT),
            ]))
            ->create();
    }
}
