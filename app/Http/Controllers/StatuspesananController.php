<?php

namespace App\Http\Controllers;

use App\Models\Statuspesanan;
use Illuminate\Http\Request;

class StatuspesananController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('dashboard.statusPesanan.index',[
            'statuspesanans' =>  Statuspesanan::paginate(7)

        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.statusPesanan.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama_status' => 'required',
            'urutan' => 'required',
        ]);

        Statuspesanan::create($validatedData);
        return redirect('/status_pesanan')->with('pesan', 'Data berhasil ditambah');
    }

    /**
     * Display the specified resource.
     */
    public function show(Statuspesanan $statuspesanan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Statuspesanan $statuspesanan, $id)
    {
        return view('dashboard.statusPesanan.edit',[
            'statuspesanans' => Statuspesanan::find($id)
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Statuspesanan $statuspesanan, $id)
    {
        $validatedData = $request->validate([
            'nama_status' => 'required',
            'urutan' => 'required',
        ]);

        Statuspesanan::where('id',$id)
            ->update($validatedData);
        return redirect('/status_pesanan')->with('pesan','Data berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Statuspesanan $statuspesanan, $id)
    {
        Statuspesanan::destroy($id);
        return redirect('status_pesanan')-> with('pesan','Data Berhasil dihapus');
    }
}
