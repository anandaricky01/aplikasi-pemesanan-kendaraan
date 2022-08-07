<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\LoginController;
use App\Http\Controllers\RiwayatKendaraanController;
use App\Http\Controllers\PendingKendaraanController;
use App\Http\Controllers\RiwayatServiceController;
use App\Http\Controllers\KendaraanController;
use App\Http\Controllers\KendaraanDigunakanController;
use App\Http\Controllers\RootController;
use App\Http\Controllers\DriverController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// login
Route::group(['auth' => 'guest','prefix' => 'login'] ,function () {
    Route::get('/', [LoginController::class, 'index'])->name('login')->middleware('guest');
    Route::post('/', [LoginController::class, 'authenticate']);
});

// route protecter
Route::middleware(['auth'])->group(function () {
    Route::get('/', [RootController::class, 'index']);

    Route::get('/home', function (){
        return redirect('/');
    });

    // group untuk controller yang memiliki prefix kendaraan
    Route::group(['prefix' => 'kendaraan'],function () {
        Route::get('/tersedia', [KendaraanController::class, 'kendaraanTersedia']);
        Route::get('/digunakan', [KendaraanController::class, 'kendaraanDigunakan']);
        Route::get('/diservice', [KendaraanController::class, 'kendaraanDiservice']);
        Route::get('/pending', [PendingKendaraanController::class, 'index']);
        Route::post('/pending/{pending:id}/setujui', [PendingKendaraanController::class, 'setujui']);
        Route::post('/pending/{pending:id}/tolak', [PendingKendaraanController::class, 'tolak']);
        Route::post('/pending/{pending:id}/hapus', [PendingKendaraanController::class, 'hapus']);
        Route::post('/{kendaraan:id}/service', [KendaraanController::class, 'kendaraanKeService']);
        Route::post('/{kendaraan:id}/service-selesai', [KendaraanController::class, 'kendaraanSelesaiService']);
    });

    // resource untuk kendaraan
    Route::resource('kendaraan', KendaraanController::class);

    // group untuk controller yang memiliki prefix driver
    Route::group(['prefix' => 'driver'], function(){
        Route::post('{driver:id}/cuti', [DriverController::class, 'driverMulaiCuti']);
        Route::post('{driver:id}/selesai-cuti', [DriverController::class, 'driverSelesaiCuti']);
    });

    // resource untuk driver
    Route::resource('driver', DriverController::class);

    // resource untuk pemesanan kendaraan
    Route::group(['prefix' => 'pesan-kendaraan'], function(){
        Route::post('/{kendaraanDigunakan:id}/selesai-digunakan', [KendaraanDigunakanController::class, 'selesaiDigunakan']);
    });
    Route::resource('pesan-kendaraan', KendaraanDigunakanController::class);

    // controller untuk mengatasi riwayat riwayat
    Route::get('/riwayat-kendaraan', [RiwayatKendaraanController::class, 'index']);
    Route::get('/riwayat-kendaraan/export', [RiwayatKendaraanController::class, 'export']);
    Route::get('/riwayat-service', [RiwayatServiceController::class, 'index']);

    // logout
    Route::post('/logout', [LoginController::class, 'logout']);
});

