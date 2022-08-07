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
        Schema::create('riwayat_services', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kendaraan_id')->on('kendaraans')->onDelete('cascade');
            $table->date('tanggal_service');
            $table->date('tanggal_keluar')->nullable();
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
        Schema::dropIfExists('riwayat_services');
    }
};
