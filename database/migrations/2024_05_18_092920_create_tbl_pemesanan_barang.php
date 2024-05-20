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
        Schema::create('tbl_pemesanan', function (Blueprint $table) {
            $table->bigIncrements('pesan_id');
            $table->unsignedBigInteger('barang_id')->nullable();
            $table->unsignedBigInteger('supplier_id')->nullable();
            $table->string('pesan_kode');
            $table->string('barang_kode');
            $table->integer('pesan_jumlah');
            $table->integer('pesan_totalharga');
            $table->timestamp('pesan_tanggal');
            $table->enum('pesan_status', ['PENDING', 'APPROVED', 'REJECTED'])->default('PENDING');
            $table->foreign('barang_id')->references('barang_id')->on('tbl_barang')->nullOnDelete();
            $table->foreign('supplier_id')->references('supplier_id')->on('tbl_supplier')->nullOnDelete();
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
        Schema::dropIfExists('tbl_pemesanan');
    }
};
