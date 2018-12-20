<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePeminjamanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('peminjaman', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->integer('no_pinjaman');
            $table->string('jenis_angunan');
            $table->string('no_jaminan');
            $table->string('atas_nama');
            $table->string('type');
            $table->string('warna');
            $table->string('no_polisi');
            $table->string('no_rangka');
            $table->string('no_mesin');
            $table->integer('jumlah');
            $table->string('terbilang');
            $table->string('status');
            $table->string('surat_kuasa');
            $table->integer('bayar_awal');
            $table->string('jangka_waktu');
            $table->string('cara_pembayaran');
            $table->date('periode_awal');
            $table->date('periode_akhir');
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('peminjaman');
    }
}
