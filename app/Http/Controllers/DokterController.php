<?php

namespace App\Http\Controllers;

use App\Http\Requests\DokterRequest;
use App\Models\Dokter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DokterController extends Controller
{
    public function daftar(Request $request): View
    {
        $kataKunci = $request->query('cari');

        $daftarDokter = Dokter::query()
            ->when($kataKunci, fn (Builder $query) => $query->whereAny(
                ['nama', 'spesialisasi', 'no_str'],
                'like',
                "%{$kataKunci}%",
            ))
            ->latest('id')
            ->paginate(10)
            ->withQueryString();

        return view('dokter.daftar', ['daftarDokter' => $daftarDokter]);
    }

    public function tambah(): View
    {
        return view('dokter.form', ['dokter' => new Dokter]);
    }

    public function simpan(DokterRequest $request): RedirectResponse
    {
        Dokter::create($request->validated());

        return to_route('dokter.daftar')->with('sukses', 'Data dokter berhasil ditambahkan.');
    }

    public function detail(Dokter $dokter): View
    {
        return view('dokter.detail', ['dokter' => $dokter]);
    }

    public function ubah(Dokter $dokter): View
    {
        return view('dokter.form', ['dokter' => $dokter]);
    }

    public function perbarui(DokterRequest $request, Dokter $dokter): RedirectResponse
    {
        $dokter->update($request->validated());

        return to_route('dokter.detail', $dokter)->with('sukses', 'Data dokter berhasil diperbarui.');
    }

    public function hapus(Dokter $dokter): RedirectResponse
    {
        $dokter->delete();

        return to_route('dokter.daftar')->with('sukses', 'Data dokter berhasil dihapus.');
    }
}
