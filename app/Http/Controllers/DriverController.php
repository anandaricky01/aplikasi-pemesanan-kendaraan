<?php

namespace App\Http\Controllers;

use App\Models\Driver;
use Illuminate\Http\Request;

class DriverController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $term = '';
        if(isset($request->nama)){
            $term .= $request->nama;
        }
        $drivers = Driver::where('nama', 'LIKE', '%' . $term . '%')->latest()->paginate(7)->withQueryString();

        return view('data-master.driver.index',[
            'drivers' => $drivers
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('data-master.driver.create');
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
            'nama' => 'required'
        ]);

        Driver::create($validated);
        return redirect('/driver')->with('success', 'Tambah Berhasil');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Driver  $driver
     * @return \Illuminate\Http\Response
     */
    public function show(Driver $driver)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Driver  $driver
     * @return \Illuminate\Http\Response
     */
    public function edit(Driver $driver)
    {
        return view('data-master.driver.edit', [
            'driver' => $driver
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Driver  $driver
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Driver $driver)
    {
        $validated = $request->validate([
            'nama' => 'required'
        ]);
        $driver->where('id', $request->id)->update($validated);
        return redirect('/driver')->with('success', 'Edit Driver Selesai!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Driver  $driver
     * @return \Illuminate\Http\Response
     */
    public function destroy(Driver $driver)
    {
        $driver->find($driver->id)->delete();
        return redirect('/driver')->with('success', 'Kendaraan Berhasil Dihapus');
    }

    public function driverMulaiCuti(Driver $driver){
        $driver->where('id', $driver->id)->update([
            'status' => 'cuti'
        ]);

        return redirect('/driver')->with('success', 'Edit Status Driver Sukses!');
    }

    public function driverSelesaiCuti(Driver $driver){
        $driver->where('id', $driver->id)->update(['status' => 'tersedia']);

        return redirect('/driver')->with('success', 'Edit Status Driver Sukses!');
    }
}
