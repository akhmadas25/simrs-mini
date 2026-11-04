<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('judul') - SIMRS</title>
    <link rel="stylesheet" href="{{ asset('vendor/bootstrap/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/simrs.css') }}">
</head>
<body class="bg-body-tertiary">
    <div class="d-flex flex-column flex-lg-row min-vh-100">
        <aside class="sidebar text-bg-dark flex-shrink-0 p-3">
            <a href="{{ route('dashboard') }}" class="d-flex align-items-center gap-2 text-white text-decoration-none pb-3 mb-3 border-bottom border-secondary">
                <span class="brand-logo bg-primary rounded-3"><svg class="ikon" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M22 12h-4l-3 9L9 3l-3 9H2"/></svg></span>
                <span>
                    <strong class="d-block">SIMRS</strong>
                </span>
            </a>

            <nav class="nav nav-pills flex-lg-column gap-1">
                <a href="{{ route('dashboard') }}" @class(['nav-link d-flex align-items-center gap-2', 'active' => request()->routeIs('dashboard')])>
                    <svg class="ikon" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><rect width="7" height="9" x="3" y="3" rx="1"/><rect width="7" height="5" x="14" y="3" rx="1"/><rect width="7" height="9" x="14" y="12" rx="1"/><rect width="7" height="5" x="3" y="16" rx="1"/></svg>
                    Dashboard
                </a>
                <a href="{{ route('pasien.daftar') }}" @class(['nav-link d-flex align-items-center gap-2', 'active' => request()->routeIs('pasien.*')])>
                    <svg class="ikon" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M22 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                    Pasien
                </a>
                <a href="{{ route('dokter.daftar') }}" @class(['nav-link d-flex align-items-center gap-2', 'active' => request()->routeIs('dokter.*')])>
                    <svg class="ikon" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M4.8 2.3A.3.3 0 1 0 5 2H4a2 2 0 0 0-2 2v5a6 6 0 0 0 6 6a6 6 0 0 0 6-6V4a2 2 0 0 0-2-2h-1a.2.2 0 1 0 .3.3"/><path d="M8 15v1a6 6 0 0 0 6 6a6 6 0 0 0 6-6v-4"/><circle cx="20" cy="10" r="2"/></svg>
                    Dokter
                </a>
            </nav>
        </aside>

        <main class="konten flex-grow-1 p-3 p-lg-4">
            @if (session('sukses'))
                <div class="alert alert-success alert-dismissible fade show d-flex align-items-center gap-2" role="alert">
                    <svg class="ikon" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><path d="m9 11 3 3L22 4"/></svg>
                    <span>{{ session('sukses') }}</span>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Tutup"></button>
                </div>
            @endif

            @yield('konten')
        </main>
    </div>

    <script src="{{ asset('vendor/bootstrap/bootstrap.bundle.min.js') }}"></script>
</body>
</html>
