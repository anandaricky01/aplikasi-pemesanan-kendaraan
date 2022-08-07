<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PendingKendaraan;

class PendingKendaraanController extends Controller
{
    public function index(){
        return view('data-master.kondisi-kendaraan.pending', [
            'pendings' => PendingKendaraan::latest()->paginate(7)->withQueryString()
        ]);
    }
}
