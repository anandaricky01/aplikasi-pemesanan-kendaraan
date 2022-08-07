<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KendaraanDigunakan extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    function kendaraan(){
        return $this->belongsTo(Kendaraan::class);
    }

    function driver(){
        return $this->belongsTo(Driver::class);
    }

    function user(){
        return $this->belongsTo(User::class);
    }
}
