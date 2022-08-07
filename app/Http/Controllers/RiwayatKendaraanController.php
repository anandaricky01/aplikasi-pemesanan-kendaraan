<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RiwayatKendaraan;

class RiwayatKendaraanController extends Controller
{
    public function index(){
        return view('data-master.riwayat.kendaraan', [
            'riwayat' => RiwayatKendaraan::orderBy('tanggal_digunakan','DESC')->paginate(7)->withQueryString(),
            'total' => RiwayatKendaraan::all()
        ]);
    }
}
