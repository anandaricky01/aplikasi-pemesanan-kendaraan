<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('riwayat_kendaraans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kendaraan_id')->on('kendaraans')->onDelete('cascade');
            $table->foreignId('driver_id')->on('drivers')->onDelete('cascade');
            $table->string('kode_kegiatan');
            $table->integer('bbm_liter');
            $table->date('tanggal_digunakan');
            $table->date('tanggal_selesai');
            $table->string('tujuan');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('riwayat_kendaraans');
    }
};
