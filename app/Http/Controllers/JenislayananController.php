<?php

namespace App\Http\Controllers;

use App\Models\Jenislayanan;
use Illuminate\Http\Request;

class JenislayananController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('dashboard.paketLaundry.jenislayanan.index',[
            'jenislayanans' =>  Jenislayanan::paginate(7)

        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        return view('dashboard.paketLaundry.jenislayanan.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'jns_layanan' => 'required',
            'harga_layanan' =>'required',
            'deskripsi' =>'required',
        ]);

        JenisLayanan::create($validatedData);
        return redirect('/jenislayanan')->with('pesan', 'Data berhasil ditambah');
    }

    /**
     * Display the specified resource.
     */
    public function show(Jenislayanan $jenislayanan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        return view('dashboard.paketLaundry.jenislayanan.edit',[
            'jenislayanans' => Jenislayanan::find($id)
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'jns_layanan' => 'required',
            'harga_layanan' => 'required',
            'deskripsi' => 'required',
        ]);

        Jenislayanan::where('id',$id)
            ->update($validatedData);
        return redirect('/jenislayanan')->with('pesan','Data berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Jenislayanan::destroy($id);
        return redirect('jenislayanan')-> with('pesan','Data Berhasil dihapus');
    }
}
