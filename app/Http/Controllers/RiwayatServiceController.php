<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RiwayatService;
use App\Models\Kendaraan;
use Illuminate\Support\Facades\Auth;

class RiwayatServiceController extends Controller
{
    public function index(Request $request){
        
        return view('data-master.riwayat.service', [
            'riwayat' => RiwayatService::orderBy('tanggal_service','DESC')->paginate(7)->withQueryString(),
            'total' => RiwayatService::all()->count()
        ]);
    }
}
