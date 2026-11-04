@extends('layouts.app')

@section('judul', $pasien->exists ? 'Ubah Data Pasien' : 'Tambah Pasien')

@section('konten')
    <header class="d-flex flex-wrap align-items-start justify-content-between gap-3 mb-4">
        <div>
            <h1 class="h4 fw-bold mb-1">{{ $pasien->exists ? 'Ubah Data Pasien' : 'Tambah Pasien' }}</h1>
            <p class="text-body-secondary mb-0">Semua kolom wajib diisi.</p>
        </div>

        <div class="d-flex gap-2">
            <a href="{{ route('pasien.daftar') }}" class="btn btn-outline-secondary">
                <svg class="ikon" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="m12 19-7-7 7-7"/><path d="M19 12H5"/></svg> Kembali
            </a>
        </div>
    </header>

    <form method="POST" action="{{ $pasien->exists ? route('pasien.perbarui', $pasien) : route('pasien.simpan') }}" class="card shadow-sm form-kartu">
        @csrf
        @if ($pasien->exists)
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
                    <label for="nik" class="form-label fw-semibold">NIK</label>
                    <input type="text" id="nik" name="nik" value="{{ old('nik', $pasien->nik) }}" @class(['form-control', 'is-invalid' => $errors->has('nik')]) inputmode="numeric" maxlength="16" placeholder="16 digit NIK">
                    @error('nik')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-12 col-md-6">
                    <label for="nama" class="form-label fw-semibold">Nama Lengkap</label>
                    <input type="text" id="nama" name="nama" value="{{ old('nama', $pasien->nama) }}" @class(['form-control', 'is-invalid' => $errors->has('nama')]) placeholder="Nama sesuai KTP">
                    @error('nama')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-12 col-md-6">
                    <label for="jenis_kelamin" class="form-label fw-semibold">Jenis Kelamin</label>
                    <select id="jenis_kelamin" name="jenis_kelamin" @class(['form-select', 'is-invalid' => $errors->has('jenis_kelamin')])>
                        <option value="" disabled @selected(old('jenis_kelamin', $pasien->jenis_kelamin) === null)>Pilih jenis kelamin</option>
                        @foreach (App\Models\Pasien::JENIS_KELAMIN as $nilai => $teks)
                            <option value="{{ $nilai }}" @selected(old('jenis_kelamin', $pasien->jenis_kelamin) == $nilai)>{{ $teks }}</option>
                        @endforeach
                    </select>
                    @error('jenis_kelamin')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-12 col-md-6">
                    <label for="tanggal_lahir" class="form-label fw-semibold">Tanggal Lahir</label>
                    <input type="date" id="tanggal_lahir" name="tanggal_lahir" value="{{ old('tanggal_lahir', $pasien->tanggal_lahir?->format('Y-m-d')) }}" @class(['form-control', 'is-invalid' => $errors->has('tanggal_lahir')])>
                    @error('tanggal_lahir')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-12 col-md-6">
                    <label for="golongan_darah" class="form-label fw-semibold">Golongan Darah</label>
                    <select id="golongan_darah" name="golongan_darah" @class(['form-select', 'is-invalid' => $errors->has('golongan_darah')])>
                        <option value="" disabled @selected(old('golongan_darah', $pasien->golongan_darah) === null)>Pilih golongan darah</option>
                        @foreach (App\Models\Pasien::GOLONGAN_DARAH as $nilai => $teks)
                            <option value="{{ $nilai }}" @selected(old('golongan_darah', $pasien->golongan_darah) == $nilai)>{{ $teks }}</option>
                        @endforeach
                    </select>
                    @error('golongan_darah')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-12 col-md-6">
                    <label for="no_telepon" class="form-label fw-semibold">No. Telepon</label>
                    <input type="text" id="no_telepon" name="no_telepon" value="{{ old('no_telepon', $pasien->no_telepon) }}" @class(['form-control', 'is-invalid' => $errors->has('no_telepon')]) inputmode="numeric" placeholder="08xxxxxxxxxx">
                    @error('no_telepon')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-12">
                    <label for="dokter_id" class="form-label fw-semibold">Dokter Penanggung Jawab (DPJP)</label>
                    <select id="dokter_id" name="dokter_id" @class(['form-select', 'is-invalid' => $errors->has('dokter_id')])>
                        <option value="" disabled @selected(old('dokter_id', $pasien->dokter_id) === null)>Pilih dokter</option>
                        @foreach ($daftarDokter as $dokter)
                            <option value="{{ $dokter->id }}" @selected(old('dokter_id', $pasien->dokter_id) == $dokter->id)>{{ $dokter->nama }} - {{ $dokter->nama_spesialisasi }}</option>
                        @endforeach
                    </select>
                    @error('dokter_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-12">
                    <label for="alamat" class="form-label fw-semibold">Alamat</label>
                    <textarea id="alamat" name="alamat" rows="3" @class(['form-control', 'is-invalid' => $errors->has('alamat')]) placeholder="Alamat lengkap pasien">{{ old('alamat', $pasien->alamat) }}</textarea>
                    @error('alamat')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>

        <div class="card-footer bg-body-tertiary d-flex justify-content-end gap-2 px-4 py-3">
            <a href="{{ route('pasien.daftar') }}" class="btn btn-outline-secondary">Batal</a>
            <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
    </form>
@endsection
