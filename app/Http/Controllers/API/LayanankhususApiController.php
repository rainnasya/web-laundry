<?php

namespace App\Http\Controllers\API;

use App\Models\LayananKhusus;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class LayanankhususApiController extends Controller
{
    public function index()
    {
        $layananKhususes = LayananKhusus::paginate(7);
        return response()->json(['layanan_khususes' => $layananKhususes], 200);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'lyn_khusus' => 'required',
            'harga_khusus' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => 'Validation error', 'messages' => $validator->errors()], 400);
        }

        $layananKhusus = LayananKhusus::create($request->all());
        return response()->json(['message' => 'Data berhasil ditambah', 'data' => $layananKhusus], 201);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'lyn_khusus' => 'required',
            'harga_khusus' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => 'Validation error', 'messages' => $validator->errors()], 400);
        }

        $layananKhusus = LayananKhusus::find($id);
        if (!$layananKhusus) {
            return response()->json(['error' => 'Not found'], 404);
        }

        $layananKhusus->update($request->all());
        return response()->json(['message' => 'Data berhasil diubah', 'data' => $layananKhusus], 200);
    }

    public function destroy($id)
    {
        $layananKhusus = LayananKhusus::find($id);
        if (!$layananKhusus) {
            return response()->json(['error' => 'Not found'], 404);
        }

        $layananKhusus->delete();
        return response()->json(['message' => 'Data berhasil dihapus'], 200);
    }
}
