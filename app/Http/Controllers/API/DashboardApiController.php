<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use App\Models\Pelanggan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Auth;

class DashboardApiController extends Controller
{
    public function index()
    {
        $pelanggans = Pelanggan::with('user')->latest()->paginate(5);
        return response()->json(['pelanggans' => $pelanggans], 200);
    }

    public function store(Request $request)
    {
        $user = Auth::user();
        $existingPelanggan = Pelanggan::where('user_id', $user->id)->first();

        if ($existingPelanggan) {
            return response()->json(['error' => 'Anda sudah memiliki data pelanggan.'], 403);
        }

        $validator = Validator::make($request->all(), [
            'nama_pelanggan' => 'required',
            'alamat' => 'required',
            'telp' => 'required',
            'foto_profil' => 'required|image|mimes:jpeg,png,jpg,gif',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => 'Validation error', 'messages' => $validator->errors()], 400);
        }

        if ($request->hasFile('foto_profil')) {
            $foto_profil = $request->file('foto_profil');
            $foto_profil_name = time() . '.' . $foto_profil->getClientOriginalExtension();
            $foto_profil->move(public_path('profil'), $foto_profil_name);
        }

        $pelanggan = new Pelanggan([
            'user_id' => $user->id,
            'nama_pelanggan' => $request->nama_pelanggan,
            'alamat' => $request->alamat,
            'telp' => $request->telp,
            'foto_profil' => $foto_profil_name,
        ]);
        $pelanggan->save();

        return response()->json(['message' => 'Data berhasil ditambah', 'data' => $pelanggan], 201);
    }

    public function update(Request $request, $id)
    {
        $pelanggan = Pelanggan::find($id);

        if (!$pelanggan) {
            return response()->json(['error' => 'Pelanggan Not found'], 404);
        }

        $validator = Validator::make($request->all(), [
            'nama_pelanggan' => 'required',
            'alamat' => 'required',
            'telp' => 'required',
            'foto_profil' => 'required|image|mimes:jpeg,png,jpg,gif',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => 'Validation error', 'messages' => $validator->errors()], 400);
        }

        $validated_data = $validator->validated();

        if ($request->hasFile('foto_profil')) {
            $foto_profil = $request->file('foto_profil');
            $foto_profil_name = time() . '.' . $foto_profil->getClientOriginalExtension();
            $foto_profil->move(public_path('profil'), $foto_profil_name);
            $validated_data['foto_profil'] = $foto_profil_name;
        }

        $pelanggan->update($validated_data);

        return response()->json(['message' => 'Data berhasil diubah', 'data' => $pelanggan], 200);
    }


    public function destroy($id)
    {
        $pelanggan = Pelanggan::find($id);
        if (!$pelanggan) {
            return response()->json(['error' => 'Not found'], 404);
        }

        $user = Auth::user();
        if ($user->id !== $pelanggan->user_id) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $pelanggan->delete();
        return response()->json(['message' => 'Data berhasil dihapus'], 200);
    }
}
