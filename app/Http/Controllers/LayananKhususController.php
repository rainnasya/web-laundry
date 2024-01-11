<?php

namespace App\Http\Controllers;

use App\Models\LayananKhusus;
use Illuminate\Http\Request;


class LayananKhususController extends Controller
    
    {
        /**
         * Display a listing of the resource.
         */
        public function index()
        {
    
            return view('dashboard.paketLaundry.layananKhusus.index',[
                'layanan_khususes' =>  LayananKhusus::paginate(7)
    
            ]);
           
        }
    
        
        public function create()
        {
            // $layanankhusus = \App\Models\LayananKhusus::latest()->first();
            // $kodelayanankhusus = "KLYK";
            // if ($layanankhusus == null) {
            //     $nomorUrut = "001";
            // } else {
            //     $nomorUrut = intval(substr($layanankhusus->kd_lynkhusus, 3, 3)) + 1;
            //     $nomorUrut = str_pad($nomorUrut, 3, '0', STR_PAD_LEFT);
            // }
            // $kd_lynkhusus = $kodelayanankhusus . $nomorUrut;
    
            return view('dashboard.paketLaundry.layananKhusus.create');

        }
    
        
        public function store(Request $request)
        { 
            $validatedData = $request->validate([
                'lyn_khusus' => 'required',
                'harga_khusus' => 'required',
              
            ]);
    
            LayananKhusus::create($validatedData);
            return redirect('/layananKhusus')->with('pesan', 'Data berhasil ditambah');
        
        }
    
        public function show(LayananKhusus $layananKhusus, $id)
        {
             
        }
    
        public function edit(LayananKhusus $layananKhusus, $id)
        {
            return view('dashboard.paketLaundry.layananKhusus.edit',[
                'layanan_khususes' => LayananKhusus::find($id)
            ]);  
        }
    
        public function update(Request $request, LayananKhusus $layananKhusus, $id)
        {
            $validatedData = $request->validate([
                'lyn_khusus' => 'required',
                'harga_khusus' => 'required',  
            ]);
    
            LayananKhusus::where('id',$id)
            ->update($validatedData);
            return redirect('/layananKhusus')->with('pesan', 'Data berhasil diubah');
            
        }
    
       
        public function destroy(LayananKhusus $layananKhusus, $id)
        {
            LayananKhusus::destroy($id);
            return redirect('layananKhusus')-> with('pesan','Data Berhasil dihapus');
        }
}
