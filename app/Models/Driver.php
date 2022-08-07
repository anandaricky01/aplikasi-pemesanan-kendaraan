<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Driver extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    function pending_kendaraan(){
        return $this->hasOne(PendingKendaraan::class);
    }

    function riwayat_kendaraan(){
        return $this->hasMany(RiwayatKendaraan::class);
    }

    function kendaraan_digunakan(){
        return $this->hasOne(KendaraanDigunakan::class);
    }

    public static function boot() {
        parent::boot();
        self::deleting(function($driver) { // before delete() method call this
             $driver->pending_kendaraan()->each(function($pending_kendaraan) {
                $pending_kendaraan->delete(); // <-- direct deletion
             });

            $driver->riwayat_kendaraan()->each(function($riwayat_kendaraan) {
                $riwayat_kendaraan->delete(); // <-- direct deletion
             });

             $driver->kendaraan_digunakan()->each(function($kendaraan_digunakan){
                $kendaraan_digunakan->delete();
             });
             // do the rest of the cleanup...
        });
    }
}
