<?php

namespace App\Http\Controllers;

use App\Models\SuratMasuk;
use App\Models\SuratKeluar;
use App\Models\Disposisi;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $totalMasuk = SuratMasuk::count();
        $totalKeluar = SuratKeluar::count();
        $totalDisposisi = Disposisi::count();
        $disposisiBaru = Disposisi::where('status', 'belum')
            ->where(function ($q) {
                $q->where('kepada', Auth::id())
                  ->orWhereHas('penerimaLainnya', function ($r) {
                      $r->where('user_id', Auth::id());
                  });
            })
            ->count();

        $suratMasukTerbaru = SuratMasuk::latest()->take(5)->get();
        $suratKeluarTerbaru = SuratKeluar::latest()->take(5)->get();

        return view('dashboard', compact(
            'totalMasuk', 'totalKeluar', 'totalDisposisi', 'disposisiBaru',
            'suratMasukTerbaru', 'suratKeluarTerbaru'
        ));
    }
}
