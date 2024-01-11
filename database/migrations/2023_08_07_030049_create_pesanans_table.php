<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('pesanans', function (Blueprint $table) {
            $table->id();
            $table->string('kd_pesanan');
            $table->date('tgl_pesanan');
            $table->unsignedBigInteger('pelanggan_id');
            $table->foreignID('statuspesanan_id');
            $table->string('statuspembayaran')->default("belum bayar");
            $table->foreignID('jenislayanan_id')->nullable();
            $table->foreignID('layanankhusus_id')->nullable();
            $table->string('berat');
            $table->string('catatan')->nullable();
            $table->string('jml_layanankhusus');
            $table->string('harga');
            $table->timestamps();


            $table->foreign('pelanggan_id')->references('id')->on('pelanggans')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pesanans');
    }
};
