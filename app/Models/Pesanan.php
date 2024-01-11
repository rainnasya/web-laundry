<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pesanan extends Model
{
    use HasFactory;
    protected $guarded=[];

    public function pelanggan(){
        return $this-> belongsTo(Pelanggan::class,'pelanggan_id');
    }

    public function jenislayanan(){
        return $this-> belongsTo(Jenislayanan::class,'jenislayanan_id');
    }

    public function layananKhusus(){
        return $this-> belongsTo(LayananKhusus::class,'layanankhusus_id');
    }

    public function statuspesanan(){
        return $this-> belongsTo(Statuspesanan::class,'statuspesanan_id');
    }


}
