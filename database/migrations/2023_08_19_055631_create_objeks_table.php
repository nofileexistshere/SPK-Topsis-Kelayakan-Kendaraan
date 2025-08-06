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
        Schema::create('objek', function (Blueprint $table) {
            $table->id();
            $table->string("nama");              // nama pemilik/objek
            $table->string("kendaraan");         // jenis kendaraan
            $table->string("nomor_polisi");      // kolom tambahan
            $table->string("nama_kendaraan");    // kolom tambahan
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
        Schema::dropIfExists('objek');
    }
};
