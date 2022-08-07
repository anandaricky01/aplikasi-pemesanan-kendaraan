<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RiwayatKendaraan;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\RiwayatKendaraanExport;

class RiwayatKendaraanController extends Controller
{
    public function index(Request $request){
        $term = '';
        if(isset($request->kode_kegiatan)){
            $term .= $request->kode_kegiatan;
        }
        return view('data-master.riwayat.kendaraan', [
            'riwayat' => RiwayatKendaraan::where('kode_kegiatan','LIKE', '%' . $term . '%')->orderBy('tanggal_digunakan','DESC')->paginate(7)->withQueryString(),
            'total' => RiwayatKendaraan::where('kode_kegiatan','LIKE', '%' . $term . '%')->count()
        ]);
    }

    public function export(){
        return new RiwayatKendaraanExport;
    }
}
