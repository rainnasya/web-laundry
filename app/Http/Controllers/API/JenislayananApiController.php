<?php

namespace App\Http\Controllers\API;

use App\Models\Jenislayanan;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class JenislayananApiController extends Controller
{
    public function index()
    {
        $jenislayanans = Jenislayanan::paginate(7);
        return response()->json(['data' => $jenislayanans], 200);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'jns_layanan' => 'required',
            'harga_layanan' => 'required',
            'deskripsi' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => 'Validation error', 'messages' => $validator->errors()], 400);
        }

        $jenislayanan = Jenislayanan::create($validator->validated());
        return response()->json(['message' => 'Data berhasil ditambah', 'data' => $jenislayanan], 201);
    }

    public function update(Request $request, $id)
    {
        $jenislayanan = Jenislayanan::find($id);

        if (!$jenislayanan) {
            return response()->json(['error' => 'Not found'], 404);
        }

        $validator = Validator::make($request->all(), [
            'jns_layanan' => 'required',
            'harga_layanan' => 'required',
            'deskripsi' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => 'Validation error', 'messages' => $validator->errors()], 400);
        }

        $jenislayanan->update($validator->validated());
        return response()->json(['message' => 'Data berhasil diubah', 'data' => $jenislayanan], 200);
    }

    public function destroy($id)
    {
        $jenislayanan = Jenislayanan::find($id);
        if (!$jenislayanan) {
            return response()->json(['error' => 'Not found'], 404);
        }

        $jenislayanan->delete();
        return response()->json(['message' => 'Data berhasil dihapus'], 200);
    }
}
