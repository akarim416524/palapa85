<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePendanaansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pendanaans', function (Blueprint $table){
            $table->increments('id');
            $table->integer('anggota_id')->unsigned();
            $table->integer('pengurus_id')->unsigned()->nullable();
            $table->integer('rekanan_id')->unsigned();
            $table->string('nama_barang');
            $table->string('jenis_barang')->nullable();
            $table->integer('harga_barang');
            $table->string('terbilang')->nullable();
            $table->date('tanggal_awal');
            $table->date('tanggal_akhir');
            $table->string('status_hr')->default('Menunggu Persetujuan HR');
            $table->string('status_pengurus')->default('Sedang di Proses');
            $table->string('status_rekanan')->default('Menunggu Konfirmasi');
            $table->text('catatan_pengurus')->nullable();
            $table->text('catatan_rekanan')->nullable();
            $table->string('cara_pembayaran')->nullable();
            $table->string('bukti_hr')->nullable();
            $table->timestamps();
            $table->foreign('anggota_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('pengurus_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('rekanan_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('Pendanaans');
    }
}
