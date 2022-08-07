<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PendingKendaraan;
use App\Models\Kendaraan;
use App\Models\Driver;
use App\Models\RiwayatKendaraan;
use App\Models\KendaraanDigunakan;
use Illuminate\Support\Facades\Auth;

class PendingKendaraanController extends Controller
{
    public function index(Request $request){
        $term = '';
        if(isset($request->kode_kegiatan)){
            $term .= $request->kode_kegiatan;
        }
        return view('data-master.kondisi-kendaraan.pending', [
            'pendings' => PendingKendaraan::where('kode_kegiatan','LIKE','%' . $term . '%')->latest()->paginate(7)->withQueryString()
        ]);
    }

    public function setujui(PendingKendaraan $pending){
        $digunakan = [];
        $digunakan['kendaraan_id'] = $pending->kendaraan_id;
        $digunakan['driver_id'] = $pending->driver_id;
        $digunakan['user_id'] = $pending->user_id;
        $digunakan['kode_kegiatan'] = $pending->kode_kegiatan;
        $digunakan['bbm_liter'] = $pending->bbm_liter;
        $digunakan['tanggal_digunakan'] = $pending->tanggal_digunakan;
        $digunakan['tanggal_selesai'] = $pending->tanggal_selesai;
        $digunakan['tujuan'] = $pending->tujuan;

        KendaraanDigunakan::create($digunakan);
        RiwayatKendaraan::create($digunakan);
        PendingKendaraan::where('kode_kegiatan', $digunakan['kode_kegiatan'])->update(['status' => 'disetujui']);
        return redirect('/pesan-kendaraan')->with('success', 'Kendaraan yang telah disetujui siap diberangkatkan!');
    }

    public function tolak(PendingKendaraan $pending){
        $pending->where('kode_kegiatan', $pending->kode_kegiatan)->update(['status' => 'ditolak']);
        $message = 'Kendaraan dengan Nomor Kegiatan ' . $pending->kode_kegiatan . ' telah ditolak!';
        Kendaraan::where('id', $pending->kendaraan_id)->update(['status_kendaraan_id' => 1]);
        Driver::where('id', $pending->driver_id)->update(['status' => 'tersedia']);
        return redirect('/kendaraan/pending')->with('error', $message);
    }

    // public function hapus(PendingKendaraan $pending){
    //     $pending->where('kode_kegiatan', $pending->kode_kegiatan)->delete();
    //     $message = 'Pemesanan dengan Nomor Kegiatan ' . $pending->kode_kegiatan . ' berhasil dihapus!';
    //     return redirect('/kendaraan/pending')->with('success', $message);
    // }
}
