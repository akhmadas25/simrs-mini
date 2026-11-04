@extends('layouts.app')

@section('judul', $dokter->exists ? 'Ubah Data Dokter' : 'Tambah Dokter')

@section('konten')
    <header class="d-flex flex-wrap align-items-start justify-content-between gap-3 mb-4">
        <div>
            <h1 class="h4 fw-bold mb-1">{{ $dokter->exists ? 'Ubah Data Dokter' : 'Tambah Dokter' }}</h1>
            <p class="text-body-secondary mb-0">Semua kolom wajib diisi.</p>
        </div>

        <div class="d-flex gap-2">
            <a href="{{ route('dokter.daftar') }}" class="btn btn-outline-secondary">
                <svg class="ikon" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="m12 19-7-7 7-7"/><path d="M19 12H5"/></svg> Kembali
            </a>
        </div>
    </header>

    <form method="POST" action="{{ $dokter->exists ? route('dokter.perbarui', $dokter) : route('dokter.simpan') }}" class="card shadow-sm form-kartu">
        @csrf
        @if ($dokter->exists)
            @method('PUT')
        @endif

        <div class="card-body p-4">
            @if ($errors->any())
                <div class="alert alert-danger" role="alert">
                    <strong>Data belum dapat disimpan. Periksa kembali isian berikut:</strong>
                    <ul class="mt-1 mb-0">
                        @foreach ($errors->all() as $pesan)
                            <li>{{ $pesan }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="row g-3">
                <div class="col-12 col-md-6">
                    <label for="nama" class="form-label fw-semibold">Nama Lengkap</label>
                    <input type="text" id="nama" name="nama" value="{{ old('nama', $dokter->nama) }}" @class(['form-control', 'is-invalid' => $errors->has('nama')]) placeholder="Contoh: dr. Andi Wijaya">
                    @error('nama')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-12 col-md-6">
                    <label for="spesialisasi" class="form-label fw-semibold">Spesialisasi</label>
                    <select id="spesialisasi" name="spesialisasi" @class(['form-select', 'is-invalid' => $errors->has('spesialisasi')])>
                        <option value="" disabled @selected(old('spesialisasi', $dokter->spesialisasi) === null)>Pilih spesialisasi</option>
                        @foreach (App\Models\Dokter::SPESIALISASI as $nilai => $teks)
                            <option value="{{ $nilai }}" @selected(old('spesialisasi', $dokter->spesialisasi) == $nilai)>{{ $teks }}</option>
                        @endforeach
                    </select>
                    @error('spesialisasi')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-12 col-md-6">
                    <label for="no_str" class="form-label fw-semibold">No. STR</label>
                    <input type="text" id="no_str" name="no_str" value="{{ old('no_str', $dokter->no_str) }}" @class(['form-control', 'is-invalid' => $errors->has('no_str')]) placeholder="Nomor Surat Tanda Registrasi">
                    @error('no_str')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-12 col-md-6">
                    <label for="no_telepon" class="form-label fw-semibold">No. Telepon</label>
                    <input type="text" id="no_telepon" name="no_telepon" value="{{ old('no_telepon', $dokter->no_telepon) }}" @class(['form-control', 'is-invalid' => $errors->has('no_telepon')]) inputmode="numeric" placeholder="08xxxxxxxxxx">
                    @error('no_telepon')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>

        <div class="card-footer bg-body-tertiary d-flex justify-content-end gap-2 px-4 py-3">
            <a href="{{ route('dokter.daftar') }}" class="btn btn-outline-secondary">Batal</a>
            <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
    </form>
@endsection
