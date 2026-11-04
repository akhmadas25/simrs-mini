@extends('layouts.app')

@section('judul', 'Dashboard')

@section('konten')
    <header class="d-flex flex-wrap align-items-start justify-content-between gap-3 mb-4">
        <div>
            <h1 class="h4 fw-bold mb-1">Dashboard</h1>
            <p class="text-body-secondary mb-0">Ringkasan data pasien dan dokter rumah sakit.</p>
        </div>

        <div class="d-flex gap-2">
            <a href="{{ route('pasien.tambah') }}" class="btn btn-primary">
                <svg class="ikon" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M5 12h14"/><path d="M12 5v14"/></svg> Daftarkan Pasien
            </a>
        </div>
    </header>

    <section class="row g-3 mb-4">
        <div class="col-sm-6 col-xl-3">
            <div class="card shadow-sm h-100">
                <div class="card-body d-flex align-items-center gap-3">
                    <span class="statistik-ikon rounded-3 bg-primary-subtle text-primary-emphasis">
                        <svg class="ikon" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M22 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                    </span>
                    <div>
                        <p class="small text-body-secondary mb-0">Total Pasien</p>
                        <p class="fs-4 fw-bold mb-0">{{ number_format($ringkasan['totalPasien']) }}</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-xl-3">
            <div class="card shadow-sm h-100">
                <div class="card-body d-flex align-items-center gap-3">
                    <span class="statistik-ikon rounded-3 bg-info-subtle text-info-emphasis">
                        <svg class="ikon" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><circle cx="10" cy="14" r="6"/><path d="M21 3l-6.5 6.5"/><path d="M15 3h6v6"/></svg>
                    </span>
                    <div>
                        <p class="small text-body-secondary mb-0">Pasien Laki-laki</p>
                        <p class="fs-4 fw-bold mb-0">{{ number_format($ringkasan['totalPasienLakiLaki']) }}</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-xl-3">
            <div class="card shadow-sm h-100">
                <div class="card-body d-flex align-items-center gap-3">
                    <span class="statistik-ikon rounded-3 bg-danger-subtle text-danger-emphasis">
                        <svg class="ikon" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><circle cx="12" cy="9" r="6"/><path d="M12 15v7"/><path d="M9 19h6"/></svg>
                    </span>
                    <div>
                        <p class="small text-body-secondary mb-0">Pasien Perempuan</p>
                        <p class="fs-4 fw-bold mb-0">{{ number_format($ringkasan['totalPasienPerempuan']) }}</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-xl-3">
            <div class="card shadow-sm h-100">
                <div class="card-body d-flex align-items-center gap-3">
                    <span class="statistik-ikon rounded-3 bg-success-subtle text-success-emphasis">
                        <svg class="ikon" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M4.8 2.3A.3.3 0 1 0 5 2H4a2 2 0 0 0-2 2v5a6 6 0 0 0 6 6a6 6 0 0 0 6-6V4a2 2 0 0 0-2-2h-1a.2.2 0 1 0 .3.3"/><path d="M8 15v1a6 6 0 0 0 6 6a6 6 0 0 0 6-6v-4"/><circle cx="20" cy="10" r="2"/></svg>
                    </span>
                    <div>
                        <p class="small text-body-secondary mb-0">Total Dokter</p>
                        <p class="fs-4 fw-bold mb-0">{{ number_format($ringkasan['totalDokter']) }}</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="card shadow-sm">
        <div class="card-header bg-body d-flex align-items-center justify-content-between py-3">
            <h2 class="h6 fw-semibold mb-0">Pasien Terbaru</h2>
            <a href="{{ route('pasien.daftar') }}" class="btn btn-sm btn-link text-decoration-none">Lihat semua</a>
        </div>

        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th>No. RM</th>
                        <th>Nama Pasien</th>
                        <th>Jenis Kelamin</th>
                        <th>No. Telepon</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($pasienTerbaru as $pasien)
                        <tr>
                            <td><span class="badge text-bg-light border font-monospace">{{ $pasien->no_rm }}</span></td>
                            <td><a href="{{ route('pasien.detail', $pasien) }}" class="fw-semibold text-decoration-none">{{ $pasien->nama }}</a></td>
                            <td>
                                @if ($pasien->jenis_kelamin === 'L')
                                    <span class="badge rounded-pill bg-info-subtle text-info-emphasis">{{ $pasien->nama_jenis_kelamin }}</span>
                                @elseif ($pasien->jenis_kelamin === 'P')
                                    <span class="badge rounded-pill bg-danger-subtle text-danger-emphasis">{{ $pasien->nama_jenis_kelamin }}</span>
                                @else
                                    <span class="badge rounded-pill">{{ $pasien->nama_jenis_kelamin }}</span>
                                @endif
                            </td>
                            <td>{{ $pasien->no_telepon }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center text-body-secondary py-5">
                                <svg class="ikon d-block mx-auto mb-2" width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M22 12h-6l-2 3h-4l-2-3H2"/><path d="M5.45 5.11 2 12v6a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2v-6l-3.45-6.89A2 2 0 0 0 16.76 4H7.24a2 2 0 0 0-1.79 1.11z"/></svg>
                                <p class="mb-0">{{ request()->filled('cari') ? 'Tidak ada data yang cocok dengan "'.request('cari').'".' : 'Belum ada pasien terdaftar.' }}</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </section>
@endsection
