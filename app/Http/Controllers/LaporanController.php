<?php

namespace App\Http\Controllers;

use App\Models\Pesanan;
use App\Models\Pelanggan;
use App\Models\Jenislayanan;
use App\Models\LayananKhusus;
use App\Models\Statuspesanan;
use App\Models\Statuspembayaran;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LaporanController extends Controller
{
  
    public function index()
    {
        return view('dashboard.laporan.index'); 
    }

    public function cetaksemua(Pesanan $pesanan)
    {
        $pesanans = Pesanan::with(['pelanggan', 'jenislayanan', 'layananKhusus', 
        'statuspesanan', 'statuspembayaran'])->get();
        $totalPemasukan = Pesanan::sum('harga');

        $pdf = Pdf::loadView('dashboard.laporan.cetaksemua', compact('pesanans', 'totalPemasukan'));
        return $pdf->download('laporan-pemasukan.pdf');

    }

    public function cetakpertanggal($tglawal, $tglakhir){
        // dd(["Tanggal Awal : ".$tglawal, "Tanggal Akhir: ".$tglakhir ]);
    
        $pesanans = Pesanan::with(['pelanggan', 'jenislayanan', 'layananKhusus', 
        'statuspesanan', 'statuspembayaran'])->whereBetween('tgl_pesanan', [$tglawal, $tglakhir])
        ->latest()->get();
        $totalPemasukan = Pesanan::whereBetween('tgl_pesanan', [$tglawal, $tglakhir])
        ->sum('harga');

        $pdf = PDF::loadView('dashboard.laporan.cetakpertanggal', compact('pesanans', 'totalPemasukan'));

        $filename = 'laporan-pertanggal-'.$tglawal.'-'.$tglakhir.'.pdf';
        return $pdf->download($filename);

    }


   
}
