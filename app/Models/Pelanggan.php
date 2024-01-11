<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pelanggan extends Model
{
    use HasFactory;

    protected $guarded=[];

    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }

    public function pesanan(){
        return $this->hasMany(Pesanan::class,'pelanggan_id');
    }


}
