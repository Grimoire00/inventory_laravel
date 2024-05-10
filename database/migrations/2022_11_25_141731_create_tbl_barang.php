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
        Schema::create('tbl_barang', function (Blueprint $table) {
            $table->bigIncrements('barang_id');
            $table->unsignedBigInteger('jenisbarang_id')->nullable();
            $table->unsignedBigInteger('satuan_id')->nullable();
            $table->unsignedBigInteger('merk_id')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->string('barang_kode');
            $table->string('barang_nama');
            $table->string('barang_slug');
            $table->string('barang_harga');
            $table->string('barang_stok');
            $table->string('barang_gambar');
            $table->foreign('jenisbarang_id')->references('jenisbarang_id')->on('tbl_jenisbarang')->nullOnDelete();
            $table->foreign('satuan_id')->references('satuan_id')->on('tbl_satuan')->nullOnDelete();
            $table->foreign('merk_id')->references('merk_id')->on('tbl_merk')->nullOnDelete();
            $table->foreign('user_id')->references('user_id')->on('tbl_user')->nullOnDelete();
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
        Schema::dropIfExists('tbl_barang');
    }

    
};
