<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RiwayatKendaraan extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    function driver(){
        return $this->belongsTo(Driver::class);
    }

    function kendaraan(){
        return $this->belongsTo(Kendaraan::class);
    }

    function user(){
        return $this->belongsTo(User::class);
    }

    // function pending_kendaraan(){
    //     return $this->belongsTo(PendingKendaraan::class);
    // }
}
