<?php

namespace App\Http\Controllers;

use App\Models\KendaraanDigunakan;
use App\Models\Kendaraan;
use App\Models\Driver;
use App\Models\User;
use App\Models\PendingKendaraan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class KendaraanDigunakanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // $jumlah = KendaraanDigunakan::select('kendaraan_id', DB::raw('count(kendaraan_id) quantity'))->groupBy('kendaraan_id')->get();
        // $jumlah = Kendaraan::select('plat_no', DB::raw('count(plat_no) quantity'))->groupBy('plat_no')->get();
        // dd($jumlah);
        $term = '';
        if(isset($request->kode_kegiatan)){
            $term .= $request->kode_kegiatan;
        }
        return view('data-master.pesan-kendaraan.index', [
            'kendaraan_digunakan' => KendaraanDigunakan::where('kode_kegiatan','LIKE','%' . $term . '%')->latest()->paginate(7)->withQueryString()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(Auth::user()->role_id == 2){
            return back()->with('error', 'Maaf Pembuatan/Perubahan data hanya diperbolehkan untuk admin');
        }

        $kendaraan = Kendaraan::select(['id', 'plat_no'])->where('status_kendaraan_id',1)->get();
        $driver = Driver::select(['id', 'nama'])->where('status', 'tersedia')->get();
        $user = User::select(['id', 'name'])->where('role_id', 2)->get();
        return view('data-master.pesan-kendaraan.create', [
            'kendaraans' => $kendaraan,
            'drivers' => $driver,
            'users' => $user
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'kendaraan_id' => 'required',
            'driver_id' => 'required',
            'user_id' => 'required',
            'kode_kegiatan' => 'required|unique:pending_kendaraans',
            'bbm_liter' => 'required|numeric',
            'tanggal_digunakan' => 'required|date|after:today',
            'tanggal_selesai' => 'required|date|after:tanggal_digunakan',
            'tujuan' => 'required|string'
            // 'finish_date' => 'required|date|after:start_date'
        ]);

        $tanggal_digunakan = explode("/", $validated['tanggal_digunakan']);
        $tanggal_selesai = explode("/", $validated['tanggal_selesai']);
        $validated['tanggal_digunakan'] = $tanggal_digunakan[2] . '-' . $tanggal_digunakan[0] . '-' . $tanggal_digunakan[1];
        $validated['tanggal_selesai'] = $tanggal_selesai[2] . '-' . $tanggal_selesai[0] . '-' . $tanggal_selesai[1];

        PendingKendaraan::create($validated);
        Kendaraan::where('id', $validated['kendaraan_id'])->update(['status_kendaraan_id' => 2]);
        Driver::where('id', $validated['driver_id'])->update(['status' => 'sedang bertugas']);
        return redirect('/pesan-kendaraan')->with('success','Kendaraan berhasil dipesan! Silahkan Tunggu Persetujuan Kepala Perhubungan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\KendaraanDigunakan  $kendaraanDigunakan
     * @return \Illuminate\Http\Response
     */
    public function show(KendaraanDigunakan $kendaraanDigunakan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\KendaraanDigunakan  $kendaraanDigunakan
     * @return \Illuminate\Http\Response
     */
    public function edit(KendaraanDigunakan $kendaraanDigunakan)
    {
        if(Auth::user()->role_id == 2){
            return back()->with('error', 'Maaf Pembuatan/Perubahan data hanya diperbolehkan untuk admin');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\KendaraanDigunakan  $kendaraanDigunakan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, KendaraanDigunakan $kendaraanDigunakan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\KendaraanDigunakan  $kendaraanDigunakan
     * @return \Illuminate\Http\Response
     */
    public function destroy(KendaraanDigunakan $kendaraanDigunakan)
    {
        //
    }

    public function selesaiDigunakan(KendaraanDigunakan $kendaraanDigunakan){
        // dd($kendaraanDigunakan);
        Kendaraan::where('id', $kendaraanDigunakan->kendaraan_id)->update(['status_kendaraan_id' => 1]);
        Driver::where('id', $kendaraanDigunakan->kendaraan_id)->update(['status' => 'tersedia']);

        $kendaraanDigunakan->where('id', $kendaraanDigunakan->id)->delete();
        return redirect('/pesan-kendaraan')->with('success', 'Ekspedisi Selesai!');
    }
}
