<?php

namespace App\Http\Requests;

use App\Models\Pasien;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PasienRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'nik' => ['required', 'digits:16', Rule::unique('pasien', 'nik')->ignore($this->id)],
            'nama' => ['required', 'string', 'max:100'],
            'jenis_kelamin' => ['required', Rule::in(array_keys(Pasien::JENIS_KELAMIN))],
            'tanggal_lahir' => ['required', 'date', 'before_or_equal:today'],
            'golongan_darah' => ['required', Rule::in(array_keys(Pasien::GOLONGAN_DARAH))],
            'no_telepon' => ['required', 'digits_between:10,15'],
            'alamat' => ['required', 'string', 'max:255'],
            'dokter_id' => ['required', Rule::exists('dokter', 'id')],
        ];
    }
}
