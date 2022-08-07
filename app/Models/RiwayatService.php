<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RiwayatService extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    function kendaraan(){
        return $this->belongsTo(Kendaraan::class);
    }
}
