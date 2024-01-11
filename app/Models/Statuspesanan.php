<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Statuspesanan extends Model
{
    use HasFactory;
    protected $guarded=[];

    public function pesanan(){
        return $this-> hasOne(Pesanan::class,'statuspesanan_id');
    }

}
