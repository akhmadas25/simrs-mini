@extends('layouts.app')

@section('judul', 'Data Pasien')

@section('konten')
    <header class="d-flex flex-wrap align-items-start justify-content-between gap-3 mb-4">
        <div>
            <h1 class="h4 fw-bold mb-1">Data Pasien</h1>
            <p class="text-body-secondary mb-0">Kelola data pasien yang terdaftar di rumah sakit.</p>
        </div>

        <div class="d-flex gap-2">
            <a href="{{ route('pasien.tambah') }}" class="btn btn-primary">
                <svg class="ikon" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M5 12h14"/><path d="M12 5v14"/></svg> Tambah Pasien
            </a>
        </div>
    </header>

    <section class="card shadow-sm">
        <div class="card-header bg-body py-3">
            <form method="GET" class="pencarian d-flex gap-2">
                <div class="input-group">
                    <span class="input-group-text bg-body"><svg class="ikon" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.3-4.3"/></svg></span>
                    <input type="search" name="cari" value="{{ request('cari') }}" placeholder="Cari nama, NIK, atau No. RM..." class="form-control">
                    <button type="submit" class="btn btn-outline-secondary">Cari</button>
                </div>

                @if (request()->filled('cari'))
                    <a href="{{ url()->current() }}" class="btn btn-link text-decoration-none">Reset</a>
                @endif
            </form>
        </div>

        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th>No. RM</th>
                        <th>Pasien</th>
                        <th>Jenis Kelamin</th>
                        <th>Tanggal Lahir</th>
                        <th>No. Telepon</th>
                        <th>DPJP</th>
                        <th class="text-end">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($daftarPasien as $pasien)
                        <tr>
                            <td><span class="badge text-bg-light border font-monospace">{{ $pasien->no_rm }}</span></td>
                            <td>
                                <div class="fw-semibold">{{ $pasien->nama }}</div>
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
                            <td>{{ $pasien->no_telepon }}</td>
                            <td>
                                <div>{{ $pasien->dokter?->nama ?? '-' }}</div>
                                <div class="small text-body-secondary">{{ $pasien->dokter?->nama_spesialisasi }}</div>
                            </td>
                            <td>
                                <div class="d-flex justify-content-end gap-1">
                                    <a href="{{ route('pasien.detail', $pasien) }}" class="btn btn-sm btn-outline-secondary" title="Detail"><svg class="ikon" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M2 12s3-7 10-7 10 7 10 7-3 7-10 7-10-7-10-7Z"/><circle cx="12" cy="12" r="3"/></svg></a>
                                    <a href="{{ route('pasien.ubah', $pasien) }}" class="btn btn-sm btn-outline-secondary" title="Ubah"><svg class="ikon" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M21.174 6.812a1 1 0 0 0-3.986-3.987L3.842 16.174a2 2 0 0 0-.5.83l-1.321 4.352a.5.5 0 0 0 .623.622l4.353-1.32a2 2 0 0 0 .83-.497z"/><path d="m15 5 4 4"/></svg></a>
                                    <form method="POST" action="{{ route('pasien.hapus', $pasien) }}" class="d-inline" onsubmit="return confirm(@js('Hapus data '.$pasien->nama.'? Data yang dihapus tidak dapat dikembalikan.'))">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger" title="Hapus">
                                            <svg class="ikon" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M3 6h18"/><path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"/><path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"/></svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center text-body-secondary py-5">
                                <svg class="ikon d-block mx-auto mb-2" width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M22 12h-6l-2 3h-4l-2-3H2"/><path d="M5.45 5.11 2 12v6a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2v-6l-3.45-6.89A2 2 0 0 0 16.76 4H7.24a2 2 0 0 0-1.79 1.11z"/></svg>
                                <p class="mb-0">{{ request()->filled('cari') ? 'Tidak ada data yang cocok dengan "'.request('cari').'".' : 'Belum ada data pasien.' }}</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{ $daftarPasien->links() }}
    </section>
@endsection
