<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBarangsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('barangs', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('rekanan_id')->unsigned();
            $table->string('nama_barang');
            $table->string('jenis_barang')->nullable();
            $table->integer('harga_barang');
            $table->string('gambar_barang')->nullable();
            $table->text('detail_barang')->nullable();
            $table->string('status_barang');
            $table->timestamps();
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
        Schema::dropIfExists('barangs');
    }
}
