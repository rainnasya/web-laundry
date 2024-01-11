<?php

namespace App\Http\Controllers\API;

use App\Models\Pesanan;
use App\Models\Pelanggan;
use App\Models\Jenislayanan;
use App\Models\LayananKhusus;
use App\Models\Statuspesanan;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PesananApiController extends Controller
{
    public function index()
    {
        $pesanans = Pesanan::with(['pelanggan', 'jenislayanan', 'layananKhusus', 'statuspesanan'])->get();
        return response()->json(['pesanans' => $pesanans], 200);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'kd_pesanan' => 'required',
            'tgl_pesanan' => 'required|date',
            'pelanggan_id' => 'required',
            'jenislayanan_id' => 'nullable',
            'berat' => 'required',
            'catatan' => 'nullable',
            'layanankhusus_id' => 'nullable',
            'statuspesanan_id' => 'required',
            'jml_layanankhusus' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => 'Validation error', 'messages' => $validator->errors()], 400);
        }

        $jenisLayanan = Jenislayanan::find($request->input('jenislayanan_id'));

        if($request->input('layanankhusus_id') != null) {
            $layananKhusus = LayananKhusus::find($request->input('layanankhusus_id'));
        }else {
            $layananKhusus = null;
        }

        $hargaLayanan = $jenisLayanan ->harga_layanan;
        if($layananKhusus != null) {
            $hargaKhusus = $layananKhusus ->harga_khusus;
        } else {
            $hargaKhusus = 0;
        }

        $totalHarga = ($hargaLayanan * $request->input('berat')) + ($hargaKhusus * $request->input('jml_layanankhusus'));

        $data = $request->only([
            'kd_pesanan', 'tgl_pesanan', 'pelanggan_id',
            'jenislayanan_id', 'berat', 'catatan', 'layanankhusus_id',
            'statuspesanan_id', 'jml_layanankhusus'
        ]);
        $data['harga'] = $totalHarga;

        $pesanan = Pesanan::create($data);
        return response()->json(['message' => 'Data berhasil ditambah', 'data' => $pesanan], 201);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'kd_pesanan' => 'required',
            'tgl_pesanan' => 'required|date',
            'pelanggan_id' => 'required',
            'jenislayanan_id' => 'required',
            'berat' => 'required',
            'catatan' => 'nullable',
            'layanankhusus_id' => 'required',
            'statuspesanan_id' => 'required',
            'jml_layanankhusus' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => 'Validation error', 'messages' => $validator->errors()], 400);
        }

        $jenisLayanan = Jenislayanan::find($request->input('jenislayanan_id'));
        $layananKhusus = LayananKhusus::find($request->input('layanankhusus_id'));

        $hargaLayanan = $jenisLayanan ->harga_layanan ;
        if($layananKhusus != null) {
            $hargaKhusus = $layananKhusus ->harga_khusus;
        } else {
            $hargaKhusus = 0;
        }

        $totalHarga = ($hargaLayanan * $request->input('berat')) + ($hargaKhusus * $request->input('jml_layanankhusus'));

        $data = $request->only([
            'kd_pesanan', 'tgl_pesanan', 'pelanggan_id',
            'jenislayanan_id', 'berat', 'catatan', 'layanankhusus_id',
            'statuspesanan_id', 'jml_layanankhusus'
        ]);
        $data['harga'] = $totalHarga;

        $pesanan = Pesanan::find($id);
        if (!$pesanan) {
            return response()->json(['error' => 'Not found'], 404);
        }

        $pesanan->update($data);
        return response()->json(['message' => 'Data berhasil diubah', 'data' => $pesanan], 200);
    }

    public function destroy($id)
    {
        $pesanan = Pesanan::find($id);
        if (!$pesanan) {
            return response()->json(['error' => 'Not found'], 404);
        }

        $pesanan->delete();
        return response()->json(['message' => 'Data berhasil dihapus'], 200);
    }

    public function exportPDF($id)
    {
        try {
            $pesanan = Pesanan::find($id);
            $pdf = PDF::loadView('dashboard.pesanan.pdf', ['pesanan' => $pesanan]);
            $namaFile = "invoice_laundry_" . $pesanan->kd_pesanan . '.pdf';

            return $pdf->download($namaFile);
        } catch (\Exception $e) {
            return response()->json(['error' => 'An error occurred', 'message' => $e->getMessage()], 500);
        }
    }
}
