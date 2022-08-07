<?php

namespace App\Http\Controllers;

use App\Models\Kendaraan;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class KendaraanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $term = '';
        if(isset($request->plat_no)){
            $term .= $request->plat_no;
        }
        $kendaraans = Kendaraan::where('plat_no', 'LIKE', '%' . $term . '%')->latest()->paginate(7)->withQueryString();
        // $kendaraans = Kendaraan::where([['plat_no', 'LIKE', '%' . $term . '%'],['status_kendaraan_id',1]])->latest()->paginate(7)->withQueryString();
        // dd($request->plat_no);
        // dd($term . ' ' );
        return view('data-master.kendaraan.index', [
            'kendaraans' => $kendaraans
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('data-master.kendaraan.create');
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
            'plat_no' => 'required',
        ]);
        $validated['status_kendaraan_id'] = 1;

        Kendaraan::create($validated);
        return redirect('/kendaraan')->with('success', 'Berhasil Menambahkan Kendaraan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Kendaraan  $kendaraan
     * @return \Illuminate\Http\Response
     */
    public function show(Kendaraan $kendaraan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Kendaraan  $kendaraan
     * @return \Illuminate\Http\Response
     */
    public function edit(Kendaraan $kendaraan)
    {
        return view('data-master.kendaraan.edit', [
            'kendaraan' => $kendaraan
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Kendaraan  $kendaraan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Kendaraan $kendaraan)
    {
        $validated = $request->validate([
            'plat_no' => 'required'
        ]);

        // dd($validated['plat_no'] !== $kendaraan->plat_no);
        if($validated['plat_no'] !== $kendaraan->plat_no){
            $kendaraan->where('plat_no', $kendaraan->plat_no)->update($validated);
        }

        return redirect('/kendaraan')->with('success', 'Edit Plat Nomor Berhasil');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Kendaraan  $kendaraan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Kendaraan $kendaraan)
    {
        // \App\Models\RiwayatKendaraan::where('kendaraan_id',$kendaraan->id)->delete();
        $kendaraan->find($kendaraan->id)->delete();
        return redirect('/kendaraan')->with('success', 'Kendaraan Berhasil Dihapus');
    }

    // list kendaraan tersedia
    public function kendaraanTersedia(){
        $kendaraans = Kendaraan::where('status_kendaraan_id', 1)->latest()->paginate(7)->withQueryString();
        // $kendaraans = Kendaraan::where(['status_kendaraan_id' => 1, ])->latest()->paginate(7)->withQueryString();
        return view('data-master.kondisi-kendaraan.tersedia', [
            'kendaraans' => $kendaraans
        ]);
    }

    // list kendaraan yang sedang digunakan
    public function kendaraanDigunakan(){
        $kendaraans = Kendaraan::where('status_kendaraan_id', 2)->latest()->paginate(7)->withQueryString();
        // $kendaraans = Kendaraan::where(['status_kendaraan_id' => 1, ])->latest()->paginate(7)->withQueryString();
        return view('data-master.kondisi-kendaraan.digunakan', [
            'kendaraans' => $kendaraans
        ]);
    }

    // list kendaraan yang berada di tukang service
    public function kendaraanDiservice(){
        $kendaraans = Kendaraan::where('status_kendaraan_id', 3)->latest()->paginate(7)->withQueryString();
        // $kendaraans = Kendaraan::where(['status_kendaraan_id' => 1, ])->latest()->paginate(7)->withQueryString();
        return view('data-master.kondisi-kendaraan.diservice', [
            'kendaraans' => $kendaraans
        ]);
    }

    // kirim kendaraan ke tukang service
    public function kendaraanKeService(Kendaraan $kendaraan){
        $kendaraan->where('id', $kendaraan->id)->update([
            'status_kendaraan_id' => 3
        ]);

        $array = [
            'kendaraan_id' => $kendaraan->id,
            'tanggal_service' => Carbon::now()
        ];

        \App\Models\RiwayatService::create($array);
        return redirect('/kendaraan/diservice')->with('success', 'Kendaraan Dikirim ke Bagian Service');
    }

    public function kendaraanSelesaiService(Kendaraan $kendaraan){
        $kendaraan->where('id', $kendaraan->id)->update(['status_kendaraan_id' => 1]);

        \App\Models\RiwayatService::where('kendaraan_id',$kendaraan->id)->update(['tanggal_keluar' => Carbon::now()]);
        return redirect('/kendaraan/diservice')->with('success', 'Kendaraan Selesai Service');
    }
}
