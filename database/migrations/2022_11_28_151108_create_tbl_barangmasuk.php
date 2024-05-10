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
        Schema::create('tbl_barangmasuk', function (Blueprint $table) {
            $table->bigIncrements('bm_id');
            $table->unsignedBigInteger('supplier_id')->nullable();
            $table->unsignedBigInteger('barang_id')->nullable();
            // $table->unsignedBigInteger('customer_id')->nullable();
            $table->string('bm_kode');
            $table->string('barang_kode');
            $table->string('bm_tanggal');
            $table->string('bm_jumlah');
            $table->foreign('supplier_id')->references('supplier_id')->on('tbl_supplier')->nullOnDelete();
            $table->foreign('barang_id')->references('barang_id')->on('tbl_barang')->nullOnDelete();
            // $table->foreign('customer_id')->references('customer_id')->on('tbl_customer')->nullOnDelete();
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
        Schema::dropIfExists('tbl_barangmasuk');
    }
};
