<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RiwayatService;
use App\Models\RiwayatKendaraan;
use App\Models\Kendaraan;
use App\Models\Driver;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class RootController extends Controller
{
    protected $months = [
        '1',
        '2',
        '3',
        '4',
        '5',
        '6',
        '7',
        '8',
        '9',
        '10',
        '11',
        '12'
    ];

    public function index(Carbon $carbon){
        $month = $carbon->now()->month;
        $year = $carbon->now()->year;
        $today = $carbon->now()->day;

        // collection riwayat service untuk jumlah riwayat service
        $riwayat_service_perbulan = RiwayatService::select('kendaraan_id', DB::raw('count(kendaraan_id) jumlah'))->groupBy('kendaraan_id')->whereMonth('tanggal_service',$month)->get();
        $riwayat_service_pertahun = RiwayatService::select('kendaraan_id', DB::raw('count(kendaraan_id) jumlah'))->groupBy('kendaraan_id')->whereYear('tanggal_service',$year)->get();

        // collection riwayat kendaraan expedisi
        $riwayat_digunakan_perbulan = RiwayatKendaraan::select('kendaraan_id', DB::raw('count(kendaraan_id) jumlah'))->groupBy('kendaraan_id')->whereMonth('tanggal_digunakan',$month)->get();
        $riwayat_digunakan_pertahun = RiwayatKendaraan::select('kendaraan_id', DB::raw('count(kendaraan_id) jumlah'))->groupBy('kendaraan_id')->whereYear('tanggal_digunakan',$year)->get();

        // sum total penggunaan BBM per tahun
        $bbm_perbulan = RiwayatKendaraan::select(['bbm_liter','tanggal_digunakan'])->whereMonth('tanggal_digunakan', $month)->get();
        $bbm_pertahun = $this->bbm_pertahun($year);

        // collection untuk menghitung jumlah kendaraan yang sedang tersedia
        $kendaraan_tersedia = Kendaraan::select(['status_kendaraan_id', 'plat_no'])->where('status_kendaraan_id', 1)->latest()->paginate(4);
        $total_kendaraan_tersedia = $this->kendaraan_tersedia($kendaraan_tersedia);

        // collection untuk menghitung jumlah driver tersedia
        $driver_tersedia = Driver::select(['status', 'nama'])->where('status', 'tersedia')->latest()->paginate(4);
        $total_driver_tersedia = $this->driver_tersedia($driver_tersedia);

        return view('home', [
            'riwayat_service_pertahun' => $riwayat_service_pertahun,
            'riwayat_service_perbulan' => $riwayat_service_perbulan,
            'riwayat_digunakan_pertahun' => $riwayat_digunakan_pertahun,
            'riwayat_digunakan_perbulan' => $riwayat_digunakan_perbulan,
            'bbm_pertahun' => $bbm_pertahun,
            'bbm_perbulan' => $bbm_perbulan,
            'bulan' => Carbon::parse(Carbon::now()),
            'kendaraan_tersedia' => $kendaraan_tersedia,
            'total_kendaraan_tersedia' => $total_kendaraan_tersedia,
            'driver_tersedia' => $driver_tersedia,
            'total_driver_tersedia' => $total_driver_tersedia,
        ]);
    }

    public function kendaraan_tersedia($kendaraan_tersedia){
        $jumlah_kendaraan_tersedia = Kendaraan::where('status_kendaraan_id',1)->get()->count();
        $total_kendaraan_tersedia = 0;
        if($kendaraan_tersedia->count() >= $jumlah_kendaraan_tersedia){
            $total_kendaraan_tersedia += $kendaraan_tersedia->count() - $jumlah_kendaraan_tersedia;
        } else {
            $total_kendaraan_tersedia += $jumlah_kendaraan_tersedia - $kendaraan_tersedia->count();
        }

        return $total_kendaraan_tersedia;
    }

    public function driver_tersedia($driver_tersedia){
        $jumlah_driver_tersedia = Driver::where('status','tersedia')->get()->count();
        $total_driver_tersedia = 0;
        if($driver_tersedia->count() >= $jumlah_driver_tersedia){
            $total_driver_tersedia += $driver_tersedia->count() - $jumlah_driver_tersedia;
        } else {
            $total_driver_tersedia += $jumlah_driver_tersedia - $driver_tersedia->count();
        }

        return $total_driver_tersedia;
    }

    public function bbm_pertahun($year){
        $total_bbm = [];
        for ($i=0; $i < Carbon::now()->month; $i++) {
            $total_bbm[$i] = RiwayatKendaraan::whereYear('tanggal_digunakan', $year)->whereMonth('tanggal_digunakan', $this->months[$i])->sum('bbm_liter');
        }

        return $total_bbm;
    }

}
