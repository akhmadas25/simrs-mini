@extends('layouts.app')

@section('judul', 'Detail Pasien')

@section('konten')
    <header class="d-flex flex-wrap align-items-start justify-content-between gap-3 mb-4">
        <div>
            <h1 class="h4 fw-bold mb-1">Detail Pasien</h1>
        </div>

        <div class="d-flex gap-2">
            <a href="{{ route('pasien.daftar') }}" class="btn btn-outline-secondary">
                <svg class="ikon" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="m12 19-7-7 7-7"/><path d="M19 12H5"/></svg> Kembali
            </a>
        </div>
    </header>

    <section class="card shadow-sm">
        <div class="card-body d-flex flex-wrap align-items-center gap-3 border-bottom p-4">
            <span class="avatar rounded-circle bg-primary-subtle text-primary-emphasis fs-4 fw-bold">{{ str($pasien->nama)->substr(0, 1)->upper() }}</span>
            <div>
                <h2 class="h5 fw-bold mb-1">{{ $pasien->nama }}</h2>
                <span class="badge text-bg-light border font-monospace">{{ $pasien->no_rm }}</span>
            </div>
            <div class="d-flex gap-2 ms-md-auto">
                <a href="{{ route('pasien.ubah', $pasien) }}" class="btn btn-outline-secondary">
                    <svg class="ikon" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M21.174 6.812a1 1 0 0 0-3.986-3.987L3.842 16.174a2 2 0 0 0-.5.83l-1.321 4.352a.5.5 0 0 0 .623.622l4.353-1.32a2 2 0 0 0 .83-.497z"/><path d="m15 5 4 4"/></svg> Ubah
                </a>
                <form method="POST" action="{{ route('pasien.hapus', $pasien) }}" class="d-inline" onsubmit="return confirm(@js('Hapus data '.$pasien->nama.'? Data yang dihapus tidak dapat dikembalikan.'))">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-outline-danger">
                        <svg class="ikon" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M3 6h18"/><path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"/><path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"/></svg> Hapus
                    </button>
                </form>
            </div>
        </div>

        <dl class="row g-4 p-4 mb-0">
            <div class="col-12 col-md-4">
                <dt class="small text-uppercase text-body-secondary fw-semibold mb-1">NIK</dt>
                <dd class="fw-medium mb-0">{{ $pasien->nik }}</dd>
            </div>
            <div class="col-12 col-md-4">
                <dt class="small text-uppercase text-body-secondary fw-semibold mb-1">Jenis Kelamin</dt>
                <dd class="fw-medium mb-0">{{ $pasien->nama_jenis_kelamin }}</dd>
            </div>
            <div class="col-12 col-md-4">
                <dt class="small text-uppercase text-body-secondary fw-semibold mb-1">Tanggal Lahir</dt>
                <dd class="fw-medium mb-0">{{ $pasien->tanggal_lahir->translatedFormat('d F Y') }} ({{ $pasien->umur }} tahun)</dd>
            </div>
            <div class="col-12 col-md-4">
                <dt class="small text-uppercase text-body-secondary fw-semibold mb-1">Golongan Darah</dt>
                <dd class="fw-medium mb-0">{{ $pasien->golongan_darah }}</dd>
            </div>
            <div class="col-12 col-md-4">
                <dt class="small text-uppercase text-body-secondary fw-semibold mb-1">No. Telepon</dt>
                <dd class="fw-medium mb-0">{{ $pasien->no_telepon }}</dd>
            </div>
            <div class="col-12 col-md-4">
                <dt class="small text-uppercase text-body-secondary fw-semibold mb-1">Terdaftar Sejak</dt>
                <dd class="fw-medium mb-0">{{ $pasien->created_at->translatedFormat('d F Y') }}</dd>
            </div>
            <div class="col-12">
                <dt class="small text-uppercase text-body-secondary fw-semibold mb-1">Dokter Penanggung Jawab (DPJP)</dt>
                <dd class="fw-medium mb-0">{{ $pasien->dokter?->nama ?? '-' }}</dd>
            </div>
            <div class="col-12">
                <dt class="small text-uppercase text-body-secondary fw-semibold mb-1">Alamat</dt>
                <dd class="fw-medium mb-0">{{ $pasien->alamat }}</dd>
            </div>
        </dl>
    </section>
@endsection
