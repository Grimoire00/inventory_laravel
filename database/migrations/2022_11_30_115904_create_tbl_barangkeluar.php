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
        Schema::create('tbl_barangkeluar', function (Blueprint $table) {
            $table->bigIncrements('bk_id');
            $table->unsignedBigInteger('customer_id')->nullable();
            $table->unsignedBigInteger('barang_id')->nullable();
            $table->string('bk_kode');
            $table->string('barang_kode');
            $table->string('bk_tanggal');
            $table->string('bk_tujuan')->nullable();
            $table->string('bk_jumlah');
            $table->foreign('customer_id')->references('customer_id')->on('tbl_customer')->nullOnDelete();
            $table->foreign('barang_id')->references('barang_id')->on('tbl_barang')->nullOnDelete();
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
        Schema::dropIfExists('tbl_barangkeluar');
    }
};
