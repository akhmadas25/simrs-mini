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

    <section class="card shadow-sm mt-4">
        <div class="card-header bg-body d-flex flex-wrap align-items-center justify-content-between gap-2 py-3">
            <div>
                <h2 class="h6 fw-semibold mb-0">Pasien dalam Penanganan ({{ $daftarPasien->total() }})</h2>
            </div>
            <a href="{{ route('pasien.tambah', ['dokter_id' => $dokter->id]) }}" class="btn btn-sm btn-primary">
                <svg class="ikon" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M5 12h14"/><path d="M12 5v14"/></svg> Tambah Pasien
            </a>
        </div>

        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th>No. RM</th>
                        <th>Pasien</th>
                        <th>Jenis Kelamin</th>
                        <th>Tanggal Lahir</th>
                        <th>Gol. Darah</th>
                        <th>No. Telepon</th>
                        <th class="text-end">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($daftarPasien as $pasien)
                        <tr>
                            <td><span class="badge text-bg-light border font-monospace">{{ $pasien->no_rm }}</span></td>
                            <td>
                                <a href="{{ route('pasien.detail', $pasien) }}" class="fw-semibold text-decoration-none">{{ $pasien->nama }}</a>
                                <div class="small text-body-secondary">NIK {{ $pasien->nik }}</div>
                            </td>
                            <td>
                                @if ($pasien->jenis_kelamin === 'L')
                                    <span class="badge rounded-pill bg-info-subtle text-info-emphasis">{{ $pasien->nama_jenis_kelamin }}</span>
                                @elseif ($pasien->jenis_kelamin === 'P')
                                    <span class="badge rounded-pill bg-danger-subtle text-danger-emphasis">{{ $pasien->nama_jenis_kelamin }}</span>
                                @else
                                    <span class="badge rounded-pill">{{ $pasien->nama_jenis_kelamin }}</span>
                                @endif
                            </td>
                            <td>
                                <div>{{ $pasien->tanggal_lahir->translatedFormat('d M Y') }}</div>
                                <div class="small text-body-secondary">{{ $pasien->umur }} tahun</div>
                            </td>
                            <td><span class="badge text-bg-light border">{{ $pasien->golongan_darah }}</span></td>
                            <td>{{ $pasien->no_telepon }}</td>
                            <td class="text-end">
                                <a href="{{ route('pasien.detail', $pasien) }}" class="btn btn-sm btn-outline-secondary" title="Detail">
                                    <svg class="ikon" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M2 12s3-7 10-7 10 7 10 7-3 7-10 7-10-7-10-7Z"/><circle cx="12" cy="12" r="3"/></svg>
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center text-body-secondary py-5">
                                <p class="mb-0">Belum ada pasien yang ditangani oleh dokter ini.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{ $daftarPasien->links() }}
    </section>
@endsection
