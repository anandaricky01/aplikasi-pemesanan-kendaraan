<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PendingKendaraan extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    function driver(){
        return $this->belongsTo(Driver::class);
    }

    function Kendaraan(){
        return $this->belongsTo(Kendaraan::class);
    }

    function user(){
        return $this->belongsTo(User::class);
    }

    // function riwayat_kendaraan(){
    //     return $this->belongsTo(RiwayatKendaraan::class);
    // }
}
