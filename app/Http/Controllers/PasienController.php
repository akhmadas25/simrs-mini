<?php

namespace App\Http\Controllers;

use App\Http\Requests\PasienRequest;
use App\Models\Dokter;
use App\Models\Pasien;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PasienController extends Controller
{
    public function daftar(Request $request): View
    {
        $kataKunci = $request->query('cari');
        $dokterId = $request->query('dokter_id');
        $jenisKelamin = $request->query('jenis_kelamin');

        $daftarPasien = Pasien::query()
            ->with('dokter')
            ->when($kataKunci, fn (Builder $query) => $query->whereAny(
                ['no_rm', 'nik', 'nama'],
                'like',
                "%{$kataKunci}%",
            ))
            ->when($dokterId, fn (Builder $query) => $query->where('dokter_id', $dokterId))
            ->when($jenisKelamin, fn (Builder $query) => $query->where('jenis_kelamin', $jenisKelamin))
            ->latest('id')
            ->paginate(10)
            ->withQueryString();

        return view('pasien.daftar', [
            'daftarPasien' => $daftarPasien,
            'daftarDokter' => Dokter::orderBy('nama')->get(),
        ]);
    }

    public function tambah(Request $request): View
    {
        return view('pasien.form', [
            'pasien' => new Pasien(['dokter_id' => $request->query('dokter_id')]),
            'daftarDokter' => Dokter::orderBy('nama')->get(),
        ]);
    }

    public function simpan(PasienRequest $request): RedirectResponse
    {
        $data = $request->validated();

        // Format nomor rekam medis: RM-000001, RM-000002, dst.
        $noRmTerakhir = Pasien::max('no_rm');
        $nomorBerikutnya = $noRmTerakhir ? ((int) substr($noRmTerakhir, 3)) + 1 : 1;
        $data['no_rm'] = 'RM-'.str_pad($nomorBerikutnya, 6, '0', STR_PAD_LEFT);

        Pasien::create($data);

        return to_route('pasien.daftar')->with('sukses', 'Data pasien berhasil ditambahkan.');
    }

    public function detail(Pasien $pasien): View
    {
        return view('pasien.detail', ['pasien' => $pasien]);
    }

    public function ubah(Pasien $pasien): View
    {
        return view('pasien.form', [
            'pasien' => $pasien,
            'daftarDokter' => Dokter::orderBy('nama')->get(),
        ]);
    }

    public function perbarui(PasienRequest $request, Pasien $pasien): RedirectResponse
    {
        $pasien->update($request->validated());

        return to_route('pasien.detail', $pasien)->with('sukses', 'Data pasien berhasil diperbarui.');
    }

    public function hapus(Pasien $pasien): RedirectResponse
    {
        $pasien->delete();

        return to_route('pasien.daftar')->with('sukses', 'Data pasien berhasil dihapus.');
    }
}
