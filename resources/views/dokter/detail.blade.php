@extends('layouts.app')

@section('judul', 'Detail Dokter')

@section('konten')
    <header class="d-flex flex-wrap align-items-start justify-content-between gap-3 mb-4">
        <div>
            <h1 class="h4 fw-bold mb-1">Detail Dokter</h1>
        </div>

        <div class="d-flex gap-2">
            <a href="{{ route('dokter.daftar') }}" class="btn btn-outline-secondary">
                <svg class="ikon" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="m12 19-7-7 7-7"/><path d="M19 12H5"/></svg> Kembali
            </a>
        </div>
    </header>

    <section class="card shadow-sm">
        <div class="card-body d-flex flex-wrap align-items-center gap-3 border-bottom p-4">
            <span class="avatar rounded-circle bg-success-subtle text-success-emphasis"><svg class="ikon" width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M4.8 2.3A.3.3 0 1 0 5 2H4a2 2 0 0 0-2 2v5a6 6 0 0 0 6 6a6 6 0 0 0 6-6V4a2 2 0 0 0-2-2h-1a.2.2 0 1 0 .3.3"/><path d="M8 15v1a6 6 0 0 0 6 6a6 6 0 0 0 6-6v-4"/><circle cx="20" cy="10" r="2"/></svg></span>
            <div>
                <h2 class="h5 fw-bold mb-1">{{ $dokter->nama }}</h2>
                <span class="badge rounded-pill bg-success-subtle text-success-emphasis">{{ $dokter->nama_spesialisasi }}</span>
            </div>
            <div class="d-flex gap-2 ms-md-auto">
                <a href="{{ route('dokter.ubah', $dokter) }}" class="btn btn-outline-secondary">
                    <svg class="ikon" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M21.174 6.812a1 1 0 0 0-3.986-3.987L3.842 16.174a2 2 0 0 0-.5.83l-1.321 4.352a.5.5 0 0 0 .623.622l4.353-1.32a2 2 0 0 0 .83-.497z"/><path d="m15 5 4 4"/></svg> Ubah
                </a>
                <form method="POST" action="{{ route('dokter.hapus', $dokter) }}" class="d-inline" onsubmit="return confirm(@js('Hapus data '.$dokter->nama.'? Data yang dihapus tidak dapat dikembalikan.'))">
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
                <dt class="small text-uppercase text-body-secondary fw-semibold mb-1">No. STR</dt>
                <dd class="fw-medium mb-0">{{ $dokter->no_str }}</dd>
            </div>
            <div class="col-12 col-md-4">
                <dt class="small text-uppercase text-body-secondary fw-semibold mb-1">No. Telepon</dt>
                <dd class="fw-medium mb-0">{{ $dokter->no_telepon }}</dd>
            </div>
            <div class="col-12 col-md-4">
                <dt class="small text-uppercase text-body-secondary fw-semibold mb-1">Terdaftar Sejak</dt>
                <dd class="fw-medium mb-0">{{ $dokter->created_at->translatedFormat('d F Y') }}</dd>
            </div>
        </dl>
    </section>
@endsection
