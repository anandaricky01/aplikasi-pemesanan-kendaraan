<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RiwayatService;
use App\Models\Kendaraan;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class RootController extends Controller
{
    public function __contstruct(){
        $this->faker = new Faker;
    }

    public function index(Carbon $carbon){
        $month = $carbon->now()->month;
        $year = $carbon->now()->year;
        $today = $carbon->now()->day;

        // collection riwayat service untuk jumlah riwayat service
        $riwayat_service = RiwayatService::select('kendaraan_id', DB::raw('count(kendaraan_id) jumlah'))->groupBy('kendaraan_id')->whereMonth('tanggal_service',$month)->get();

        // collection untuk menghitung jumlah kendaraan yang sedang tersedia
        $kendaraan_tersedia = Kendaraan::select(['status_kendaraan_id', 'plat_no'])->where('status_kendaraan_id', 1)->latest()->paginate(4);
        $jumlah_kendaraan_tersedia = Kendaraan::where('status_kendaraan_id',1)->get()->count();
        $total_kendaraan_tersedia = 0;
        if($kendaraan_tersedia->count() >= $jumlah_kendaraan_tersedia){
            $total_kendaraan_tersedia += $kendaraan_tersedia->count() - $jumlah_kendaraan_tersedia;
        } else {
            $total_kendaraan_tersedia += $jumlah_kendaraan_tersedia - $kendaraan_tersedia->count();
        }


        return view('home', [
            'riwayat_service' => $riwayat_service,
            'bulan' => Carbon::parse(Carbon::now())->format('F Y'),
            'kendaraan_tersedia' => $kendaraan_tersedia,
            'total_kendaraan_tersedia' => $total_kendaraan_tersedia
        ]);
    }
}
