<?php

namespace App\Http\Controllers;

use App\Models\Pesanan;
use App\Models\Pelanggan;
use App\Models\Jenislayanan;
use App\Models\LayananKhusus;
use App\Models\Statuspesanan;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;

class PesananController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $filterStatus = $request->input('filter_status');
        $statuspesanans = Statuspesanan::all();

        $query = Pesanan::with(['pelanggan', 'jenislayanan', 'layananKhusus', 'statuspesanan']);

        if ($filterStatus) {
            $query->whereHas('statuspesanan', function ($q) use ($filterStatus) {
                $q->where('nama_status', $filterStatus);
            });
        }

        $pesanans = $query->latest()->get();

        return view('dashboard.pesanan.index', [
            'pesanans' => $pesanans,
            'statuspesanans' => $statuspesanans,
            'filterStatus' => $filterStatus,
        ]);

    }

    public function naikkan_status($id)
    {
        try {
            $pesanan = Pesanan::find($id);
            $urutan_status = $pesanan->statuspesanan->urutan;
            
            $urutan_baru = $urutan_status + 1;
            $status_baru = Statuspesanan::where('urutan', $urutan_baru)->first();

            if ($status_baru) {
                $pesanan->update([
                    'statuspesanan_id' => $status_baru->id
                ]);

                \Session::flash('success', 'Status pesanan berhasil dinaikkan.');
            } else {
                \Session::flash('error', 'Status pesanan selesai & tidak dapat dinaikkan lagi.');
            }

        } catch (\Exception $e) {
            \Session::flash('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
        
        return redirect()->back();
    }

    public function export($id){
        try{
            $pesanan = Pesanan::find($id);
            $pdf = Pdf::loadView('dashboard.pesanan.pdf', ['pesanan'=> $pesanan]);
            $namaFile = "invoice laundry ". $pesanan->kd_pesanan .'.pdf';
            
            return $pdf->download($namaFile);

        }catch (\Exception $e){
            \Session::flash('error', $e->getMessage());
            return redirect()->back();
        }

    }
   

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'kd_pesanan' => 'required',
            'tgl_pesanan' => 'required|date',
            'pelanggan_id' => 'required',
            'jenislayanan_id' => 'nullable',
            'berat' => 'required',
            'layanankhusus_id' => 'nullable',
            'catatan' => 'nullable',
            'jml_layanankhusus' => 'required',
            'statuspesanan_id' => 'required',
            'statuspembayaran' => 'required|in:belum_bayar,lunas',
        ]);
    
        // Ambil data dari input
        $data = $request->only([
            'kd_pesanan', 'tgl_pesanan','statuspembayaran','pelanggan_id',
            'jenislayanan_id', 'berat', 'layanankhusus_id'
            ,'statuspesanan_id', 'jml_layanankhusus', 'catatan'
        ]);
    
        $jenisLayananId = $request->input('jenislayanan_id');
        $jenisLayanan = JenisLayanan::find($jenisLayananId);
        
        $layananKhususId = $request->input('layanankhusus_id');
        $layananKhusus = LayananKhusus::find($layananKhususId);
    
        $berat = $request->input('berat');
        $jml_layanankhusus = $request->input('jml_layanankhusus');
    
        // Hitung harga 
        $hargaLayanan = $jenisLayanan ->harga_layanan;
        $hargaKhusus = $layananKhusus ->harga_khusus;
        
        $totalHarga = ($hargaLayanan * $berat) +($hargaKhusus * $jml_layanankhusus);
    
        $data['harga'] = $totalHarga;
    
        
        Pesanan::create($data);
       
        return redirect('/pesanan')->with('pesan', 'Data berhasil ditambah');
    }


    /**
     * Display the specified resource.
     */
    public function show(Pesanan $pesanan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $pesanan = Pesanan::find($id);
        

        return view('dashboard.pesanan.edit', [
            'pesanans' => $pesanan,
            'pelanggans' => Pelanggan::all(),
            'jenislayanans' => Jenislayanan::all(),
            'layanan_khususes' => LayananKhusus::all(),
            'statuspesanans' => Statuspesanan::all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            
            'statuspesanan_id' => 'required',
            'statuspembayaran' => 'required|in:belum_bayar,lunas',
           
        ]);

        $data = $request->only([
            'statuspembayaran'
            ,'statuspesanan_id'
        ]);  
    
        Pesanan::where('id',$id)
            ->update($data);

        return redirect('/pesanan')->with('pesan', 'Data berhasil diedit');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Pesanan::destroy($id);
        return redirect('pesanan')-> with('pesan','Data Berhasil dihapus');
    }
}
