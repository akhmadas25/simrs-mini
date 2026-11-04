<?php

namespace App\Http\Controllers;

use App\Models\Dokter;
use App\Models\Pasien;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function tampilkan(): View
    {
        return view('dashboard', [
            'ringkasan' => [
                'totalPasien' => Pasien::count(),
                'totalPasienLakiLaki' => Pasien::where('jenis_kelamin', 'L')->count(),
                'totalPasienPerempuan' => Pasien::where('jenis_kelamin', 'P')->count(),
                'totalDokter' => Dokter::count(),
            ],
            'pasienTerbaru' => Pasien::latest('id')->take(5)->get(),
        ]);
    }
}
