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
        Schema::create('tbl_minmax', function (Blueprint $table) {
            $table->bigIncrements('mm_id');
            $table->unsignedBigInteger('barang_id')->nullable();   
            $table->string('mm_periode');
            $table->string('mm_min');
            $table->string('mm_max');
            $table->string('mm_average');
            $table->string('mm_leadtime');
            $table->string('mm_safety');
            $table->string('mm_reorderpoin');
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
        Schema::dropIfExists('tbl_minmax');
    }
};
