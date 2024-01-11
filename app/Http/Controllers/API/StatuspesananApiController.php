<?php

namespace App\Http\Controllers\API;

use App\Models\Statuspesanan;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class StatuspesananApiController extends Controller
{
    public function index()
    {
        $statuspesanans = Statuspesanan::paginate(7);
        return response()->json(['statuspesanans' => $statuspesanans], 200);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_status' => 'required',
            'urutan' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => 'Validation error', 'messages' => $validator->errors()], 400);
        }

        $statuspesanan = Statuspesanan::create($request->all());
        return response()->json(['message' => 'Data berhasil ditambah', 'data' => $statuspesanan], 201);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'nama_status' => 'required',
            'urutan' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => 'Validation error', 'messages' => $validator->errors()], 400);
        }

        $statuspesanan = Statuspesanan::find($id);
        if (!$statuspesanan) {
            return response()->json(['error' => 'Not found'], 404);
        }

        $statuspesanan->update($request->all());
        return response()->json(['message' => 'Data berhasil diubah', 'data' => $statuspesanan], 200);
    }

    public function destroy($id)
    {
        $statuspesanan = Statuspesanan::find($id);
        if (!$statuspesanan) {
            return response()->json(['error' => 'Not found'], 404);
        }

        $statuspesanan->delete();
        return response()->json(['message' => 'Data berhasil dihapus'], 200);
    }
}
