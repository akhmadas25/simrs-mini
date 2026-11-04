<?php

namespace App\Models;

use Database\Factories\DokterFactory;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dokter extends Model
{
    /** @use HasFactory<DokterFactory> */
    use HasFactory;

    public const SPESIALISASI = [
        'Umum' => 'Dokter Umum',
        'Anak' => 'Spesialis Anak',
        'Penyakit Dalam' => 'Spesialis Penyakit Dalam',
        'Kandungan' => 'Spesialis Kandungan',
        'Bedah' => 'Spesialis Bedah',
        'Jantung' => 'Spesialis Jantung',
        'Saraf' => 'Spesialis Saraf',
        'Mata' => 'Spesialis Mata',
        'THT' => 'Spesialis THT',
        'Kulit' => 'Spesialis Kulit dan Kelamin',
    ];

    protected $table = 'dokter';

    protected $fillable = [
        'nama',
        'spesialisasi',
        'no_str',
        'no_telepon',
    ];

    protected function namaSpesialisasi(): Attribute
    {
        return Attribute::get(fn () => self::SPESIALISASI[$this->spesialisasi]);
    }
}
