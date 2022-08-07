<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kendaraan extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    // one to many
    function riwayat_kendaraan(){
        return $this->hasMany(RiwayatKendaraan::class);
    }

    function riwayat_service(){
        return $this->hasMany(RiwayatService::class);
    }
    
    function status_kendaraan(){
        return $this->belongsTo(StatusKendaraan::class);
    }
    // -one to many-
    
    // one tn one
    function kendaraan_digunakan(){
        return $this->hasOne(KendaraanDigunakan::class);
    }

    function pending_kendaraan(){
        return $this->hasOne(PendingKendaraan::class);
    }

    // -one to one-

    public static function boot() {
        parent::boot();
        self::deleting(function($kendaraan) { // before delete() method call this
             $kendaraan->riwayat_kendaraan()->each(function($riwayat_kendaraan) {
                $riwayat_kendaraan->delete(); // <-- direct deletion
             });
             
             $kendaraan->riwayat_service()->each(function($riwayat_service) {
                $riwayat_service->delete(); // <-- direct deletion
             });

             $kendaraan->kendaraan_digunakan()->each(function($kendaraan_digunakan){
                $kendaraan_digunakan->delete();
             });

             $kendaraan->pending_kendaraan()->each(function($pending_kendaraan){
                $pending_kendaraan->delete();
             });
             // do the rest of the cleanup...
        });
    }
}
