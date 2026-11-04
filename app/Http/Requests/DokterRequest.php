<?php

namespace App\Http\Requests;

use App\Models\Dokter;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class DokterRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'nama' => ['required', 'string', 'max:100'],
            'spesialisasi' => ['required', Rule::in(array_keys(Dokter::SPESIALISASI))],
            'no_str' => ['required', 'string', 'max:30', Rule::unique('dokter', 'no_str')->ignore($this->route('dokter'))],
            'no_telepon' => ['required', 'digits_between:10,15'],
        ];
    }
}
