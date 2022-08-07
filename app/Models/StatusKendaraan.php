<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StatusKendaraan extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    function kendaraan(){
        return $this->hasMany(Kendaraan::class);
    }

    public static function boot() {
        parent::boot();
        self::deleting(function($status_kendaraan) { // before delete() method call this
             $status_kendaraan->kendaraan()->each(function($kendaraan) {
                $kendaraan->delete(); // <-- direct deletion
             });
             // do the rest of the cleanup...
        });
    }
}
