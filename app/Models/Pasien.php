<?php

namespace App\Models;

use Database\Factories\PasienFactory;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Pasien extends Model
{
    /** @use HasFactory<PasienFactory> */
    use HasFactory;

    public const JENIS_KELAMIN = [
        'L' => 'Laki-laki',
        'P' => 'Perempuan',
    ];

    public const GOLONGAN_DARAH = [
        'A' => 'A',
        'B' => 'B',
        'AB' => 'AB',
        'O' => 'O',
    ];

    protected $table = 'pasien';

    protected $fillable = [
        'no_rm',
        'nik',
        'nama',
        'jenis_kelamin',
        'tanggal_lahir',
        'golongan_darah',
        'no_telepon',
        'dokter_id',
    ];

    protected function casts(): array
    {
        return [
            'tgl_lahir' => 'date',
        ];
    }

    protected function umur(): Attribute
    {
        return Attribute::get(fn () => $this->tanggal_lahir->age);
    }

    protected function namaJenisKelamin(): Attribute
    {
        return Attribute::get(fn () => self::JENIS_KELAMIN[$this->jenis_kelamin]);
    }

    public function dokter(): BelongsTo
    {
        return $this->belongsTo(Dokter::class);
    }
}
