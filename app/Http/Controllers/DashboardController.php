<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Pelanggan;
use App\Models\Pesanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
   
    public function index()
    {
        $pelanggans = Pelanggan::with('user')->paginate(5);
        $jumlahPesanan = Pesanan::count();
        $jumlahPelanggan = Pelanggan::count();
        $totalPemasukan = Pesanan::sum('harga');

        return view('dashboard.index',[
            'pelanggans'=>$pelanggans,
            'totalPemasukan'=>$totalPemasukan,
            'jumlahPesanan'=>$jumlahPesanan,
            'jumlahPelanggan'=>$jumlahPelanggan,
        ]);
    }

    public function create()
    {
        return view('dashboard.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required',
            'username' => 'required',
            'nama_pelanggan' => 'required',
            'alamat' => 'required',
            'telp' => 'required',
            'foto_profil' => 'required|image|mimes:jpeg,png,jpg,gif',
        ]);

        if($foto_profil= $request->file('foto_profil')){
            $destinationPath = 'profil/';
            $profileImage= date('YmdHis') ."." . $foto_profil->getClientOriginalExtension();
            $foto_profil->move($destinationPath, $profileImage);
            $input['foto_profil'] = "$profileImage";
        }

        Pelanggan::create($input);
        return redirect('/dashboard')->with('pesan', 'Data berhasil ditambah');
    }


  
    public function show(Pelanggan $pelanggan, $id)
    {
        $pelanggan = Pelanggan::with('user')->find($id);

        if (!$pelanggan) {
            return redirect('/dashboard')->with('error', 'Data pelanggan tidak ditemukan');
        }
    
        return view('dashboard.show', [
            'pelanggans' => $pelanggan,
        ]);
    }

    
    public function edit(Pelanggan $pelanggan, $id)
    {
        return view('dashboard.edit',[
            'users' => User::all(),
            'pelanggans' => Pelanggan::find($id)
        ]);
    }

    
    public function update(Request $request, Pelanggan $pelanggan, $id)
    {
        $validatedData = $request->validate([
            'user_id' => 'required',
            'nama_pelanggan' => 'required',
            'alamat' => 'required',
            'telp' => 'required',
            'foto_profil' => 'required|image|mimes:jpeg,png,jpg,gif',
        ]);

        if($foto_profil= $request->file('foto_profil')){
            $destinationPath = 'profil/';
            $profileImage= date('YmdHis') ."." . $foto_profil->getClientOriginalExtension();
            $foto_profil->move($destinationPath, $profileImage);
            $input['foto_profil'] = "$profileImage";
        }

        Pelanggan::where('id',$id)
            ->update($validatedData);
        return redirect('/dashboard')->with('pesan','Data berhasil diubah');
    }

    
    public function destroy(Pelanggan $pelanggan, $id)
    {
        Pelanggan::destroy($id);
        return redirect('dashboard')-> with('pesan','Data Berhasil dihapus');
    }
}